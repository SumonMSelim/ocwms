<?php

class Assignment extends \Eloquent
{
    protected $table = 'assignments';
    protected $guarded = [''];

    public function course()
    {
        return $this->belongsTo('Course');
    }
}