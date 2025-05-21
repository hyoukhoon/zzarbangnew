<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Member extends Authenticatable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member';

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
        'uid', 'email', 'mobile', 'passwd', 'nickName', 'isPush', 'isEmail', 'resetpass', 'ismember', 'wronglogin', 'regDate', 'lastLogin', 'isAuth', 'signtype', 'photo', 'passUpDate', 'loginIp', 'remember_token'
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
        'num' => 'int', 'uid' => 'string', 'email' => 'string', 'mobile' => 'string', 'passwd' => 'string', 'nickName' => 'string', 'isPush' => 'boolean', 'isEmail' => 'boolean', 'resetpass' => 'int', 'ismember' => 'boolean', 'wronglogin' => 'boolean', 'regDate' => 'datetime', 'lastLogin' => 'datetime', 'isAuth' => 'boolean', 'signtype' => 'string', 'photo' => 'string', 'passUpDate' => 'datetime', 'loginIp' => 'string', 'remember_token' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'regDate', 'lastLogin', 'passUpDate'
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
