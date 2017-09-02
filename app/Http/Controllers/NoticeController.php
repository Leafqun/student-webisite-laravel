<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/28
 * Time: 10:42
 */

namespace App\Http\Controllers;


use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    //获取首页通知
    public function getHeadNotice(){
        $notice = Notice::OrderBy('noticeTime','desc')
            ->take(6)
            ->get(['noticeId','noticeName','noticeTime']);
        return array('noticeList' => $notice);
    }
    //获取分页通知
    public function getNotice(Request $request){
        $notice = Notice::OrderBy('noticeTime','desc')
            ->paginate(15,['noticeId', 'noticeName', 'noticeTime'],null,$request -> pageNum);
        return array('noticeList' => $notice);
    }
    //获取通知内容
    public function getNoticeContent(Request $request){
        $notice = Notice::find($request -> get('noticeId'));
        return array('notice' => $notice);
    }
    //提交通知
    public function submitNotice(Request $request){
        $input = $request -> except('cfile');
        $input['noticeTime'] = date('Y-m-d H:i:s',time());
        if($request -> hasFile('cfile')){
            $file = $request -> file('cfile');
            if($file -> isValid()){
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg
                // 上传文件
                // 使用我们新建的uploads本地存储空间（目录）
                //删除旧文件
                if(strcmp($input['file'], $originalName) != 0){
                    $bool = Storage::disk('uploads')->delete($input['file']);
                }
                if(!Storage::exists($originalName)) {
                    Storage::disk('uploads')->put($originalName, file_get_contents($realPath));
                }
                $input['file'] = $originalName;
            }
        }
        //存入数据库
        if(empty($input['noticeId'])){
            //插入
            $notice = Notice::create($input);
            $notice -> save();
            return array('msg' => '添加成功');
        }else{
            Notice::where('noticeId', $input['noticeId']) -> update($input);
            return array('msg' => '更改成功');
        }
    }
    //删除通知
    public function deleteNotice(Request $request)
    {
        if(is_array($request->noticeId)) {
            $noticeId = $request->noticeId;
        }else{
            $noticeId = array($request->noticeId);
        }
        foreach ($noticeId as $id){
            $filename = Notice::where('noticeId', $id) -> first(['file']);
            if(empty($filename ->file)) continue;
            Storage::disk('uploads')->delete($filename -> file);
            Notice::destroy($id);
        }
        return array('msg' => '删除成功');
    }
}