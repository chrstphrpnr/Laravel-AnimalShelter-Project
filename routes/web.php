<?php



use Illuminate\Support\Facades\Route;



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

// Route::get('/InjuryDiseases',['uses' => 'InjuryDiseaseController@index','as' => 'InjuryDisease.index']);
// Route::get('create',['uses' => 'InjuryDiseaseController@create','as' => 'InjuryDisease.create']);
// Route::post('store',['uses' => 'InjuryDiseaseController@store','as' => 'InjuryDisease.store']);
// Route::get('/edit/{InjuryDiseasesId}',['uses' => 'InjuryDiseaseController@edit','as' => 'InjuryDisease.edit']);
// Route::post('/update/{InjuryDiseasesId}',['uses' => 'InjuryDiseaseController@update','as' => 'InjuryDisease.update']);
// Route::get('delete/{InjuryDiseasesId}',['uses' => 'InjuryDiseaseController@delete','as' => 'InjuryDisease.delete']);
// Route::resource('InjuryDisease', InjuryController::class)->middleware('auth');
// // Route::resource('Rescuer', RescuerController::class)->middleware('auth');
// Route::resource('Adopter', AdopterController::class)->middleware('auth');
// Route::resource('Personnel', PersonnelController::class)->middleware('auth');
// Route::resource('Animal', AnimalController::class)->middleware('auth');

// Route::get('Mails','ContactFormController@index')->middleware('auth');
// Route::resource('Contact',ContactFormController::class)->middleware('auth');



    Route::group(['middleware' => 'role:admin'], function() {
        Route::resource('Rescuer', RescuerController::class);
        Route::resource('InjuryDisease', InjuryController::class);
        Route::resource('Adopter', AdopterController::class);
        Route::resource('Personnel', PersonnelController::class);
        Route::resource('Animal', AnimalController::class);
        // Route::resource('Dashboard', DashboardController::class);
        Route::get('Mails','ContactFormController@index');
        Route::resource('Contact',ContactFormController::class);

        Route::get('/get-injury',[ 
            'uses'=>'InjuryController@getInjury',
            'as' => 'injury.getInjury']);

        Route::get('/get-animal',[ 
            'uses'=>'AnimalController@getAnimal',
            'as' => 'animal.getAnimal']);

        Route::get('/get-rescuer',[ 
            'uses'=>'RescuerController@getRescuer',
            'as' => 'rescuer.getRescuer']);

        Route::get('/get-adopter',[ 
            'uses'=>'AdopterController@getAdopter',
            'as' => 'adopter.getAdopter']);
        
        Route::get('/get-personnel',[ 
            'uses'=>'PersonnelController@getPersonnel',
            'as' => 'personnel.getPersonnel']);

        Route::get('Dashboard', [
            'uses' => 'DashboardController@admin',
            'as' => 'Dashboard.index',
            ]);

        Route::get('editadmin/{admin}', [
            'uses' => 'DashboardController@editdashboard',
            'as' => 'admin.edit',
            ]);
        Route::post('updateadmin/{admin}', [
            'uses' => 'DashboardController@updatedashboard',
            'as' => 'admin.update',
            ]);

        Route::get('status/{id}', [
            'uses' => 'PersonnelController@status_update',
            'as' => 'personnel.status',
            ]);

        

        
        
        
      

    });

    





    Route::group(['prefix' => 'user'], function(){

        Route::group(['middleware' => 'guest'], function() {

            Route::get('signup', [
            'uses' => 'LoginController@getSignup',
            'as' => 'user.signup',
                ]);
            Route::post('signup', [
                    'uses' => 'LoginController@postSignup',
                    'as' => 'user.signup',
                ]);
            Route::get('signin', [
                    'uses' => 'LoginController@getSignin',
                    'as' => 'user.signin',
                ]);
            Route::post('signin', [
                    'uses' => 'LoginController@postSignin',
                    'as' => 'user.signin',
                ]);
        });

    });

    Route::group(['middleware'=>'role:rescuer'], function() {
        Route::get('rescuerprofile', [
            'uses' => 'ProfileController@RescuerProfile',
            'as' => 'rescuer.profile',
        ]);
        Route::get('editrescuer/{rescuer}', [
            'uses' => 'ProfileController@rescuer_edit',
            'as' => 'rescuerprofile.edit',
        ]);
        Route::post('updaterescuer/{rescuer}', [
            'uses' => 'ProfileController@rescuer_update',
            'as' => 'rescuerprofile.update',
        ]);

    });


    Route::group(['middleware' => 'role:personnel'], function() {
        Route::get('personnelprofile', [
        'uses' => 'ProfileController@PersonnelProfile',
        'as' => 'personnel.profile',
        ]);

        Route::get('editpersonnel/{personnel}', [
            'uses' => 'ProfileController@personnel_edit',
            'as' => 'personnel.editprofile',
            ]);
        Route::post('updatepersonnel/{personnel}', [
            'uses' => 'ProfileController@personnel_update',
            'as' => 'personnel.updateprofile',
        ]);
    });

    Route::group(['middleware' => 'role:adopter','verified'], function() {
        Route::get('adopterprofile', [
        'uses' => 'ProfileController@AdopterProfile',
        'as' => 'adopter.profile',
        ]);

        Route::get('editadopter/{adopter}', [
            'uses' => 'ProfileController@adopter_edit',
            'as' => 'adopter.fix',
            ]);
        Route::post('updateadopter/{adopter}', [
            'uses' => 'ProfileController@adopter_update',
            'as' => 'adopter.update',
        ]);
    });


    Route::post('search', [
        'uses'=>'SearchController@search',
        'as' => 'search'
    ]);

    Route::get('animalshow/{id}', [
        'uses' => 'FrontEndController@show',
        'as' => 'frontend.info',
        ]);



















Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
// ->name('home');
Route::get('/homepage', [App\Http\Controllers\FrontEndController::class, 'homepage'])
->name('homepage');
Route::get('/pets', [App\Http\Controllers\FrontEndController::class, 'pets'])
->name('pets');
Route::get('/adopters', [App\Http\Controllers\FrontEndController::class, 'adopters'])
->name('adopters');
// Route::get('/show/{id}', [App\Http\Controllers\FrontEndController::class, 'show'])
// ->name('show');

Route::post('comments',[
    'uses'=> 'FrontEndController@comment', 
    'as' => 'animal.comments'
]);

Route::get('/show/{id}',[
    'uses'=> 'FrontEndController@show', 
    'as' => 'animal.show'
]);

Route::get('/verifyadopter/{id}', [
    'uses' => 'LoginController@emailAdopter',
    'as' => 'user.verifyadopter',
]);




Route::get('contact','ContactFormController@create');
Route::post('contact','ContactFormController@store');
