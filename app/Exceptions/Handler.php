<?php

namespace App\Exceptions;

use Exception;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        // SQLでエラーが起きた場合、用意したエラー画面へ飛ばす。
        if ($exception instanceof QueryException) {
            $sql_error_code = $exception->errorInfo[0];
            $error_message = "SQLでエラーが発生しました。";
            switch ($sql_error_code) {
                case 23000 : $error_message = "整合性制約違反です。";
            }

            return response()->view('error/system_error',compact('error_message','user'));
        }

        return parent::render($request, $exception);
    }
}
