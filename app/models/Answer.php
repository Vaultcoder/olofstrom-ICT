<?php

class Answer extends Eloquent {

    protected $table = 'answers';
    
    public function modules() 
    {
        return $this->belongsTo('module');
    }
    
    public function chapters() 
    {
        return $this->belongsTo('chapter');
    }
    
    public function questions()
    {
        return $this->belongsTo('question');
    }
    
    public function userAnswer()
    {
        return $this->hasMany('userAnswer', 'm_id');
    }

}