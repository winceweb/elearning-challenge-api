<?php  namespace App\Http\Controllers;

use App\Problematic;
class ProblematicController extends Controller{
	public function index(){

		$problematics = Problematic::with('user')->get();
		return $this->success($problematics, 200);
	}

	public function show($id){

		$problematic = Problematic::with('user')->find($id);
		if(!$problematic){
			return $this->error("La problématique N°  {$id} n'existe pas", 404);
		}
		return $this->success($problematic, 200);
	}
}
