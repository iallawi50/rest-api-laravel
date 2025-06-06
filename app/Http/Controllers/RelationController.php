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
        
        return response()->json([
            "data" => $tags,
        ], 200);
    }

    public function tagLessons($id)
    {
        $lessons = Tag::findOrFail($id)->lessons;
        
        return response()->json([
            "data" => $lessons,
        ], 200);
    }

    public function userLessons($id)
    {
        $lessons = User::findOrFail($id)->lessons;
        
        return response()->json([
            "data" => $lessons,
        ], 200);
        
    }
}
