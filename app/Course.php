<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/29
 * Time: 15:53
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';

    protected $primaryKey = 'courseId';

    protected $fillable = ['courseId', 'courseName', 'course', 'courseSchedule', 'courseArr', 'enName'];

    public $timestamps = false;
}