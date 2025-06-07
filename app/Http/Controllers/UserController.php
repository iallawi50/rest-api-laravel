<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum")->except("index");
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input("limit");
        $limit = $limit > 50 ? 50 : $limit;
        $user = UserResource::collection(User::paginate($limit));
        return $user->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create", User::class);
         $data = $request->all();
         $data["password"] = Hash::make($data["password"]);
         $user = new UserResource(User::create($data));
        return  $user->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = new UserResource(User::findOrFail($id));
        return  $user->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize("update", User::findOrFail($id));
        $user = new UserResource(User::findOrFail($id));
        $user->update($request->all());
        return  $user->response()->setStatusCode(200, "Updated Successffully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize("delete", User::findOrFail($id));
        User::findOrFail($id)->delete();
        return response()->json([
            "data" => "deleted successfully",
        ], 204);
    }
}
