<?php namespace AllAccessRMS\Exceptions;

use Log;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

use Laracasts\Flash\Flash;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
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
        if ($e instanceof TokenMismatchException) 
        {
            //Redirect to login form if session expires
            Flash::error("The login form has expired, please try again. 
                        In the future, reload the login page if it has been open for several hours.");
            return redirect('/auth/login');
        }

        if ($e->getStatusCode() == 401)
        {
            return response()->view('errors.accessdenied', [], 401);
        }
        //else
        //{
            //Flash::overlay('Error: something went wrong!  Please review the log.');
            //Log::error($e);
            //return redirect()->back();
        //}

        return parent::render($request, $e);
    }

    public static function HandleError(Exception $e)
    {
        return response()->view('errors.error_dump', [
            'exception'=> "Error: " . $e->getMessage(), 
            'stacktrace' => $e]);
    }
}
