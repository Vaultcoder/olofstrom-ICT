<?php

class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function getLogin() {
        return View::make('user.login');
    }
    
    public function googleLogin()
    {
        // get data from input
        $code = Input::get( 'code' );

        // get google service
        $googleService = OAuth::consumer( 'Google' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken( $code );
            
            // Send a request with it
            $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

            //$message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'] . ' raaawr ' . $result['email'];
            //echo $message. "<br/>";

				
            $validate = Validator::make($result, array(
                'email' => 'required|unique:users'
            ));
				
		  
            if($validate->fails()){
                $now = date('Y-m-d H:i:s');
                $email = $result['email'];
                //Getting the users ID from database
                $user = User::where('email', $email)->first();
                
                
                
                if(empty($user['profile_img']) OR substr($user['profile_img'], 0, 5) == "https") {
                    User::where('email', $email)->update(array('profile_img' => $result['picture']));
                }
                //Logging in by Id
                Auth::loginUsingId($user['id']);
			
                //Check if the user got logged in 
                if(Auth::check()) {
                    return Redirect::to('/')->with('success', 'CONGRATZ YOU **** IDIOT');
                }
                else {
                    return Redirect::to('/auth/login')->with('fail', 'Något gick fel, kontakta administratör');
                }
            }
            else {
                return Redirect::to('/auth/login')->with('fail', 'Du finns inte som medlem på sidan, kolla så du är inloggad på rätt gmail.');
            }
				
        }
        // if not ask for permission first
        else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to google login url
            return Redirect::to( (string)$url );
        }
    }
	
    //Function for logging out
    public function getLogout() {
        //logging out of the Auth Session
        Auth::logout();
		
        //Redirect to view for login
	   return Redirect::to('/auth/login');
    }
}
