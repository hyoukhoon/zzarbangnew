<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $memoid
 * @property int      $bid
 * @property int      $pid
 * @property int      $status
 * @property string   $userid
 * @property string   $name
 * @property string   $memo
 * @property string   $memo_file
 * @property DateTime $regdate
 */
class XcMemo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xc_memo';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'memoid';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bid', 'pid', 'userid', 'name', 'memo', 'memo_file', 'status', 'regdate'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'memoid' => 'int', 'bid' => 'int', 'pid' => 'int', 'userid' => 'string', 'name' => 'string', 'memo' => 'string', 'memo_file' => 'string', 'status' => 'int', 'regdate' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'regdate'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    // Scopes...

    // Functions ...

    // Relations ...
}
