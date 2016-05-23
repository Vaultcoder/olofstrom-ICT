<?php

class Question extends Eloquent {

    protected $table = 'questions';
    
    public function modules() 
    {
        return $this->belongsTo('module');
    }
    
    public function chapters() 
    {
        return $this->belongsTo('chapter');
    }
    
    public function answers()
    {
        return $this->hasMany('answer', 'q_id');
    }
    
    public function userAnswer()
    {
        return $this->hasMany('userAnswer', 'm_id');
    }

}