<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix("v1")->group(function () {
    Route::apiResource("lesson", LessonController::class);
    Route::apiResource("user", UserController::class);
    Route::apiResource("tag", TagController::class);
    Route::any("oldlesson", function () {
        return "this is not updated api";
    });



    // TAG MODEL





    // Route::any("oldtag", function () {
    //     return "this is not updated api";
    // });

    // Route::redirect("oldtag", "tag");

  
  
    Route::any("olduser", function () {
        $msg = "this is not updated api";
        return Response::json($msg, 404);
    });

    // Route::redirect("olduser", "user");


    Route::get("user/{id}/lesson", [RelationController::class, "userLessons"]);

    Route::get("lesson/{id}/tag", [RelationController::class, "lessonTags"]);

    Route::get("tag/{id}/lesson", [RelationController::class, "tagLessons"]);

});

// User 
