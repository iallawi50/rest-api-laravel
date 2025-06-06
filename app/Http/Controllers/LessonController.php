<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lesson = Lesson::all();
        return response()->json([
            "data" => $lesson,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lesson = Lesson::create($request->all());
        return response()->json([
            "data" => $lesson,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);

        return response()->json([
            "data" => $lesson,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());
        return response()->json([
            "data" => "updated successfully",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Lesson::findOrFail($id)->delete();

        return response()->json([
            "data" => "deleted successfully",
        ], 204);
    }
}
