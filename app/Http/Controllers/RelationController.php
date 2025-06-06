<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function lessonTags($id)
    {
        $tags = Lesson::findOrFail($id)->tags;

        $filed = array();
        $filtered = array();
        foreach ($tags as $tag) {
            $filed["title"] =  $tag->name;
            $filtered[] = $filed;
        }



        return response()->json([
            "data" => $filtered,
        ], 200);
    }

    public function tagLessons($id)
    {
        $lessons = Tag::findOrFail($id)->lessons;


         $filtered = array();
        foreach ($lessons as $lesson) {
            $filtered[] = [
                "Title" => $lesson->title,
                "Body" => $lesson->body
            ];
        }



        return response()->json([
            "data" => $filtered,
        ], 200);
    }

    public function userLessons($id)
    {
        $user = User::findOrFail($id);

        $lessons = $user->lessons;

        $filtered = [];

        foreach ($lessons as $lesson) {
            $filtered[] = [
                "Title" => $lesson->title,
                "Body" => $lesson->body
            ];
        };


        return response()->json([
            "Owner" => $user->name,
            "data" => $filtered,
        ], 200);
    }
}
