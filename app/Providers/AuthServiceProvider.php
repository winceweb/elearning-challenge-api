<?php namespace App\Providers;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Boot the authentication services for the application.
     *
     * @return void
     * @see    https://lumen.laravel.com/docs/authorization
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        // $this->app['auth']->viaRequest('api', function ($request) {
        //     if ($request->input('api_token')) {
        //         return User::where('api_token', $request->input('api_token'))->first();
        //     }
        // });
        // Group & Define simillar Abilities
        $this->isOwner([
            'lesson' => ['store', 'destroy', 'update']
        ]);
        $this->isTeacher([
            'lesson' => ['store', 'destroy', 'update']
        ]);
    }
    /**
     * Define abilities that checks if the current user is the owner of the requested resource.
     * In case of admin user, it will return true.
     *
     * @param  array  $arguments
     * @return boolean
     */
    private function isOwner($arguments = []){
        foreach ($arguments as $resource => $actions) {
            foreach ($actions as $action) {
                Gate::before(function ($user, $ability) {
                    if($user->isTeacher){
                     return true;
                    }
                });
                Gate::define($this->ability($action, $resource), function ($user, $arg) {

                    if(is_null($arg))  { return false; }
                    return $arg->idUser === $user->id || $user->isTeacher;
                });
            }
        }
    }
    /**
     * Define abilities that checks if the current user is admin.
     *
     * @param  array  $arguments
     * @return boolean
     */
    private function isTeacher($arguments){
        foreach ($arguments as $resource => $actions) {
            foreach ($actions as $action) {
                Gate::define($this->ability($action, $resource), function ($user) {
                    return $user->isTeacher;
                });
            }
        }
    }
    /**
     * Define ability string.
     *
     * @param  string  $action
     * @param  string  $resource
     * @return string
     */
    private function ability($action, $resource){
        return "{$action}-{$resource}";
    }

}
