<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/29
 * Time: 15:52
 */

namespace App\Http\Controllers;


use App\Course;
use App\CourseFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function getCourseList(){
        $courseList = Course::get(['courseId','courseName', 'enName']);
        return array('courseList' => $courseList);
    }

    public function  getCourse(Request $request){
        $course = Course::find($request->courseId);
        return array('course' => $course);
    }

    public function submitCourse(Request $request){
        $course = $request -> all();
        $msg = '';
        if(empty($request -> courseId)){
            Course::create($course);
            $msg = '添加成功';
        }else{
            Course::where('courseId', $request -> courseId) -> update($course);
            $msg = '更改成功';
        }
        return array('msg' => $msg);
    }

    public function deleteCourse(Request $request){

        $oldFile = CourseFile::where('courseId', $request -> courseId) -> get(['cfileName']);
        foreach ($oldFile as $file){
            if(!empty($file)){
                Storage::disk('uploads')->delete($file -> cfileName);
            }
        }
        Course::destroy($request -> courseId);
        CourseFile::where('courseId', $request -> courseId) -> delete();
        return array('msg'=> 'success');
    }

    public function getAllCourseFile(Request $request){
        $courseFileList = CourseFile::where('courseId', $request -> courseId) ->orderBy('cfileId', 'desc') -> get();
        return array('courseFileList' => $courseFileList);
    }

    public function deleteCourseFile(Request $request){
        if(is_array($request -> cfileId)) $cfileIds = $request -> cfileId;
        else $cfileIds = array($request -> cfileId);
        foreach ($cfileIds as $cfileId){
            $file = CourseFile::where('cfileId', $cfileId) -> first(['cfileName']);
            if(!empty($file)){
                Storage::disk('uploads')->delete($file -> cfileName);
            }
            CourseFile::where('cfileId', $cfileId) -> delete();
        }
        return array('msg' => 'success');
    }

    public function insertCourseFile(Request $request){
        $courseFile = $request -> except('file');
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
            $courseFile['cfileName'] = $originalName;
        }
        CourseFile::create($courseFile);
        return array('msg' => 'success');

    }
}