<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/27
 * Time: 18:08
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'user';

    protected $primaryKey = 'userId';
}