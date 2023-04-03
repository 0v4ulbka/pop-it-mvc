<?php
use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup'])
    ->middleware('admin');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/employers', [Controller\Employers::class, 'employers', 'name_job_title']);
Route::add(['GET', 'POST'], '/users', [Controller\Users::class, 'users'])
    ->middleware('admin');
Route::add(['GET', 'POST'], '/addEmployer', [Controller\Employers::class, 'addEmployer']);