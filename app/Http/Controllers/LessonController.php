<?php  namespace App\Http\Controllers;

use App\Lesson;
use App\Category;
use Illuminate\Http\Request;

class LessonController extends Controller{
	public function __construct(){
		$this->middleware('oauth', ['except' => ['index', 'show']]);
		$this->middleware('authorize:' . __CLASS__, ['except' => ['index', 'show', 'store']]);
	}

	public function index(){
		$lessons = Lesson::all();
		return $this->success($lessons, 200);
	}

	public function byCategory($id){
		$category = Category::find($id);

		if(!$category){
			return $this->error("La catégorie  N° {$id} n'existe pas", 404);
		}

		$lessons = $category->lessons;
		return $this->success($lessons, 200);
	}

	public function store(Request $request){
		$this->validateRequest($request);
		$lesson = Lesson::create([
					'subject'    => $request->get('subject'),
					'content'    => $request->get('content'),
          'endDate'    => $request->get('endDate'),
					'startDate'  => $request->get('startDate'),
          'idCategory' => $request->get('idCategory'),
					'idUser'     => $this->getUserId()
				]);
		return $this->success("La Leçon N° {$lesson->id} a été créée", 201);
	}

	public function show($id){
		$lesson = Lesson::find($id);
		if(!$lesson){
			return $this->error("La Leçon N° {$id} n'existe pas", 404);
		}
		return $this->success($lesson, 200);
	}

	public function update(Request $request, $id){
		$lesson = Lesson::find($id);
		if(!$lesson){
			return $this->error("La Leçon N° {$id} n'existe pas", 404);
		}
		$this->validateRequest($request);
		$lesson->subject 		= $request->get('subject');
		$lesson->content 		= $request->get('content');
    $lesson->endDate 		= $request->get('endDate');
		$lesson->startDate 	= $request->get('startDate');
    $lesson->idCategory = $request->get('idCategory');
		$lesson->idUser 		= $this->getUserId();
		$lesson->save();
		return $this->success("La Leçon N° {$lesson->id} a été modifiée", 200);
	}

	public function destroy($id){
		$lesson = Lesson::find($id);
		if(!$lesson){
			return $this->error("La Leçon N° {$id} n'existe pas", 404);
		}

		$lesson->delete();
		return $this->success("La Leçon N° {$id} a été supprimé", 200);
	}

	public function validateRequest(Request $request){
		$rules = [
			'subject' => 'required',
			'content' => 'required'
		];
		$this->validate($request, $rules);
	}

	public function isAuthorized(Request $request){
		$resource = "Lesson";
		$lesson     = Lesson::find($this->getArgs($request)["id"]);
		return $this->authorizeUser($request, $resource, $lesson);
	}
}
