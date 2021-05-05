<?php

use AfricasTalking\SDK\AfricasTalking;
use App\Http\Controllers\UploadController;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Notifications\NotifyUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Nexmo\Laravel\Facade\Nexmo;

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

Route::get('/', function () {
    User::find(1)->notify(new NotifyUser);
    return "done";
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/email', function() {
    Mail::to('wilsonkinyuam@gmail.com')->send(new WelcomeMail());
    return new WelcomeMail();
});

Route::get('/article',[ArticleController::class, 'index']);

// uploading files

Route::post('/upload',[UploadController::class, 'store']);

// notification testing

Route::get('notify', function () {

    // $user = \App\Models\User::first();
    // $time = now()->addMinutes(10);
    // $user->notify((new \App\Notifications\InvoicePaid())->delay($time));
    // $user->notify(new \App\Notifications\InvoicePaid());

    Nexmo::message()->send([
        'to' =>   '254723904070',
        'from' => '254717255460',
        'text' => 'The test message from laravel daily.'
    ]);

    // return 'message sent';
});


// sending sms using afric

Route::get('/sms', function () {

    $username = 'developerwilson'; // use 'sandbox' for development in the test environment
    $apiKey   = '04509c661f3cc60f8d476b770d43dafb410a74b4133fc02cad980597eeb59169'; // use your sandbox app API key for development in the test environment
    $AT       = new AfricasTalking($username, $apiKey);

    // Get one of the services
    $sms      = $AT->sms();

    // Use the service
    $result   = $sms->send([
        'to'      => '+254774316686',
        'message' => 'Hello World!'
    ]);

    print_r(json_encode($result));
});
