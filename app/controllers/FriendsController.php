<?php

class FriendsController extends BaseController {
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth',array('only'=>array('addFriend', 'acceptFriend', 'removeFriend')));	
	}

	public function showFriend() {
		// get all friends
		$user = Auth::user();

		//show the view and pass the friends to it
		return View::make('friends.showFriend')
				->with('user',$user);
	}

	public function addFriend() {
		$user_id = Auth::user()->id;
		$user = Auth::user();
		$current_url = Session::get('current_url');
		Session::forget('current_url');

		$rules = array(
			'friend_id' => 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		//redirect to home if error
		if ($validator->fails()) {
			return Redirect::to('spaces/'.$user_id)->with('warning', 'Error add friend');
		} 
		else {
			//Get the input
			$friend_id = Input::get('friend_id');
			
			//Check if id exist
			if (!User::find($friend_id)->exists()){
				Session::flash('warning', 'Cannot befriend, user is not exist!');
				Redirect::to($current_url);
			}

			//Check if already friend
			if ($user->friends()->where('friend_id','=',$friend_id)->exists()){
				Session::flash('message', 'Already become friend');
				Redirect::to($current_url);
			}

			//Check if already request friend
			if (User::find($friend_id)->friendRequests()->where('friend_id','=',$user_id)->exists()){
				Session::flash('message', 'Already send request');
				Redirect::to($current_url);
			}


			$friend_request = new FriendRequest;
			$friend_request->friend_id = $user_id;
			$friend_request->owner_id = $friend_id;
			$friend_request->save();

			//refresh
			Session::flash('message', 'Successfully add friend!');
			return Redirect::to($current_url);
		}
	}

	public function acceptFriend() {
		$user_id = Auth::user()->id;
		$current_url = Session::get('current_url');
		Session::forget('current_url');

		$rules = array(
			'friend_id' => 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		//redirect to home if error
		if ($validator->fails()) {
			return Redirect::to($current_url)->with('warning', 'Error add friend');
		} 
		else {
			//get the input friend_id
			$friend_id = Input::get('friend_id');
			
			//Check if friend request really exist
			if (!User::find($user_id)->friendRequests()->where('friend_id','=',$friend_id)->exists()){
				Session::flash('warning','Friend request not exist');
				Redirect::to($current_url);
			}



			//get and delete the friend_request
			$friend_request = User::find($user_id)->friendRequests()->where('friend_id', '=', $friend_id)->firstOrFail();
			$friend_request->delete();
			

			//store the new friend
			$friend1 = new Friend;
			$friend1->friend_id = $friend_id;
			$friend1->owner_id = $user_id;
			$friend1->save();
			
			$friend2 = new Friend;
			$friend2->friend_id = $user_id;
			$friend2->owner_id = $friend_id;
			$friend2->save();
		}

		//redirect
		Session::flash('message', 'Successfully accept friend!');
		return Redirect::to($current_url);
	}

	public function removeFriend() {
		$user_id = Auth::user()->id;
		$user = Auth::user();
		$current_url = Session::get('current_url');
		Session::forget('current_url');

		$rules = array(
			'friend_id' => 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		//redirect to home if error
		if ($validator->fails()) {
			return Redirect::to($current_url)->with('warning', 'Error add friend');
		} 
		else {
			//get the entry friend_id
			$friend_id = Input::get('friend_id');

			//Check if really are friend
			if (!$user->friends()->where('friend_id','=',$friend_id)->exists()){
				Session::flash('warning', 'Cannot remove non friend');
				Redirect::to($current_url);
			}

			//get the friend row
			$friend1 = User::find($user_id)->friends()->where('friend_id', '=', $friend_id);
			$friend2 = User::find($friend_id)->friends()->where('friend_id', '=', $user_id);

			//delete the entry

			$friend1->delete();
			$friend2->delete();
		}
		//redirect
		Session::flash('message', 'Successfully remove friend!');
		return Redirect::to($current_url);
	}

}




