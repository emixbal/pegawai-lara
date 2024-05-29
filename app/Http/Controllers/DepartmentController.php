<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public $parent_title = "Master Data";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Department::whereNull("deleted_at")->get();

        $pass = [
            "page" => [
                "parent_title" => $this->parent_title,
                "title" => "Department",
            ],
            "data" => $data,
        ];

        return view("department/index", $pass);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "nok",
                "message" => $validator->messages(),
                "data" => null,
            ], 400);
        }

        $department = new Department;
        $department->name = $request->name;
        $department->description = $request->description;

        try {
            $department->save();
        } catch (\Exception $e) {
            return response()->json([
                "status" => "nok",
                "message" => $e,
                "data" => null,
            ], 500);
        }

        return response()->json([
            "status" => "ok",
            "message" => "sukses",
            "data" => $department,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                "status" => "nok",
                "message" => "Invalid id type",
                "data" => null,
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "nok",
                "message" => $validator->messages(),
                "data" => null,
            ], 400);
        }

        $department = Department::where("id", $id)->where("deleted_at", null)->first();
        if (!$department) {
            return response()->json([
                "status" => "nok",
                "message" => "not found",
                "data" => null,
            ], 400);
        }

        $now = date('Y-m-d H:i:s');
        $department->name = $request->name;
        $department->description = $request->description;
        $department->updated_at = $now;

        try {
            $department->save();
        } catch (\Exception $e) {
            return response()->json([
                "status" => "nok",
                "message" => $e,
                "data" => null,
            ], 500);
        }

        return response()->json([
            "status" => "ok",
            "message" => "sukses",
            "data" => $department,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                "status" => "nok",
                "message" => "Invalid id type",
                "data" => null,
            ], 400);
        }

        $department = Department::where("id", $id)->where("deleted_at", null)->first();
        if (!$department) {
            return response()->json([
                "status" => "nok",
                "message" => "not found",
                "data" => null,
            ], 400);
        }

        try {
            $department->forceDelete();
        } catch (\Exception $e) {
            return response()->json([
                "status" => "nok",
                "message" => "Something went wrong",
                "data" => null,
            ], 500);
        }

        return response()->json([
            "status" => "ok",
            "message" => "success",
            "data" => null,
        ], 200);
    }
}
