<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{

        if ($e instanceof TokenMismatchException) {
            if($request->ajax())
                return response('Reload page', 498);
            return back()->withErrors([['El token de seguridad ha expirado. Por favor intente de nuevo']]);
        }

        $aux=$e;
        do {
           if($aux instanceof \Bican\Roles\Exceptions\RoleNotFoundException)
               return redirect("logout")->withErrors(["El usuario no tiene un rol asignado"]);
        } while($aux = $aux->getPrevious());

		return parent::render($request, $e);
	}

}
