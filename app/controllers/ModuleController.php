<?php

class ModuleController extends BaseController {

    /*
    |   -- Function belong sheet --
    |
    |   -- Eric 
    |       * viewChapter
    |       * nextQuestion
    |       *getMenu
    |
    */

    public function getCount()
    {
        $modules = Module::all()->count();
        $rewards = Reward::where('user_id', Auth::user()->id)->count();

        $total = $rewards . '/' . $modules;

        return $total;
    }

    //Function for ordering array after chapternumber
    public function getMenu($chapters) 
    {
        //Creates array
        $menu = array();
                
        //go through the array in the parameters and give value for menu array
        foreach($chapters as $cha) 
        {
            $new = array(
                'title' => $cha['title'],
                'nr' => $cha['chapternumber']
            );
                    
            $menu[] = $new;
        }
                
        //Function to sort the array with key value
        function aasort (&$array, $key) {
            $sorter=array();
            $ret=array();
            reset($array);
            foreach ($array as $ii => $va) {
                $sorter[$ii]=$va[$key];
            }
            asort($sorter);
            foreach ($sorter as $ii => $va) {
                $ret[$ii]=$array[$ii];
            }
            $array=$ret;
        }
                
        aasort($menu, 'nr');

        return $menu;
    }

    public function hello()
    {
        $modules = Module::all();

        $page = Page::find(1);

        $count = $this->getCount();

        return View::make('hello')->with('modules', $modules)->with('about', $page)->with('total', $count);
    }

    //Function to make the correction on answers, creates new view with next question
    public function nextQuestion($m_id, $c_number, $nr)
    {
        //Group where objects are created for this view
        $answer = Answer::where('id', Input::get('answer'))->first();

        $oldAnswer = UserAnswer::where('q_id', $answer['q_id'])->count();

        $chapter = Chapter::where('chapternumber', $c_number)->where('m_id', $m_id)->first();
            
        $chapters = Chapter::where('m_id', $m_id)->get();

        $module = Module::find($m_id);

        //check if user got and answer on that question already or not
        if($oldAnswer == 0) 
        {
            $uAnswer = new UserAnswer;
        }
        else {
            $oldAnswer = UserAnswer::where('q_id', $answer['q_id'])->first();
            $uAnswer =  UserAnswer::find($oldAnswer['id']);
        }

        //Adding/updating the answer to the database
        $uAnswer->m_id = $m_id;
        $uAnswer->c_id = $chapter['id'];
        $uAnswer->q_id = $answer['q_id'];
        $uAnswer->a_id = $answer['id'];
        $uAnswer->user_id = Auth::user()->id;
        $uAnswer->correct = $answer['correct'];

        $uAnswer->save();

        //Check if it was the last question the user answered and if so, giving the badge or not
        if(Input::get('gear') == '1')
        {
            $xQ = Question::where('c_id', $chapter['id'])->count();
            $xA = UserAnswer::where('c_id', $chapter['id'])->where('user_id', Auth::user()->id)->where('correct', 1)->count();

            $total = $this->getCount();
            $modules = Module::all();
            $page = Page::find(1);

            if($xQ == $xA)
            {
                $check = Reward::where('m_id', $m_id)->where('user_id', Auth::user()->id)->count();
                if($check == 0)
                {
                    $reward = new Reward;

                    $reward->m_id = $m_id;
                    $reward->user_id = Auth::user()->id;
                    $reward->decal = $module->decal;

                    $reward->save();
                }
                return View::make('hello')
                    ->with('win', 'true')
                    ->with('name', $module->name)
                    ->with('total', $total)
                    ->with('img', $module->decal)
                    ->with('modules', $modules)
                    ->with('about', $page)
                    ->with('correctionResult', 'rätt');
            }
            
            $questions = Question::where('c_id', $chapter->id)->get();

            $data = array();

            $count = 1;

            foreach($questions as $question)
            {
                $answer = UserAnswer::where('q_id', $question['id'])->where('user_id', Auth::user()->id)->first();

                if($answer['correct'] == 0)
                {
                    $new = array(
                        'Question' => $count,
                    );

                    $data[] = $new;
                }

                $count += 1;
            }
            return View::make('hello')
                ->with('win', 'false')
                ->with('name', $module->name)
                ->with('total', $total)
                ->with('modules', $modules)
                ->with('about', $page)
                ->with('data', $data)
                ->with('correctionResult', 'fel');
        }

        //check if the module/chapter exist or not
        if(empty($module) OR empty($chapter))
        {
            return Redirect::route('home');
        }

        //Getting the next question
        $nr -= 1;
        $question = Question::where('c_id', $chapter['id'])->take(1)->skip($nr)->first();
        $nr += 2;

        //Getting the answers for that question
        $answers = Answer::where('q_id', $question['id'])->get();

        //Checking if its the last question in this chapter, if so change the submit button text
        $questions = Question::where('id', '>', $question['id'])->where('c_id', $chapter['id'])->count();

        //Check if the user has and old answer already on this question
        $last = UserAnswer::where('q_id', $question['id'])->where('user_id', Auth::user()->id)->count();

        $disabled = '';
        $lastAns = 0;

        //If the user already have and old answer
        if($last != 0)
        {
            $last = UserAnswer::where('q_id', $question['id'])->where('user_id', Auth::user()->id)->first();

             if($last['correct'] == 1)
             {
                $disabled = 'disabled';
                $lastAns = $last['a_id'];
             }  
             else {
                $lastAns = $last['a_id'];
             }       
        }

        //Changing the submit button text
        if($questions != 0) 
        {
            $gear = 0;
            $submit = 'Nästa fråga';
        }
        else {
            $gear = 1;
            $submit = 'Rätta svaren';
        }

        //Using the first function for the menu and ordering it
        $menu = $this->getMenu($chapters);

        $count = $this->getCount();

        //Creates the view with all the needed compunents
        return View::make('module.viewChapter')
            ->with('chapter', $chapter)
            ->with('menu', $menu)
            ->with('module', $m_id)
            ->with('question', $question)
            ->with('answers', $answers)
            ->with('submit', $submit)
            ->with('gear', $gear)
            ->with('qNr', $nr)
            ->with('disabled', $disabled)
            ->with('lastAns', $lastAns)
            ->with('total', $count);

    }

    //Function the view the chapters and/or getting the first question in the chapter
	public function viewChapter($m_id, $c_id)
	{
            //Creates needed object for the view
            $module = Module::find($m_id);
            $chapter = Chapter::where('m_id', $m_id)->where('chapternumber', $c_id)->first();
            
            $chapters = Chapter::where('m_id', $m_id)->get();
            
            //Check so module and chapter objects and not null
            if($module != null AND $chapter != null)
            {
                //Getting the sorted menu
                $menu = $this->getMenu($chapters);
                
                $count = $this->getCount();

                //Check if the chapter is a chapter that got questions
                if($chapter['isQuestions'] == 1) 
                {

                    $question = Question::where('c_id', $chapter['id'])->first();
                    $answers = Answer::where('q_id', $question['id'])->get();

                    $questions = Question::where('c_id', $chapter['id'])->count();

                    $last = UserAnswer::where('q_id', $question['id'])->where('user_id', Auth::user()->id)->count();

                    $disabled = '';
                    $lastAns = 0;

                    if($last != 0)
                    {
                        $last = UserAnswer::where('q_id', $question['id'])->where('user_id', Auth::user()->id)->first();

                         if($last['correct'] == 1)
                         {
                            $disabled = 'disabled';
                            $lastAns = $last['a_id'];
                         }  
                         else {
                            $lastAns = $last['a_id'];
                         }       
                    }

                    if($questions > 1) 
                    {
                        $gear = 0;
                        $submit = 'Nästa fråga';
                    }
                    else {
                        $gear = 1;
                        $submit = 'Rätta svaren';
                    }

                    return View::make('module.viewChapter')
                        ->with('chapter', $chapter)
                        ->with('menu', $menu)
                        ->with('module', $m_id)
                        ->with('question', $question)
                        ->with('answers', $answers)
                        ->with('submit', $submit)
                        ->with('gear', $gear)
                        ->with('disabled', $disabled)
                        ->with('lastAns', $lastAns)
                        ->with('total', $count);
                }
                
                return View::make('module.viewChapter')
                    ->with('chapter', $chapter)
                    ->with('menu', $menu)
                    ->with('module', $m_id)
                    ->with('total', $count);
            }
            else {
                return Redirect::route('home');
            }
	}
}
