<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $num
 * @property int      $good
 * @property int      $bad
 * @property int      $cnt
 * @property int      $pnum
 * @property int      $level
 * @property int      $step
 * @property int      $memo_cnt
 * @property int      $notice
 * @property int      $notviewmemo
 * @property int      $isimg
 * @property int      $isdisp
 * @property string   $name
 * @property string   $uid
 * @property string   $email
 * @property string   $subject
 * @property string   $content
 * @property string   $url
 * @property string   $fn_name1
 * @property string   $fn_name2
 * @property string   $file_list
 * @property string   $thumb
 * @property string   $videourl
 * @property string   $attachfile
 * @property string   $multi
 * @property string   $ip
 * @property string   $mobile
 * @property string   $gubun
 * @property string   $passwd
 * @property string   $cate
 * @property DateTime $reg_date
 * @property DateTime $memo_date
 * @property DateTime $edit_date
 * @property boolean  $iswarning
 */
class Cboard extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cboard';

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
        'scrap_cnt', 'name', 'uid', 'good', 'bad', 'email', 'subject', 'content', 'url', 'fn_name1', 'fn_name2', 'file_list', 'thumb', 'videourl', 'attachfile', 'reg_date', 'cnt', 'pnum', 'level', 'step', 'multi', 'html', 'memo_cnt', 'memo_date', 'notice', 'notviewmemo', 'ip', 'mobile', 'gubun', 'isimg', 'edit_date', 'passwd', 'cate', 'point', 'secret', 'isdisp', 'iswarning'
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
        'num' => 'int', 'name' => 'string', 'uid' => 'string', 'good' => 'int', 'bad' => 'int', 'email' => 'string', 'subject' => 'string', 'content' => 'string', 'url' => 'string', 'fn_name1' => 'string', 'fn_name2' => 'string', 'file_list' => 'string', 'thumb' => 'string', 'videourl' => 'string', 'attachfile' => 'string', 'reg_date' => 'datetime', 'cnt' => 'int', 'pnum' => 'int', 'level' => 'int', 'step' => 'int', 'multi' => 'string', 'memo_cnt' => 'int', 'memo_date' => 'datetime', 'notice' => 'int', 'notviewmemo' => 'int', 'ip' => 'string', 'mobile' => 'string', 'gubun' => 'string', 'isimg' => 'int', 'edit_date' => 'datetime', 'passwd' => 'string', 'cate' => 'string', 'isdisp' => 'int', 'iswarning' => 'boolean'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'reg_date', 'memo_date', 'edit_date'
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
