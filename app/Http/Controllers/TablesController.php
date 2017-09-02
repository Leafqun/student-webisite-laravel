<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/29
 * Time: 21:04
 */

namespace App\Http\Controllers;


use App\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\Table;

class TablesController extends Controller
{
    public function getTables(Request $request){
        $tablesList = Tables::orderBy('tableId', 'desc') -> paginate(15, ['tableId', 'tableFile'], null, $request -> pageNum);
        return array('tablesList'=> $tablesList);
    }

    public function deleteTables(Request $request){
        if(is_array($request -> tableId)){
            $tablesIds = $request -> all();
        }else{
            $tablesIds = array($request -> all());
        }
        foreach ($tablesIds as $tablesId){
            $file = Tables::where('tableId', $tablesId) ->first(['tableFile']);
            if(empty($file ->tableFile)) continue;
            Storage::disk('uploads')->delete($file -> tableFile);
            Tables::destroy($tablesId);
        }
        return array('msg' => 'success');
    }

    public function insertTables(Request $request){
        $tables = $request -> except('file');
        $file = $request -> file('file');
        if($file -> isValid()){
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
            // 上传文件
            // 使用我们新建的uploads本地存储空间（目录）
            //删除旧文件
            if(!Storage::exists($originalName)) {
                Storage::disk('uploads')->put($originalName, file_get_contents($realPath));
            }
            $tables['tableFile'] = $originalName;
        }
        Tables::create($tables);
        return array('msg', 'success');
    }
}