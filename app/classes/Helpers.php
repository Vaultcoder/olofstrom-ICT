<?php

class Helpers {

    public static function getAnswers($m_id) {
        
    	$module = Module::find($m_id);

    	if(!empty($module))
    	{
	        $questions = Question::where('m_id', $m_id)->count();
	        if($questions != 0)
	        {
	        	$answers = UserAnswer::where('m_id', $m_id)->where('user_id', Auth::user()->id)->where('correct', 1)->count();
	        }
	        else {
	        	$answers = 0;
	        }
	    }
	    else {
	    	$answers = 0;
	    	$questions = 0;
	    }
        $correctAnswers = '<br>' . $answers . ' av ' . $questions . ' frågor klarade'; 
        
        return $correctAnswers;
    }

}