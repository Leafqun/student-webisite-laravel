<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/28
 * Time: 16:57
 */

namespace App\Http\Controllers;


use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessageList(Request $request){
        $messageList = Message::OrderBy('mTime','desc')
            -> paginate(15, ['messageId', 'stuName', 'email', 'mTime'],null, $request -> pageNum );
        return array('messageList' => $messageList);
    }

    public function getMessage(Request $request){
        $message = Message::where('messageId', $request -> messageId) ->first();
        return array('message' => $message);
    }

    public function insertMessage(Request $request){
        Message::create($request -> all());
        return array('msg' => 'success');
    }

    public function deleteMessage(Request $request){
        Message::destroy($request -> messageId);
        return array('msg' => 'success');
    }
}