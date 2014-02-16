<?php

class ThemesController extends BaseController {
	// Deprecated
	public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('edit', 'update')));
	}

	public function edit($id) {
		$user = User::find($id);
		if (Auth::user()->id == $user->id) {
			return View::make('themes.edit')->with('user', $user);
		} else {
			//warning, attacker!
 	    return Redirect::to('/');
 	  }
	}

	public function update($id) {
		// TODO: except password & email
		$user = User::find($id);
		if (Auth::user()->id == $user->id) {
			$user->theme = Input::get('theme');
	    $user->save();

			return Redirect::to('spaces/'.$id)->with('message', 'Profile updated');
		} else {
			//warning, attacker!
  	  return Redirect::to('/');
		}
	}
}