<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/31
 * Time: 17:30
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculty';

    protected $primaryKey = 'facultyId';

    protected $fillable = ['facultyId', 'teachers', 'projects', 'papers'];

    public $timestamps = false;
}