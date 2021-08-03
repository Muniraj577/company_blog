<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    private $page = "admin.client.";
    private $redirectTo = "admin.client.index";
    private $destination = "images/client/";

    public function index()
    {
        $clients = Client::latest()->get();
        return view($this->page . "index", compact("clients"))->with("id");
    }

    public function create()
    {
        $categories = ClientCategory::all();
        return view($this->page . "create", compact("categories"));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "client_category_id" => ["required"],
            "url" => ["nullable", "url"],
            "logo" => ["required", "image", "mimes:jpg,jpeg,png,svg", "max:2048"],
        ], [
            "client_category_id" => "Category is required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $image = Upload::image($request, 'logo', $this->destination, null);
                $imageName = $input["logo"] = $image["imageName"];
                Client::create($input);
                DB::commit();
                if ($request->hasFile('logo')) {
                    $image["image"]->move($this->destination, $imageName);
                }
                return response()->json(["msg" => "Client created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $categories = ClientCategory::all();
        return view($this->page . "edit", compact("client", "categories"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "client_category_id" => ["required"],
            "url" => ["nullable", "url"],
            "logo" => ["nullable", "image", "mimes:jpg,jpeg,png", "max:2048"],
        ], [
            "client_category_id" => "Category is required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $client = Client::findOrFail($id);
                $oldLogo = $client->logo;
                if ($request->hasFile('logo')) {
                    $input["logo"] = Upload::image($request, "logo", $this->destination, $oldLogo);
                }
                $client->update($input);
                DB::commit();
                return response()->json(["msg" => "Client updated successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }
}
