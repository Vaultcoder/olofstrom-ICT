<?php

class AdminController extends BaseController {

    /*
    |   -- Function belong sheet --
    |
    |   -- Eric 
    |       * index
    |       * addModule
    |       * getSearch
    |       * postSearch
    |       * postModule
    |       * removeModule
    |       * addXml
    |   
    |   -- Leo
    |       *  addUser
    |       *  editUser
    |       *  showQA
    |       *  postAddQuestion
    |       *  postAddAnswer
    |       *  editQuestion
    |       *  postEditQuestion
    |       *  getAnswer
    |       *  editAnswer
    |       *  postEditAnswer
    |       *  removeQuestion
    |       *  removeAnswer
    |       *  postUser
    |       *  postRemoveUser
    |       *  postEditUser
    |     
    |   -- Linda
    |       * editModule
    |       * postEditModule
    |       * addChapter
    |       * postAddChapter    
    | 
    |   -- Oliver
    |       * postEditChapter
    |       * editChapter
    |
    |
    */
    //Show view of all Modules
    public function showModule() 
    {
        $module = Module::all();

        return View::make('admin.module')->with('modules', $module);
    }

	public function index()
	{
        $users = User::all()->count();

        $modules = Module::all();

        $data = array();

        foreach($modules as $module) 
        {

            $rewards = Reward::where('m_id', $module->id)->count();

            $percentage = 0;

            if($rewards != 0)
            {
                $percentage = ($rewards / $users) * 100;
                $percentage = round($percentage, 1, PHP_ROUND_HALF_UP);
            }

            $rest = 100 - $percentage;
            if($percentage != 0)
            {
                $new = array(
                    'id' => $module->id,
                    'name' => $module->name,
                    'percentage' => $percentage,
                    'rest' => $rest
                );

                $data[] = $new;
            }

            
        }

        return View::make('admin.index')->with('stats', $data);
    }
    //Creates a new Module
    public function addModule() 
    {
        return View::make('admin.addModule');
    }


    public function getUsers($page = 0) 

    {
        $skip = $page * 50;

        $users = User::take(50)->skip($skip)->get();

        $u = User::all()->count();

        $x = $u / 50;

        if(is_float($x)) 
        {
            $pages = round($x) +1;
        }
        else {
            $pages = $x;
        }

        return View::make('admin.users')->with('users', $users)->with('pages', $pages);   
    }
    //Creates a new User
    public function addUser() 
    {
        return View::make('admin.addUser');
    }
    //Edit a specific User
    public function editUser($id) 
    {   
        // ::find checks what user with it we are looking for
        $user = User::find($id);

        if(empty($user))    
        {
            return Redirect::route('getUsers')->with('fail', 'Användaren du vill redigera existerar inte.');
        }          
        
        return View::make('admin.editUser')->with('user', $user);
    } 
    //Creates a new Chapter to a specific Module
    public function addChapter($m_id) 
    {
        $module = Module::find($m_id);

        if (empty($module)) 
        {
            return Redirect::route('adminIndex')
            ->with('fail', 'Modulen du vill lägga till ett nytt kapitel till existerar inte.');
        }

        return View::make('admin.addChapter')->with('module', $module);

    }
    //Edit a Chapter to a specific Module
    public function editChapter($m_id, $c_id) 
    {
        $chapter = Chapter::find($c_id);

        if(empty($chapter))
        {
            return Redirect::route('editChapter')
                ->with('fail', 'Kapitlet du vill redigera existerar inte.');
        }

        return View::make('admin.editChapter')
            ->with('chapter', $chapter);
    }
    // Edit a Module
    public function editModule($id) 

    {
        $module = Module::find($id);

        if(empty($module))    
        {
            return Redirect::route('adminIndex')->with('fail', 'Modulen du vill redigera existerar inte.');
        }

        return View::make('admin.editModule')->with('module', $module);
    }
    //Gets all Chapters to a specific Module
    public function getChapter($id) 
    {
        $chapters = Chapter::where('m_id', $id)->get();
        $module = Module::find($id);

        $check = Chapter::where('m_id', $id)
            ->where('isQuestions', 1)
            ->count();

        if ($check == 1) {

            $chapter = Chapter::where('m_id', $id)->where('isQuestions', 1)->first();
            $questions = Question::where('c_id', $chapter->id)->count();

            return View::make('admin.chapter')
                ->with('module', $module)
                ->with('chapters', $chapters)
                ->with('questions', $questions);        
        }

        return View::make('admin.chapter')
            ->with('module', $module)
            ->with('chapters', $chapters);
    }
    //Creates users from Xml-sheet
    public function addXml() 
    {
        return View::make('admin.addXml');
    }
    //Search function for Users
    public function getSearch() 
    {
        return View::make('admin.search');
    }
    //Postfunction for Search for Users    
    public function postSearch($page = 0)
    {
        $string = Input::get('search');
            
        $skip = $page * 50;

        $users = User::where('fname', 'LIKE', '%'.$string.'%')
                ->orWhere('lname', 'LIKE', '%'.$string.'%')
                ->orWhere('email', 'LIKE', '%'.$string.'%')
                ->get();

        $u = User::all()->count();

        $x = $u / 50;

        if(is_float($x)) 
        {
            $pages = round($x) +1;
        }
        else {
            $pages = $x;
        }

        return View::make('admin.users')->with('users', $users)->with('pages', $pages);  

    }
    //Postfunction to Create a new Chapter to a specific Module
    public function postAddChapter($m_id) 
    {
        $validater = Validator::make(Input::all(), array(
            'title' => 'required|min:2'
        ));
        if ($validater->fails())
        {
        return Redirect::route('addChapter', $m_id)->with('fail', 'Kapitlets titel måste vara unikt och minst 2 tecken långt');
        }

        if (Input::get('isQuestions') == 1) {
               
            $findQ = Chapter::where('isQuestions', 1)->where('m_id', $m_id)->count();

            if ($findQ != 0){ 
                return Redirect::route('addChapter', $m_id)->with('fail', 
                    'Denna modul har redan en frågedel, men lägg gärna till ett textavsnitt.');
            }
        }
        $checkChapterNumber = Chapter::where('m_id', $m_id)->max('chapternumber');

        $chapter = new Chapter;
        $chapter->m_id = $m_id;
        $chapter->title = Input::get('title');
        $chapter->chapternumber = $checkChapterNumber+1;
        $chapter->body = Input::get('body');
        $chapter->isQuestions = Input::get('isQuestions');
             
        if($chapter->save())
        {
           
            return Redirect::route('getChapters', $m_id)->with('success', 'Kapitlet är tillagt.');
        }


    }
    //Shows Questions and Answers for a specific Chapter in a specific Module
    public function showQA($id, $cid)
    {   

        $c_id = Chapter::where('id', $cid)->first();

        $m_id = Module::where('id', $id)->first();

        $Q = Question::where('c_id', $cid)->get();

        $A = Answer::where('c_id', $cid)->get();

        return View::make('admin.showQA')
            ->with('Q', $Q)
            ->with('A', $A)
            ->with('m_id', $m_id)
            ->with('c_id', $c_id);

    }
    // Postfunction to Create a new Question
    public function postAddQuestion($m_id, $c_id)
    {
        // validator i a build in checker that make sure the requiments for the inpute is correct with what we want
        $validater = Validator::make(Input::all(), array(
            'question' => 'required'
        ));
            
        if($validater->fails())
        {
            return Redirect::back()->with('fail', 'Du måste fylla i fönstret för att kunna skapa en fråga!');
        }

        $question = new Question;
        $question->m_id = $m_id;
        $question->c_id = $c_id;
        $question->created_at = date('Y-m-d H:i:s');
        $question->updated_at = date('Y-m-d H:i:s');
        $question->body = Input::get('question');
        //saves the inputs from view to database
        if($question->save())
        {
            return Redirect::back()->with('success', 'Du har nu skapat en fråga');
        }

        return Redirect::back()->with('fail', 'Något har gått fel, prova igen');
        
    }
    //Post function to Create a new Answer to a specific Question
    public function postAddAnswer($m_id, $c_id, $q_id)     
    {

        $validater = Validator::make(Input::all(), array(
            'answer' => 'required'
        ));
            
        if($validater->fails())
        {
            return Redirect::back()->with('fail', 'Du måste fylla i fönstret för att kunna skapa ett svar!');
        }
        $correct = 0;

        if(Input::get('correct') != null){
            $correct = 1;
        }
        $answer = new Answer;
        $answer->m_id = $m_id;
        $answer->c_id = $c_id;
        $answer->q_id = $q_id;
        $answer->created_at = date('Y-m-d H:i:s');
        $answer->updated_at = date('Y-m-d H:i:s');
        $answer->body = Input::get('answer');
        $answer->correct = $correct;
                
        if($answer->save())
        {
            return Redirect::route('question', array($m_id, $c_id))->with('success', 'Du har nu skapat ett svar till din fråga!');
        }

        return Redirect::route('question', array($m_id, $c_id))->with('fail', 'Något gick fel, prova igen senare');
    }
    // Edit a Question to a specific Module and Chapter
    public function editQuestion($m_id, $c_id, $question)
    {
        if($question == null){
            return Redirect::back()->with('fail', 'Frågan du vill ändra finns inte');
        }
        $q_id = Question::where('id', $question)->first();

        return View::make('admin.editQuestion')->with('m_id',$m_id)->with('c_id',$c_id)->with('q_id',$q_id);

    }
    //Post function to Edit a Question to a specific Module and Chapter
    public function postEditQuestion($m_id, $c_id, $q_id)
    {

        $question = Question::find($q_id);


        $validation = Validator::make(Input::all(),
            array(
                'question' => 'required'
        ));


        if($validation->fails())
        {
            return Redirect::back()->with('fail', 'Frågan får inte vara tom!');
        }

        $body = Input::get('question');
        $updated_at = date('Y-m-d H:i:s');
        // ::where checkes the id we got from view to update at it
        $question::where('id', $q_id)->update(array(
            'body' => $body,
            'updated_at' => $updated_at
        ));

        return Redirect::route('question', array($m_id, $c_id))->with('success', 'Frågan har nu ändrats!'); 
    }
    //Creates an Answer to a specific Question in a Chapter of a Module
    public function getAnswer($m_id, $c_id, $question)
    {        

        return View::make('admin.addAnswer')->with('m_id',$m_id)->with('c_id',$c_id)->with('q_id',$question);
 
    }  
    //Edit an Answer to a specific Question in a Chapter of a Module
    public function editAnswer($m_id, $c_id, $q_id, $answer)
    {
        $a_id = Answer::find($answer);

        return View::make('admin.editAnswer')->with('m_id',$m_id)->with('c_id',$c_id)->with('a_id',$a_id);
    }
    //Post function of Edit an Answer
    public function postEditAnswer($m_id, $c_id, $a_id)
    {
        $answer = Answer::find($a_id);
        // if answer id is null send back to same page with message
        if($a_id == null){
            return Redirect::route('question', array($m_id, $c_id))->with('fail', 'Svaret du vill ändra finns inte');
        }

        $validation = Validator::make(Input::all(),
            array(
                'answer' => 'required'
        ));

        if($validation->fails())
        {
            return Redirect::back()->with('fail', 'Svaret får inte vara tomt!');
        }

        $correct = 0;

        if(Input::get('correct') != null){
            $correct = 1;
        }

        $body = Input::get('answer');
        $updated_at = date('Y-m-d H:i:s');

        $answer::where('id', $a_id)->update(array(
            'body' => $body,
            'updated_at' => $updated_at,
            'correct' => $correct
        ));

        return Redirect::route('question', array($m_id, $c_id))->with('success', 'Ditt svar har ändrats');
    }
    //Delete function for questions, that removes answers and user answer with it.
    public function removeQuestion($m_id, $c_id, $question)
    {
        $q = Question::find($question);
            
        if(empty($q)) {
            return Redirect::back()->with('fail', 'Modulen du vill ta bort existerar inte');
        }

        $answers = $q->answers();   
        $userAnswers = $q->userAnswer();

        $delAn = true;
        $delUsAn = true;

        if($answers->count() > 0) 
        {
            $delAn = $answers->delete();
        }
        if($userAnswers->count() > 0) 
        {
            $delUsAn = $userAnswers->delete();
        }
            
        if($delAn && $delUsAn && $q->delete())
        {
            return Redirect::route('adminIndex')->with('success', 'Modulen är raderad');
        }
        else 
        {
            return Redirect::route('adminIndex')->with('fail', 'Något gick fel när borttagnigen pågick.');
        }
    }
    // Deletes only the answer for the chosen question
    public function removeAnswer($m_id, $c_id, $a_id)
    {
        $answer = Answer::find($a_id);

        // checks if the id in db and View is the same.

        if(empty($answer)){
            return Redirect::back()->with('fail','Frågan du försöker ta bort finns inte');
        }
        $answer->delete();

        return Redirect::back()->with('success','Frågan är nu borttagen');
    }
    //Post function to Create a Module
    public function postModule()
    {
        $validater = Validator::make(Input::all(), array(
            'name' => 'required|unique:modules|min:2',
            'decal' => 'required'
        ));

        if($validater->fails())
        {
            return Redirect::route('addModule')->with('fail', 'Namnet måste vara unikt och innehålla minst 2 tecken,
            du måste även välja bild!');
        }

        if(Input::file('decal')->isValid())
        {
            $destinationPath = 'img/decals/';
            $extension = Input::file('decal')->getClientOriginalExtension();
            $fileName = rand(111111,999999) . '.' . $extension;
            Input::file('decal')->move($destinationPath, $fileName);

            $module = new Module;
            $module->name = Input::get('name');
            $module->decal = $fileName;
                    
            if($module->save())
            {
                return Redirect::route('getChapters', $module->id)->with('success', 'Modulen är skapad!');
            }
        }

        return Redirect::route('addModule')->with('fail', 'Något gick fel vid skapandet av modulen, prova igen.');
    }
    // Removes a specific Module along with all its content    
    public function removeModule($id) 
    {
        $module = Module::find($id);
            
        if(empty($module)) {
            return Redirect::route('adminIndex')->with('fail', 'Modulen du vill ta bort existerar inte');
        }

        $chapters = $module->chapters();
        $questions = $module->questions();
        $answers = $module->answers();
        $userAnswer = $module->userAnswer();
        
        $delCh = true;
        $delQu = true;
        $delAn = true;
        $delUsAn = true; 
        
        if($chapters->count() > 0) 
        {
            $delCh = $chapters->delete();
        }

        if($questions->count() > 0) 
        {
            $delQu = $questions->delete();
        }

        if($answers->count() > 0) 
        {
            $delAn = $answers->delete();
        }
        
        if($userAnswer->count() > 0)
        {
            $delUsAn = $userAnswer->delete();
        }
            
        if($delCh && $delQu && $delAn && $delUsAn && $module->delete())
        {
            return Redirect::back()->with('success', 'Modulen är raderad');
        }
        else 
        {
            return Redirect::back()->with('fail', 'Något gick fel när borttagnigen pågick, prova igen');
        }
    }
    
    // Post function Create Users (for connection to the application with google.)
    public function postUser()
    {

        $validater = Validator::make(Input::all(), array(
            'email' => 'required|email|unique:users|min:6'
        ));
        
        //  checking that it is a email, and over 2 characters long, and the only one with this email.
        if($validater->fails())
        {

            return Redirect::route('addUser')->with('fail', 'E-mailen måste vara minst 6 tecken lång och innehålla @gmail.com');
        }

         $admin = 0;

        if(Input::get('admin') != null){
            $admin = 1;
        }

        $users = new User;
        $users->fname = Input::get('fname');
        $users->lname = Input::get('lname');
        $users->email = Input::get('email');
        $users->created_at = date('Y-m-d H:i:s');
        $users->updated_at = date('Y-m-d H:i:s');

        //if every thing is okej will our data print in to thes windows
        if($users->save())
            { 
            return Redirect::route('addUser')->with('success', 'Användaren är nu tillagd!');
        }
            
        return Redirect::route('addUser')->with('fail', 'Något gick fel, prova igen.');
      
    }
    //Post function for Removing a specific User
    public function postRemoveUser($id)
    {
        $User = User::find($id);

        // checks if the id in db and View is the same.
        if ($User == null)
        {
            // if for some reason the user dose not exist return to view with message fail.
            return Redirect::route('getUsers')->with('fail', 'Användaren du vill ta bort existerar inte.');
        }

        $User->delete();
        return Redirect::route('getUsers')->with('success', 'Användaren är nu borttagen från systemet.');

                     
    }
    //Post function to Edit a specific Module
    public function postEditModule($id)
    {   
        $validater = Validator::make(Input::all(), array(
            'name' => 'required|min:2'
        ));
            
        if($validater->fails())
        {
            return Redirect::route('editModule', $id)->with('fail', 'Namnet måste vara unikt och innehålla minst 2 tecken');
        }

        $module = Module::find($id);
        if (empty($module)) {
            return Redirect::route('editModule', $id)->with('fail', 'Modulen du vill redigera finns inte.');
        }

        $module = Module::find($id);

        if(Input::file('decal')->isValid())
        {
            File::delete('img/decals/' . Input::get('decalName'));
            $destinationPath = 'img/decals/';
            $extension = Input::file('decal')->getClientOriginalExtension();
            $fileName = rand(111111,999999) . '.' . $extension;
            Input::file('decal')->move($destinationPath, $fileName);

            $module->decal = $fileName;
        }

        $module->name = Input::get('name');
        $module->updated_at = date('Y-m-d H:i:s');

        if($module->save())
        {
            return Redirect::route('showModule', $module->id)->with('success', 'Modulen är redigerad!');
        }

        return Redirect::route('showModule')->with('fail', 'Något gick fel, försök igen eller kontakta administratör');
    }
    //Post function to Edit a specific Chapter in a Specific Module
    public function postEditChapter($m_id, $c_id)
    {
        $chapter = Chapter::find($c_id);

        if(empty($chapter))
        {
            return Redirect::route('getChapters', $m_id);
        }

        $validator = Validator::make(Input::all(), array(
                'title' => 'required|min:2'
        ));

        if($validator->fails())
        {
            return Redirect::route('editChapter', array($m_id, $c_id))
                ->with('fail', 'Titeln måste vara unik och innehålla minst två tecken!');
        }

        $now = date('Y-m-d H:i:s');

        $chapter = Chapter::find($c_id);

        $chapter->title = Input::get('title');
        $chapter->body = Input::get('body');
        $chapter->updated_at = $now;

        if($chapter->save())
        {
            return Redirect::route('getChapters', $m_id)->with('success', 'Du redigerade Kapitlet!');
        }

        return Redirect::route('getChapters', $m_id)->with('fail', 'Något gick fel, prova igen');

    }
    //Post function to Edit a specific User
    public function postEditUser($id)
    {
        $user = User::find($id);

        if(empty($user)) 
        {
            return Redirect::route('getUsers');
        }

        $validation = Validator::make(Input::all(),
            array(
                'fname' => 'required|min:2',
                'lname' => 'required|min:3',
                'email' => 'required|email'
        ));

        if($validation->fails())
        {
            return Redirect::back()->with('fail',
             'Förnamn måste innehålla minst 2 tecken, Efternamn minst 3 tecken och E-mail måste fyllas i.');
        }

        $admin = 0;

        if(Input::get('isAdmin') != null){
            $admin = 1;
        }

        $fname = Input::get('fname');
        $lname = Input::get('lname');
        $email = Input::get('email');
        $updated_at = date('Y-m-d H:i:s');

        $user->fname = $fname;
        $user->lname = $lname;
        $user->email = $email;
        $user->isAdmin = $admin;
        $user->updated_at = $updated_at;

        $user->save();

        return Redirect::route('getUsers'); 
    }
    //Post function to Create User with Xml-sheet  
    public function postXml()
    {
	
		set_time_limit(300);
		
        $path = Input::file('file')->getRealPath();

        
        Excel::load($path, function($reader) {

            $data = $reader->get();

            foreach($data as $row) {

                $rows = User::where('email', $row['e_postadress'])->count();

                if($rows == 0)
                {
                    if($row['status'] == "Administratör")
                    {
                        $admin = 1;
                    }
                    else 
                    {
                        $admin = 0;
                    }

                    $user = new User;

                    $user->email = $row['e_postadress'];
                    $user->fname = $row['fornamn'];
                    $user->lname = $row['efternamn'];
                    $user->isAdmin = $admin;

                    $user->save();
                }
            }

        }, 'UTF-8');   
        return Redirect::route('getUsers')->with('success','Document tillägningen lyckades');
    }
    //Post function to Remove specific Chapter
    public function postRemoveChapter($mid, $id) 
    {
        $Chapter = Chapter::find($id);
            
        if(empty($Chapter)) {
            return Redirect::route('adminIndex')->with('fail', 'Kaptitlet du vill ta bort existerar inte');
        }

        $questions = $Chapter->questions();
        $answers = $Chapter->answers();
        $userAnswer = $Chapter->userAnswer();
        
        
        $delQu = true;
        $delAn = true;
        $delUsAn = true; 
        
        if($questions->count() > 0) 
        {
            $delQu = $questions->delete();
        }

        if($answers->count() > 0) 
        {
            $delAn = $answers->delete();
        }
        
        if($userAnswer->count() > 0)
        {
            $delUsAn = $userAnswer->delete();
        }
            
        if($delQu && $delAn && $delUsAn && $Chapter->delete())
        {
            return Redirect::route('getChapters', $mid)->with('success', 'Kapitlet är borttaget');
        }
        else 
        {
            return Redirect::route('adminIndex')->with('fail', 'Något gick fel och Kapitlet är ej borttaget, prova igen.');
        }
    }
    
}
