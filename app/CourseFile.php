<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/29
 * Time: 16:54
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    protected $table = 'coursefile';

    protected $primaryKey = 'cfileId';

    protected $fillable = ['cfileId', 'courseId', 'cfileName', 'ctype'];

    public $timestamps = false;
}