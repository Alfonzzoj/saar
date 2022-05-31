<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;


class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

    protected $loginPath     ="/";

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => ['getLogout', 'getLogoutRemember']]);
	}

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('index');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'userName' => 'required', 'password' => 'required',
        ]);
        $userName   =$request->get('userName');
        $aeropuerto =\App\Aeropuerto::find($request->get('aeropuerto_id'));
        $user       =\App\Usuario::where('userName', $userName)->first();
        if(!$user){
            return redirect('/');
        }
        $rol        =$user->roles->first();
        $request->session()->put('user', $user);
        $request->session()->put('rolUsuario', $rol);

        if($user->estado == 1){
            $ingreso=0;
            foreach ($user->aeropuertos as $autorizado) {
                if($autorizado->id==$aeropuerto->id){

                    $credentials = $request->only('userName', 'password');

                    if ($this->auth->attempt($credentials, false))
                    {
                        session(["aeropuerto"=> $aeropuerto]);
                        $ingreso=1;
                        if ($rol->id == 1 || $rol->id == 2 || $rol->id == 10){
                            return redirect()->action('DashboardController@indexSCV');
                        }elseif ($rol->id == 3){
                            return redirect()->action('DashboardController@indexRecaudacion');
                        }elseif ($rol->id == 7){
                            return redirect()->action('DashboardController@indexOpRecaudacion');
                        }elseif ($rol->id == 8){
                            return redirect()->action('DashboardController@indexDireccion');
                        }else{
                            return redirect()->action('DashboardController@indexOtros');
                        }
                    }

                    return redirect($this->loginPath())
                                        ->withInput($request->only('userName', 'remember'))
                                        ->withErrors([
                                            'userName' => $this->getFailedLoginMessage(),
                                    ]);

                }
            }
            if($ingreso==0){
                return redirect($this->loginPath())
                    ->withInput($request->only('userName', 'remember'))
                    ->withErrors([
                        'userName' => 'Acceso Denegado: Aeropuerto no Autorizado.',
                ]);
            }
        }else{
            return redirect($this->loginPath())
                                ->withInput($request->only('userName', 'remember'))
                                ->withErrors([
                                    'AccesoDenegado' => 'Acceso Denegado: Usuario Inhabilitado',
                                ]);
        }
    }

    public function getLogout(Guard $auth)
    {
        $errors=null;
        if(\Session::has('errors')){
            $errors = \Session::get('errors')->all();
        }

        session()->forget('aeropuerto');
        $auth->logout();
        return redirect('/')->withErrors($errors);
    }


    public function getLogoutRemember(Guard $auth)
    {
        $errors=["Sesión Expirada."];
        session()->put('url.intended', \URL::previous());
        session()->forget('aeropuerto');
        $auth->logout();
        return redirect('/')->withErrors($errors);
    }



}
