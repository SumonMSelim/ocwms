<?php

class User extends Eloquent
{
    protected $table = 'users';
    protected $hidden = ['password', 'remember_token'];
    protected $guarded = [''];

    public function courses()
    {
        return $this->hasMany('Course');
    }
}
