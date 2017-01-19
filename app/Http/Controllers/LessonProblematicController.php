<?php  namespace App\Http\Controllers;

use App\Lesson;
use App\Problematic;

use Illuminate\Http\Request;

class LessonProblematicController extends Controller{

	public function __construct(){

		$this->middleware('oauth', ['except' => ['index', 'show']]);
		$this->middleware('authorize:' . __CLASS__, ['except' => ['index', 'show', 'store']]);
	}

	public function index($idLesson){

		$lesson = Lesson::find($idLesson);

		if(!$lesson){
			return $this->error("La Leçon N° {$idLesson} n'existe pas", 404);
		}

		$problematics = $lesson->problematics;
		return $this->success($problematics, 200);
	}

	public function store(Request $request, $idLesson){

		$lesson = Lesson::find($idLesson);

		if(!$lesson){
			return $this->error("La Leçon N° {$idLesson} n'existe pas", 404);
		}

		$this->validateRequest($request);

		$problematic = Problematic::create([
				'movieUrl' => $request->get('movieUrl'),
				'caption' => $request->get('caption'),
				'entitled' => $request->get('entitled'),
				'idUser'=> $this->getUserId(),
				'idLesson'=> $idLesson
			]);

		return $this->success("La problématique N° {$problematic->id} a été créée et affectée à la leçon N° id {$idLesson}", 201);
	}

	public function update(Request $request, $idLesson, $idProblematic){

		$problematic 	= Problematic::find($idProblematic);
		$lesson 		= Lesson::find($idLesson);

		if(!$problematic || !$lesson){
			return $this->error("La problématique N° {$idProblematic} et/ou la leçon N° id {$idLesson} n'existent pas", 404);
		}

		$this->validateRequest($request);

		$problematic->movieUrl 		= $request->get('movieUrl');
		$problematic->caption 		= $request->get('caption');
		$problematic->entitled 		= $request->get('entitled');
		$problematic->idUser 		= $this->getUserId();
		$problematic->idLesson 		= $idLesson;

		$problematic->save();

		return $this->success("La problématique N° {$problematic->id} a été modifiée", 200);
	}

	public function destroy($idLesson, $idProblematic){

		$problematic 	= Problematic::find($idProblematic);
		$lesson 		= Lesson::find($idLesson);

		if(!$problematic || !$lesson){
			return $this->error("La problématique N° {$idProblematic} ou La leçon N° id {$idLesson} n'existe pas", 404);
		}

		if(!$lesson->problematics()->find($idProblematic)){
			return $this->error("La problématique N° {$idProblematic} n'est pas affectée à la Leçon N° {$idLesson}", 409);
		}

		$problematic->delete();

		return $this->success("La problématique N° {$idProblematic} a été retirée de la leçon N° {$idLesson}", 200);
	}

	public function validateRequest(Request $request){

		$rules = [
			'movieUrl' => 'required',
			'caption' => 'required',
			'entitled' => 'required'
		];

		$this->validate($request, $rules);
	}

	public function isAuthorized(Request $request){

		$resource  = "Problematic";
		$problematic   = Problematic::find($this->getArgs($request)["idProblematic"]);

		return $this->authorizeUser($request, $resource, $problematic);
	}
}
