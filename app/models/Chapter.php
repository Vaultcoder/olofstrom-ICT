<?php

class Chapter extends Eloquent {

    protected $table = 'chapters';
    
    public function modules() 
    {
        return $this->belongsTo('module');
    }
    
    public function questions() 
    {
        return $this->hasMany('question', 'c_id');
    }
    
    public function answers()
    {
        return $this->hasMany('answer', 'c_id');
    }
    
    public function userAnswer()
    {
        return $this->hasMany('userAnswer', 'm_id');
    }

}