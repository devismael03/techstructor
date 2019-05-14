<?php
use App\Instruction;

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

Route::get('/','InstructionsController@index');
Route::get('/instruction/create','InstructionsController@create')->middleware('auth');
Route::get('/instruction/{instruction}','InstructionsController@show')->middleware('approve');
Route::get('/instruction/{instruction}/download','InstructionsController@download')->middleware('approve');
Route::get('/instruction/{instruction}/downloadAdmin','InstructionsController@downloadAdmin')->middleware('admin');
Route::get('/instruction/{instruction}/stateMutate','InstructionsController@stateMutate')->middleware('admin');
Route::get('/instruction/{instruction}/delete','InstructionsController@destroy')->middleware('admin');

Auth::routes();

Route::get('/manage','HomeController@manageInstructions')->middleware('admin');
Route::post('/search',function(){
    $q = request('query');
    $instructions = Instruction::where('is_approved',1)->where('title','LIKE','%'.$q.'%')->orderBy('id','DESC')->get();
    if(count($instructions) > 0){
        return view('home',compact('instructions'));
    }
    else{
        return redirect('/');
    }

});

Route::post('/report','ReportsController@store');
Route::post('/instruction','InstructionsController@store');
