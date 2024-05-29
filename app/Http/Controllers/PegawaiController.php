<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public $parent_title = "Master Data";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pegawai::whereNull("deleted_at")->get();
        $departments = Department::whereNull("deleted_at")->get();

        $pass = [
            "page" => [
                "parent_title" => $this->parent_title,
                "title" => "Pegawai",
            ],
            "data" => $data,
            "departments" => $departments,
        ];

        return view("pegawai/index", $pass);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'nik' => 'required|numeric|digits:16|unique:pegawais,nik',
            'pob' => 'required|min:2',
            'dob' => 'required|min:10',
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "nok",
                "message" => $validator->messages(),
                "data" => null,
            ], 400);
        }

        $pegawai = new Pegawai;
        $pegawai->name = $request->name;
        $pegawai->pob = $request->pob;
        $pegawai->dob = date("Y-m-d", strtotime(str_replace('/', '-', $request->dob)));
        $pegawai->department_id = $request->department_id;
        $pegawai->nik = $request->nik;

        try {
            $pegawai->save();
        } catch (\Exception $e) {
            return response()->json([
                "status" => "nok",
                "message" => $e,
                "data" => null,
            ], 500);
        }
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

        $pegawai = Pegawai::where("id", $id)->where("deleted_at", null)->first();
        if (!$pegawai) {
            return response()->json([
                "status" => "nok",
                "message" => "not found",
                "data" => null,
            ], 400);
        }

        $now = date('Y-m-d H:i:s');
        $pegawai->name = $request->name;
        $pegawai->description = $request->description;
        $pegawai->updated_at = $now;

        try {
            $pegawai->save();
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
            "data" => $pegawai,
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

        $pegawai = Pegawai::where("id", $id)->where("deleted_at", null)->first();
        if (!$pegawai) {
            return response()->json([
                "status" => "nok",
                "message" => "not found",
                "data" => null,
            ], 400);
        }

        try {
            $pegawai->forceDelete();
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
