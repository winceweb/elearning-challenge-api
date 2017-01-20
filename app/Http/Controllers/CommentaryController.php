<?php  namespace App\Http\Controllers;

use App\Problematic;
class CommentaryController extends Controller{
	public function index(){

		$commentaries = Commentary::all();
		return $this->success($commentaries, 200);
	}

	public function show($id){

		$commentary = Commentary::find($id);
		if(!$commentary){
			return $this->error("Le commentaire N°  {$id} n'existe pas", 404);
		}
		return $this->success($commentary, 200);
	}
}
