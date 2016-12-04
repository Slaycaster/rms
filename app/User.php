<?php

namespace App;

//For laravel/backpack PermissionManager
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;


class User extends Authenticatable
{

    use CrudTrait;
    use HasRoles;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'branch_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     *
     **/

    /*--------------------------------------------------
                        RELATIONSHIPS
    ---------------------------------------------------*/

    public function transactions()
    {
        return $this->hasMany('App\Transaction', 'user_id');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id', 'id');
    }
}
