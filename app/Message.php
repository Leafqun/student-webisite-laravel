<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/28
 * Time: 16:52
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';

    protected $primaryKey = 'messageId';

    protected $fillable = ['messageId', 'stuName', 'email', 'content', 'mTime'];

    public $timestamps = false;
}