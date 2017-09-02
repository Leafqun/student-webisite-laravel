<?php
/**
 * Created by PhpStorm.
 * User: Leafqun
 * Date: 2017/8/29
 * Time: 21:00
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    protected $table = 'tables';

    protected $primaryKey = 'tableId';

    protected $fillable = ['tableId', 'tableName', 'tableFile', 'tableType'];

    public $timestamps = false;
}