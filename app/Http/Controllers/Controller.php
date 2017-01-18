<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;
use Gate;

class Controller extends BaseController
{

  public function success($data, $code){
    return response()->json(['data' => $data], $code);
  }


  public function error($message, $code){
    return response()->json(['message' => $message], $code);
  }

  protected function authorizeUser(Request $request, $resource, $arguments = []){
    $user 	 = User::find($this->getUserId());
    $action	 = $this->getAction($request);
    $ability = "{$action}-{$resource}";
    return Gate::forUser($user)->allows($ability, $arguments);
  }

  public function isAuthorized(Request $request){
    return false;
  }


  protected function getUserId(){
    return \LucaDegasperi\OAuth2Server\Facades\Authorizer::getResourceOwnerId();
  }

  protected function getAction(Request $request){
    return explode('@', $request->route()[1]["uses"], 2)[1];
  }

  protected function getArgs(Request $request){
    return $request->route()[2];
  }
}
