<?php

class UC extends \Eloquent
{
    protected $table = 'users_courses';
    protected $guarded = [''];

    public function course()
    {
        return $this->belongsTo('Course');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}