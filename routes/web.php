<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//========= Site =========//
Route::get('/', 'Site\Http\Controllers\HomeController@index')->name('home');

Route::get('/articles', 'Site\Http\Controllers\Articles\ArticlesController@index')->name('articles');
Route::get('/articles/{article}', 'Site\Http\Controllers\Articles\ArticlesController@show')->name('articles.show');


Route::get('/about', 'Site\Http\Controllers\Pages\AboutController@index')->name('about');
Route::post('/about', 'Site\Http\Controllers\Pages\AboutController@store')->name('about.store');

Route::get('/contacts', 'Site\Http\Controllers\Pages\ContactsController@index')->name('contacts');
Route::post('/contacts', 'Site\Http\Controllers\Pages\ContactsController@store')->name('contacts.store');


//==== State ====//
Route::group(
    [
        'prefix' => 'state',
        'as' => 'state.',
        'namespace' => 'Site\Http\Controllers\State'
    ],
    function () {
        Route::get('/pozovn1', 'N1Controller@index')->name('n1');
        Route::post('/pozovn1', 'N1Controller@create')->name('n1.create');

        Route::get('/pay', 'Pay\PayController@index')->name('pay');
        Route::get('/pay/end', 'Pay\PayController@end')->name('end');
        Route::post('/pay/paid', 'Pay\PayController@paid')->name('paid');
    });



//==== State ====//


//========= Site =========//



//========= Auth =========//
// Authentication Routes...
Route::get('/login', 'Common\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Common\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'Common\Http\Controllers\Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('/register', 'Common\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Common\Http\Controllers\Auth\RegisterController@register');
// Password Reset Routes...
Route::get('/password/reset', 'Common\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Common\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Common\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Common\Http\Controllers\Auth\ResetPasswordController@reset');
//Verify
Route::get('/verify/{token}', 'Common\Http\Controllers\Auth\RegisterController@verify')->name('register.verify');

//Networks
Route::get('/login/{network}', 'Site\Http\Controllers\Auth\NetworkController@redirect')->name('login.network');
Route::get('/login/{network}/callback', 'Site\Http\Controllers\Auth\NetworkController@callback');
//========= Auth =========//



//========= Cabinet =========//
Route::group(
    [
        'prefix' => 'cabinet',
        'as' => 'cabinet.',
        'namespace' => 'Cabinet\Http\Controllers',
        'middleware' => ['auth'],
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('/articles', 'Articles\ArticlesController');

        Route::get('/main', 'Profile\MainController@edit')->name('main');
        Route::put('/main/{user}', 'Profile\MainController@update')->name('main.update');

        Route::get('/profile', 'Profile\ProfileController@edit')->name('profile');
        Route::put('/profile/{profile}', 'Profile\ProfileController@update')->name('profile.update');
    });
//========= Cabinet =========//



//========= Admin =========//
Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'Admin\Http\Controllers',
        'middleware' => ['auth', 'can:admin-panel'],
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        //User
        Route::resource('users', 'Users\UsersController');
        Route::post('/users/{user}/verify', 'Users\UsersController@verify')->name('users.verify');

        //Articles
        Route::resource('articles', 'Articles\ArticlesController');
        Route::post('/articles/{article}/verify', 'Articles\ArticlesController@verify')->name('articles.verify');
        Route::post('/articles/{article}/unverify', 'Articles\ArticlesController@unverify')->name('articles.unverify');

        //Reverse
        Route::resource('reverse', 'Reverse\ReverseController');
        Route::get('/reverse/{reverse}/verify', 'Reverse\ReverseController@verify')->name('reverse.verify');

        //Mail
        Route::get('/mail', 'Reverse\MailController@index')->name('mail.index');
        Route::delete('/mail/{mail}', 'Reverse\MailController@destroy')->name('mail.destroy');
        Route::get('/mail/create', 'Reverse\MailController@create')->name('mail.create');
        Route::post('/mail/store', 'Reverse\MailController@store')->name('mail.store');

        //Sub
        Route::get('/sub', 'Reverse\SubController@index')->name('sub.index');
        Route::delete('/sub/{sub}', 'Reverse\SubController@destroy')->name('sub.destroy');

        //Pages
        Route::resource('pages', 'Setting\PagesController');
        Route::post('/pages/{page}/verify', 'Setting\PagesController@verify')->name('pages.verify');
        Route::post('/pages/{page}/unverify', 'Setting\PagesController@unverify')->name('pages.unverify');
        Route::post('/ajax/upload/image', 'Setting\UploadController@image')->name('ajax.upload.image');

        //Logs
        Route::get('/logs', 'Setting\LogsController@index')->name('logs.index');
        Route::delete('/logs', 'Setting\LogsController@destroy')->name('logs.destroy');

        //Info
        Route::get('/info', 'Setting\InfoController@index')->name('info.index');

    }
);
//========= Admin =========//