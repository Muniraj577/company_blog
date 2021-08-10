<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    private $page = "admin.about.";
    private $redirectTo = "admin.about.index";
    private $destination = "images/about/";

    public function index()
    {
        $abouts = About::all();
        return view($this->page . "index", compact("abouts"))->with("id");
    }

    public function create()
    {
        return view($this->page . "create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "description" => ["required"],
            "image" => ["required", "image", "mimes:jpeg,jpg,png", "max:2048"],
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $file = Upload::image($request, 'image', $this->destination, null);
                $imageName = $input["image"] = $file["imageName"];
                About::create($input);
                DB::commit();
                $file["image"]->move($this->destination, $imageName);
                return response()->json(["msg" => "About created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view($this->page . "edit", compact("about"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "description" => ["required"],
            "image" => ["nullable", "image", "mimes:jpeg,jpg,png", "max:2048"],
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $about = About::findOrFail($id);
                $oldImage = $about->image;
                $input = $request->except("_token");
                if ($request->hasFile("image")) {
                    $input["image"] = Upload::image($request, 'image', $this->destination, $oldImage);

                }

                $about->update($input);
                DB::commit();
                return response()->json(["msg" => "About updated successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $about = About::where("id", $request->about_id)->first();
            $datas = About::all();
            if ($about->status == 0) {
                $about->update(["status" => 1]);
                $msg = "Status is active";
            } else if ($about->status == 1) {
                $about->update(["status" => 0]);
                $msg = "Status is inactive";
            }
            foreach ($datas as $data) {
                if ($data->id == $about->id) {
                    continue;
                } else {
                    $data->update(["status" => 0]);
                }
            }
            DB::commit();
            return response()->json(["msg" => $msg]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["db_error" => $e->getMessage()]);
        }
    }
}
