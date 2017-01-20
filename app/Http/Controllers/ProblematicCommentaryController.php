<?php  namespace App\Http\Controllers;

use App\Problematic;
use App\Commentary;

use Illuminate\Http\Request;

class ProblematicCommentaryController extends Controller{

	public function __construct(){

		$this->middleware('oauth', ['except' => ['index', 'show']]);
		$this->middleware('authorize:' . __CLASS__, ['except' => ['index', 'show', 'store']]);
	}

	public function index($idProblematic){

		$problematic = Problematic::find($idProblematic);

		if(!$problematic){
			return $this->error("La problématique N° {$idProblematic} n'existe pas", 404);
		}

		$commentarys = $problematic->commentaries;
		return $this->success($commentarys, 200);
	}

	public function store(Request $request, $idProblematic){

		$problematic = Lesson::find($idProblematic);

		if(!$problematic){
			return $this->error("La problématique N° {$idProblematic} n'existe pas", 404);
		}

		$this->validateRequest($request);

		$commentary = Problematic::create([
				'description' => $request->get('description'),
				'idUser'=> $this->getUserId(),
				'idProblematic'=> $idProblematic
			]);

		return $this->success("Le commentaire N° {$commentary->id} a été créé et affecté à la problématique N° id {$idProblematic}", 201);
	}

	public function update(Request $request, $idProblematic, $idCommentary){

		$commentary 	= Problematic::find($idCommentary);
		$problematic 		= Lesson::find($idProblematic);

		if(!$commentary || !$problematic){
			return $this->error("Le commentaire N° {$idCommentary} et/ou la problématique N° id {$idProblematic} n'existent pas", 404);
		}

		$this->validateRequest($request);

		$commentary->description 		= $request->get('description');
		$commentary->idUser 		= $this->getUserId();
		$commentary->idProblematic 		= $idProblematic;

		$commentary->save();

		return $this->success("Le commentaire N° {$commentary->id} a été modifiée", 200);
	}

	public function destroy($idProblematic, $idCommentary){

		$commentary 	= Problematic::find($idCommentary);
		$problematic 		= Lesson::find($idProblematic);

		if(!$commentary || !$problematic){
			return $this->error("Le commentaire N° {$idCommentary} ou La problématique N° id {$idProblematic} n'existe pas", 404);
		}

		if(!$problematic->problematics()->find($idCommentary)){
			return $this->error("Le commentaire N° {$idCommentary} n'est pas affectée à la problématique N° {$idProblematic}", 409);
		}

		$commentary->delete();

		return $this->success("Le commentaire N° {$idCommentary} a été retirée de la problématique N° {$idProblematic}", 200);
	}

	public function validateRequest(Request $request){

		$rules = [
			'description' => 'required'
		];

		$this->validate($request, $rules);
	}

	public function isAuthorized(Request $request){

		$resource  = "Commentary";
		$commentary   = Commentary::find($this->getArgs($request)["idCommentary"]);

		return $this->authorizeUser($request, $resource, $commentary);
	}
}
