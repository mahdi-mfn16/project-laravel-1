<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Verta;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','privilege', 'created_by_user',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }


    public function garegorian2jalali($time){
        $v = new Verta($time);
        return $v;
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permissionLabel)
    {
        // $user_permissions=[];
        $permissions = $this->permissions()->get();
        // foreach($permissions as $permission){
        //     array_push($user_permissions, $permission->label);
        // }
        // return in_array($permissionLabel, $user_permissions);
        return $permissions->contains('label', $permissionLabel);
        
        
    }

}
