<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
/**
 * If the incoming request is an OPTIONS request
 * we will register a handler for the requested route
 */
class CatchAllOptionsRequestsProvider extends ServiceProvider {
    public function register()
    {
        $request = app('request');
        if ($request->isMethod('OPTIONS'))
        {
            $response = response('', 200);
            if ($request->headers->has('Origin')) {
                $response->header('Access-Control-Allow-Credentials', 'true')
                    ->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE')
                    ->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'))
                    ->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
            }
            app()->options($request->path(), function() use ($response) { return $response; });
        }
    }
}
