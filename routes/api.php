<?php

use App\Http\Controllers\Api\AuthControllerUser;
use App\Http\Controllers\CollageController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FavouritController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\QuestionbookController;
use App\Http\Controllers\QuestionexamController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Http\Resources\QuestionbookCollection;
use App\Models\Questionbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecializationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthControllerUser::class, 'register']);
Route::post('/login', [AuthControllerUser::class, 'login']);

Route::get('/all-collage', [CollageController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {

  Route::post('/logout', [AuthControllerUser::class, 'logout']);

  Route::get('/showprofile', [UserController::class, 'showprofile']);


  Route::match(['post', 'put', 'patch'], '/updateprofile', [UserController::class, 'updateuser']);

  Route::get('/eng-collage', [CollageController::class, 'showeng']);
  Route::get('/medical-collage', [CollageController::class, 'showmedical']);
  Route::get('collages/{uuid}', [CollageController::class, 'show']);

  Route::post('/complaints', [ComplaintController::class, 'store']);

  // Route::get('collages/{collageUuid}/questions',[CollageController::class ,'showQuestionByCollage']);
  Route::post('/profile', [UserController::class, 'profile']);

  Route::get('/all-specialization/{collegeUuid}', [SpecializationController::class, 'showSpecialization']);


  Route::get('/maste_granduation_specialization/{collegeUuid}', [SpecializationController::class, 'showMasterAndGraduationSpecializations']);
  Route::get('questions-book-item/{uuid}', [ItemController::class, 'questionsBookByItem']);
  Route::get('questions-Book-collage/{uuid}', [CollageController::class, "questionsBookByCollage"]);



  Route::get('last5exams/{uuid}', [SpecializationController::class, 'last5ExamDates']);
  Route::get('specialization/{uuid_Specialization}/questionexam/{date}', [SpecializationController::class, 'questionsExam']);

  Route::get('/show-Graduation-Item/{SpecializationUuid}', [SpecializationController::class, 'showGraduationItem']);
  Route::get('question-bank/{uuid}', [CollageController::class, 'questionBank']);

  Route::get('questions-exam-item/{uuid}', [ItemController::class,'questionsExamByItem']);

  Route::post('question-book-correct',[QuestionbookController::class,'revision']);
  Route::post('/question-exam-correct',[QuestionexamController::class,'revision']);

  Route::post('/question-bank-correct',[CollageController::class,'revision']);



Route::post('/remove-uuid-from-favourit',[FavouritController::class,'removeUuidFromFavourit']);
Route::get('/show-favourit', [FavouritController::class,'showFavourit']);
Route::post('/add-favourit', [FavouritController::class,'store']);
Route::get('sliders', [SliderController::class, 'allSliders']);

})->middleware('throttle:api');
