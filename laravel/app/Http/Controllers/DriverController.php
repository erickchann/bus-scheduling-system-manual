<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Driver::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"      => "required|string",
            "age"       => "required|integer|min:18",
            "id_number" => "required|string|min:16"
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'invalid field'], 422);
        }

        Driver::create($request->except('token'));

        return response()->json(['message' => 'create driver success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name"      => "string",
            "age"       => "integer|min:18",
            "id_number" => "string|min:16"
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'invalid field'], 422);
        }

        $driver = Driver::findOrFail($id);
        $driver->update($request->except('token'));

        return response()->json(['message' => 'update driver success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return response()->json(['message' => 'delete driver success'], 200);
    }
}
