<?php

class UserController extends BaseController {


	public function index()
	{
		$users = User::all();

		return View::make('users.index')
		->with('users', $users);
	}


	public function create()
	{
		return View::make('users.create');
	}


	public function store()
	{

		$rules = array(
			'username'   => 'required|unique:users',
			'email'      => 'required|email|unique:users',
			'password'   => 'required|min:6',
			'confirm_password' => 'required'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) 
		{
			return Redirect::to('register')
			->withErrors($validator)
			->withInput(Input::except('password'));
		} 
		else 
		{

			$code = str_random(60);

			$user = new User;
			$user->username      = Input::get('username');
			$user->email      	 = Input::get('email');
			$user->code 		 = $code;

			if (Input::get('confirm_password') !== Input::get('password')) {
				return Redirect::to('register')->withErrors('Not the same password.');
			}

			if (Input::get('confirm_password') == Input::get('password')) {
				$user->password 	 = Hash::make(Input::get('password'));
				$user->save();
			}
			
			if ($user)
			{
				Mail::send('emails.activate', array(
					'link' => URL::route('account-activate', $code), 
					'username' => Input::get('username')), 
					function($message) use ($user) {      
					$message->to($user->email, $user->username)->subject('cards in my box :: Activation');
				});
			}

			return Redirect::to('')->with('success', 'Vous êtes désormais inscrit. Veuillez activer votre compte par mail.');
		}
	}


	public function getActivate($code)
	{
		$user = User::where('code', '=', $code)->where('active', '=', 0);

		if ($user->count()) 
		{
			$user = $user->first();

			$user->active = 1;
			$user->code = '';

			if ($user->save())
			{
				return Redirect::to('login')->with('success', 'Votre compte a été activé, vous pouvez désormais vous connecter.');
			}
		}

		return Redirect::to('')->with('error', 'Votre compte n\'a pas pu être activé.');
	}


	public function show($username)
	{
		$user = DB::table('users')
		->where('username', $username)
		->first();

		return View::make('users.show')
		->with('user', $user);
	}
	
	public function edit($id)
	{
		$user = User::find($id);

		return View::make('users.edit')
		->with('user', $user);
	}


	public function profile()
	{
		$user = User::find(Auth::user()->id);

		return View::make('users.profile')
		->with('user', $user);
	}


	public function update($id)
	{
		$rules = array(
			'username'       	=> 'required',
			'email'      		=> 'required|email'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('user/' . $id . '/edit')
			->withErrors($validator)
			->withInput(Input::except('password'));
		} else {

			$user = User::find($id);
			$user->username       	= Input::get('username');
			$user->email      		= Input::get('email');
			$user->password      	= Input::get('password');
			$user->birthdate 		= Input::get('birthdate');
			$user->location 		= Input::get('location');
			$user->bio 				= Input::get('bio');
			$user->website 			= Input::get('website');
			$user->twitter 			= Input::get('twitter');
			$user->facebook 		= Input::get('facebook');
			$user->instragram 		= Input::get('instragram');
			$user->save();

			$file = Input::file('file');
			$destinationPath = 'public/images/avatars';
			$filename = str_random(20);
			$extension = $file->getClientOriginalExtension(); 
			$type = $file->getMimeType();
			$size = Input::file('file')->getSize();
			$upload_success = Input::file('file')->move($destinationPath, $filename . '.' . $extension);

			if( $upload_success ) {
				Image::create(['name'       => $filename,
					'user_id'    			=> Auth::user()->id,
					'categorie'				=> 'avatars',
					'url'        			=> 'images/avatars' . '/' . $filename . '.' . $extension,
					'size'					=> $size,
					'extension'   			=> $file->getClientOriginalExtension(),
					'type'					=> $type
					]);
			}

			return Redirect::to('')->with('success', 'Le profil a bien été modifié.');
		}
	}



	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();

		return Redirect::to('users')->with('success', 'Membre supprimé.');
	}

	public function showLogin()
    {
        if (Auth::check())
        {
            return Redirect::to('')->with('success', 'Vous êtes déjà connecté.');
        }

        return View::make('users.login');
    }


    public function postLogin()
    {
    	$userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
            );

        $rules = array(
            'username'  => 'Required',
            'password'  => 'Required'
            );

        $validator = Validator::make($userdata, $rules);

        if ($validator->passes())
        {
            if (Auth::attempt(array(
            	'username' => Input::get('username'),
            	'password' => Input::get('password'),
            	'active' => 1
            	)))
            {
                return Redirect::to('')->with('success', 'Vous êtes bien connecté.');
            }

            else
            {
                return Redirect::to('login')->with('error', 'Mauvais identifiant/Mot de passe ou Compte non activé')->withInput(Input::except('password'));
            }
        }

        return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
    }


    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('')->with('info', 'Vous venez de vous déconnecter.');
    }
    
   



}