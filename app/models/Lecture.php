<?php

class Lecture extends \Eloquent
{
    protected $table = 'lectures';
    protected $guarded = [''];

    public function course()
    {
        return $this->belongsTo('Course');
    }
}