<?php
namespace App\Http\Controllers;
use App\Rating;
use Illuminate\Http\Request;
use App\Transformer\RatingTransformer;
/**
 * Manage an Author's Ratings
 */
class RatingsController extends Controller
{
    public function __construct()
    {
      $this->middleware('oauth', ['except' => ['index', 'show']]);
      $this->middleware('authorize:' . __CLASS__, ['except' => ['index', 'show', 'store']]);
    }

    public function show($rateable_type, $rateable_id)
    {
      $val_rating = Rating::where([ ['rateable_id', '=', $rateable_id],
                                    ['rateable_type', '=', $rateable_type]
                                  ])->avg('value');

    //  ROUND(AVG(value), 1) as notes
      return $this->success(round($val_rating, 0), 200);
    }

    public function store(Request $request)
    {
        if ($this->getUserId() == $request->get('idUser'))
        {
          return $this->error("Vous n'avez pas le droit de voter sur vos contenus", 404);
        }
        else
        {
          $rate = Rating::where([
                                  ['rateable_id', '=', $request->get('rateable_id')],
                                  ['rateable_type', '=', $request->get('rateable_type')],
                                  ['idUser', '=', $this->getUserId()],
                                ])->get()->count();
          if($rate != 0)
          {
            return $this->error("Vous n'avez pas le droit de voter 2 fois sur un meme contenu", 404);
          }
          else
          {
            $this->validateRequest($request);
            $rating = Rating::create([
                'value' => $request->get('value'),
                'rateable_id' => $request->get('rateable_id'),
                'rateable_type' => $request->get('rateable_type'),
                'idUser' => $this->getUserId()
              ]);
            return $this->success("Vote Reussi", 201);
          }
        }
    }

    public function validateRequest(Request $request){
      $rules = [
        'value' => 'required',
        'rateable_id' => 'required',
        'rateable_type' => 'required'
      ];
      $this->validate($request, $rules);
    }

    public function isAuthorized(Request $request){
      $resource = "Rating";
      $rating     = Rating::find($this->getArgs($request)["id"]);
      return $this->authorizeUser($request, $resource, $lesson);
    }
 }
