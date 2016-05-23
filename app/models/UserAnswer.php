<?php

class UserAnswer extends Eloquent {

    protected $table = 'user_answer';
    
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
    
    public function answer()
    {
        return $this->belongsTo('answer');
    }

}