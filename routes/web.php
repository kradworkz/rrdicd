<?php

use Illuminate\Support\Facades\Route;
use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\Auth\WelcomeController;

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
    if(!Auth::check()){
        return view('welcome');
    }else{
        return redirect()->route('home');
    }
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search/{keyword}', 'PublicController@search');
Route::post('/research/download', 'ResearchController@download');

Route::middleware('auth')->group(function () {
    Route::get('/settings', 'HomeController@settings');
});

Route::middleware(['role:Administrator','auth'])->group(function () {
    Route::get('/dropdowns', 'DropdownController@index');
    Route::get('/member-committees', 'OrganizationController@members');
    Route::get('/monitoring-agencies', 'OrganizationController@monitoring');
    Route::get('/funding-agencies', 'OrganizationController@funding');
    Route::get('/events', 'EventController@index');
});

Route::middleware(['role:Administrator,Secretariat','auth'])->group(function () {
    Route::get('/staffs', 'StaffController@index');
    Route::get('/files', 'FileController@index');
    Route::get('/researches', 'ResearchController@index');
    Route::get('/researchers', 'ResearcherController@index');
});

Route::middleware(['role:Laboratory Coordinator','auth'])->group(function () {
    Route::get('/laboratory/basic', 'InventoryController@basic');
    Route::get('/laboratory/specialized', 'InventoryController@specialized');
});


Route::prefix('request')->group(function () {

    Route::middleware('auth')->group(function () {
        
        Route::post('/user/password', 'HomeController@password');
        Route::prefix('admin')->group(function () {
            Route::post('/file/download', 'FileController@download');
            Route::get('/totals', 'DashboardController@total');
            Route::get('/side', 'DashboardController@side');
            Route::get('/ages/{val}', 'DashboardController@ages');
            Route::get('/gender/{val}', 'DashboardController@gender');
            Route::get('/institutions', 'DashboardController@institution');
            Route::get('/dropdowns/{type}/{key}', 'DashboardController@dropdowns');
        });
    });

    Route::middleware(['role:Administrator','auth'])->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('/organizations/{type}/{keyword}', 'OrganizationController@list');
            Route::get('/organization/list/{type}', 'OrganizationController@lists');
            Route::post('/organization/search', 'OrganizationController@search');
            Route::post('/organization/funding/search', 'OrganizationController@fundingagency');
            Route::post('/organization/store', 'OrganizationController@store');

            Route::get('/events/{keyword}', 'EventController@lists');
            Route::post('/event/store', 'EventController@store');
            Route::post('/event/attendance', 'EventController@attendance');
            Route::get('/event/attendees/{id}', 'EventController@attendees');
            Route::get('/event/print/{id}', 'EventController@print');
            Route::get('/event/remove/{id}', 'EventController@remove');
            Route::get('/event/today', 'EventController@today');
            Route::post('/event/save', 'EventController@save');

            Route::get('/files/{keyword}', 'FileController@list');
            Route::post('/file/store', 'FileController@store');
            Route::get('/file/today', 'FileController@today');
            Route::get('/file/destroy/{id}', 'FileController@destroy');
        });
    });

    Route::middleware(['role:Administrator,Secretariat','auth'])->group(function () {
        Route::prefix('common')->group(function () {
            Route::get('/staffs/{keyword}', 'StaffController@lists');
            Route::post('/staff/store', 'StaffController@store');
            Route::post('/staff/search', 'StaffController@search');
            Route::post('/staff/status', 'StaffController@status');

            Route::get('/researches/{keyword}', 'ResearchController@lists');
            Route::get('/research/{id}', 'ResearchController@research');
            Route::post('/research/store', 'ResearchController@store');
            Route::post('/research/upload', 'ResearchController@upload');
            Route::get('/research/files/{id}', 'ResearchController@files');
            Route::post('/research/download', 'ResearchController@download');
            Route::post('/research/update', 'ResearchController@update');

            Route::get('/researchers/{keyword}', 'ResearcherController@lists');
            Route::post('/researcher/store', 'ResearcherController@store');
            Route::post('/researcher/search', 'ResearcherController@search');
            Route::get('/researcher/print/{id}', 'ResearcherController@print');

            Route::get('/report/print/{type}/{key}', 'ReportController@index');
            Route::get('/report/print/institution', 'ReportController@institution');
        });

        Route::prefix('admin')->group(function (){
            Route::get('/dropdowns/{classification}/{type}', 'DropdownController@lists');
            Route::get('/dropdown/{classification}/{type}/{keyword}', 'DropdownController@list');
            Route::post('/dropdown/store', 'DropdownController@store');
            Route::get('/dropdowncount/{classification}/{type}/{id}', 'DropdownController@count');
        });
    });

    Route::middleware(['role:Laboratory Coordinator','auth'])->group(function () {
        Route::prefix('coordinator')->group(function () {
            Route::get('/equipments/{type}/{keyword}', 'InventoryController@lists');
            Route::post('/equipment/store', 'InventoryController@store');
            Route::get('/equipment/list/{id}/{keyword}', 'InventoryController@equipments');
            Route::post('/equipment/update', 'InventoryController@update');
            Route::get('/equipment/{type}/{id}/{quantity}', 'InventoryController@list');
            Route::get('/equipment/dashboard', 'InventoryController@dashboard');
            Route::get('/equipment/search/{keyword}', 'InventoryController@search');
        });
    });

    Route::middleware(['role:Researcher','auth'])->group(function () {
        Route::prefix('researcher')->group(function () {
            Route::get('/researches/{keyword}', 'MyController@researches');
            Route::get('/status', 'MyController@status');
        });
    });

});

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
});