<?php

class Course extends \Eloquent
{
    protected $table = 'courses';
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function lectures()
    {
        return $this->hasMany('Lecture');
    }

    public function assignments()
    {
        return $this->hasMany('Assignment');
    }
}