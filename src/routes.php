<?php

use Illuminate\Routing\Router;
use Orchestra\Support\Facades\Foundation;

/*
|--------------------------------------------------------------------------
| Routing
|--------------------------------------------------------------------------
*/

Foundation::group('bluschool/exam', 'exam', ['namespace' => 'Bluschool\Exam\Http\Controllers'], function (Router $router)
{
    $router->post('printing/pdf/batch', 'PrintingController@batchPrinting');

    $router->post('member/registration', 'HostController@store');
    $router->get('member/registration', 'HostController@create');
    $router->get('member', 'HostController@index');
    $router->get('/', 'HomeController@index');
});