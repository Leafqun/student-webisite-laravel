<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/28
 * Time: 10:44
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notice';

    protected $primaryKey = 'noticeId';

    protected $fillable = ['noticeId', 'noticeName', 'content', 'file', 'noticeTime'];

    public $timestamps = false;
}