<?php

class Submission extends \Eloquent
{
    protected $table = 'students_assignments';
    protected $guarded = [''];

    public function student()
    {
        return $this->belongsTo('User');
    }
}