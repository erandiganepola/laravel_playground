<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract {
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo("App\\Role");
    }

    public function isSuperAdmin() {
        return strcmp($this->role->role, "super_admin") == 0;
    }

    public function isChiefExecutive() {
        return strcmp($this->role->role, "super_admin") == 0;
    }

    public function isExecutive() {
        return strcmp($this->role->role, "executive") == 0;
    }

    public function isClerk() {
        return strcmp($this->role->role, "clerk") == 0;
    }

    public function isStudent() {
        return strcmp($this->role->role, "student") == 0;
    }
}
