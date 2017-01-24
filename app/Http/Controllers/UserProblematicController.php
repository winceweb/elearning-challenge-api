<?php  namespace App\Http\Controllers;

use App\User;
use App\Problematic;

use Illuminate\Http\Request;

class UserProblematicController extends Controller{

	public function __construct(){

		// $this->middleware('oauth', ['except' => ['index', 'show']]);
		// $this->middleware('authorize:' . __CLASS__, ['except' => ['index', 'show', 'store']]);
	}

	public function index($idUser){

		$user = User::find($idUser);

		if(!$user){
			return $this->error("Le User N° {$idUser} n'existe pas", 404);
		}

		$problematics = $user->problematics;
		return $this->success($problematics, 200);
	}


	// public function isAuthorized(Request $request){
	//
	// 	$resource  = "Problematic";
	// 	$problematic   = Problematic::find($this->getArgs($request)["idProblematic"]);
	//
	// 	return $this->authorizeUser($request, $resource, $problematic);
	// }
}
