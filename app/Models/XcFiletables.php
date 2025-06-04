<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $num
 * @property int      $bid
 * @property int      $attcnt
 * @property int      $summercnt
 * @property int      $videocnt
 * @property int      $attsize
 * @property int      $summersize
 * @property int      $videosize
 * @property string   $userid
 * @property string   $fid
 * @property DateTime $regdate
 */
class XcFiletables extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xc_filetables';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'num';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userid', 'fid', 'bid', 'attcnt', 'summercnt', 'videocnt', 'attsize', 'summersize', 'videosize', 'regdate'
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
        'num' => 'int', 'userid' => 'string', 'fid' => 'string', 'bid' => 'int', 'attcnt' => 'int', 'summercnt' => 'int', 'videocnt' => 'int', 'attsize' => 'int', 'summersize' => 'int', 'videosize' => 'int', 'regdate' => 'datetime'
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
