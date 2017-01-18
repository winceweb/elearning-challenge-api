<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

	public function __construct(){

		$this->middleware('oauth', ['except' => ['index', 'show']]);
		$this->middleware('authorize:' . __CLASS__, ['except' => ['index', 'show']]);
	}

	public function index(){

		$User = User::all();
		return $this->success($User, 200);
	}

	public function store(Request $request){

		$this->validateRequest($request);

		$user = User::create([
					'email' => $request->get('email'),
					'password'=> Hash::make($request->get('password')),
          'name' => $request->get('name'),
          'isTeacher' => $request->get('isTeacher'),
          'isActive' => $request->get('isActive'),
				]);

		return $this->success("L'utilisateur avec l'id: {$user->id} est crée", 201);
	}

	public function show($id){

		$user = User::find($id);

		if(!$user){
			return $this->error("L'utilisateur avec l'id: {$id} n'existe pas", 404);
		}

		return $this->success($user, 200);
	}

	public function update(Request $request, $id){

		$user = User::find($id);

		if(!$user){
			return $this->error("L'utilisateur avec l'id: {$id} n'existe pas", 404);
		}

		$this->validateRequest($request);

		$user->email 		  = $request->get('email');
    $user->name       = $request->get('name');
    $user->isTeacher  = $request->get('isTeacher');
    $user->isActive   = $request->get('isActive');
		$user->password 	= Hash::make($request->get('password'));

		$user->save();

		return $this->success("L'utilisateur avec l'id: {$user->id} a bien été modifié", 200);
	}

	public function destroy($id){

		$user = User::find($id);

		if(!$user){
			return $this->error("L'utilisateur avec l'id: {$id} n'existe pas", 404);
		}

		$user->delete();

		return $this->success("L'utilisateur avec l'id: {$id} a bien été supprimé", 200);
	}

	public function validateRequest(Request $request){

		$rules = [
			'email' => 'required|email|unique:User',
			'password' => 'required|min:6'
		];

		$this->validate($request, $rules);
	}

	public function isAuthorized(Request $request){

		$resource = "User";
		// $user     = User::find($this->getArgs($request)["user_id"]);

		return $this->authorizeUser($request, $resource);
	}
}