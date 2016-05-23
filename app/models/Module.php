<?php

class Module extends Eloquent {

    protected $table = 'modules';
    
    public function chapters() 
    {
        return $this->hasMany('chapter', 'm_id');
    }
    
    public function questions() 
    {
        return $this->hasMany('question', 'm_id');
    }
    
    public function answers()
    {
        return $this->hasMany('answer', 'm_id');
    }
    
    public function userAnswer()
    {
        return $this->hasMany('userAnswer', 'm_id');
    }

}