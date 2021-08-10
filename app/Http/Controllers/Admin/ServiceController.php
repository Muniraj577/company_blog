<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    private $page = "admin.service.";
    private $redirectTo = "admin.service.index";
    private $destination = "images/services/";

    public function index()
    {
        $services = Service::latest()->get();
        return view($this->page . "index", compact("services"))->with("id");
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return view($this->page . "create", compact("categories"));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "service_category_id" => ["required"],
            "title" => ["required", "unique:services,title"],
            "description" => ["required"],
            "logo" => ["required", "image", "mimes:jpeg,jpg,png", "max:2048"],
        ], [
            "service_category_id.required" => "Category is required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $input["slug"] = getSlug($request->title);
                $file = Upload::image($request, "logo", $this->destination, null);
                $imageName = $input["logo"] = $file["imageName"];
                Service::create($input);
                DB::commit();
                $file["image"]->move($this->destination, $imageName);
                return response()->json(["msg" => "Service created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $categories = ServiceCategory::all();
        return view($this->page . "edit", compact("service", "categories"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "service_category_id" => ["required"],
            "title" => ["required", "unique:services,title," . $id],
            "description" => ["required"],
            "logo" => ["nullable", "image", "mimes:jpeg,jpg,png", "max:2048"],
        ], [
            "service_category_id.required" => "Category is required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $service = Service::findOrFail($id);
                $oldLogo = $service->logo;
                $input = $request->except("_token");
                $input["slug"] = getSlug($request->title);
                if ($request->hasFile("logo")) {
                    $input["logo"] = Upload::image($request, "logo", $this->destination, $oldLogo);

                } else {
                    $input["logo"] = $oldLogo;
                }

                $service->update($input);
                DB::commit();
                return response()->json(["msg" => "Service updated successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }
}
