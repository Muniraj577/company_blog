<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientCategoryController extends Controller
{
    private $page = "admin.client_category.";
    private $redirectTo = "admin.client.category.index";

    public function index()
    {
        $categories = ClientCategory::latest()->get();
        return view($this->page . "index", compact("categories"))->with("id");
    }

    public function create()
    {
        return view($this->page . "create");
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "title" => ["required", "unique:client_categories,title"],
        ]);
        if ($validation->fails()) {
            return response()->json(["errors" => $validation->errors()]);
        }
        if ($validation->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $input["slug"] = getSlug($request->title);
                $client_category = ClientCategory::create($input);
                DB::commit();
                return response()->json(["msg" => "Client Category created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $category = ClientCategory::findOrFail($id);
        return view($this->page . "edit", compact("category"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "title" => ["required", "unique:client_categories,title," . $id],
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $category = ClientCategory::findOrFail($id);
                $input["slug"] = getSlug($request->title);
                $category->update($input);
                DB::commit();
                return response()->json(["msg" => "Client category updated successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }
}
