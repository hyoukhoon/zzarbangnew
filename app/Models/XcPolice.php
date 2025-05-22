<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $num
 * @property int      $boardid
 * @property int      $memoid
 * @property string   $userid
 * @property string   $contents
 * @property boolean  $reporttype
 * @property boolean  $status
 * @property DateTime $regdate
 * @property DateTime $modidate
 */
class XcPolice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xc_police';

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
        'userid', 'boardid', 'memoid', 'reporttype', 'contents', 'regdate', 'modidate', 'status'
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
        'num' => 'int', 'userid' => 'string', 'boardid' => 'int', 'memoid' => 'int', 'reporttype' => 'boolean', 'contents' => 'string', 'regdate' => 'datetime', 'modidate' => 'datetime', 'status' => 'boolean'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'regdate', 'modidate'
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
