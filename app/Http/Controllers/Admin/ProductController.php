<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $page = "admin.product.";
    private $redirectTo = "admin.product.index";
    private $logodest = "images/products/";

    public function index()
    {
        $products = Product::latest()->get();
        return view($this->page . "index", compact("products"))->with("id");
    }

    public function create()
    {
        return view($this->page . "create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ["required", "string"],
            'url' => ["nullable", "url"],
            'description' => ["required"],
            'logo' => ["required", "image", "mimes:jpg,png,jpeg,svg", "max:2048"],
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except('_token');
                $input["slug"] = $request->title . '-' . (new Product())->setSlugAttribute($request->title);
                if ($request->hasFile('logo')) {
                    $file = Upload::image($request, 'logo', $this->logodest, null);
                    // $input["logo"] = $file["image"];
                    $imageName = $input["logo"] = $file["imageName"];
                }
                Product::create($input);
                DB::commit();
                if ($request->hasFile('logo')) {
                    $file["image"]->move($this->logodest, $imageName);
                }
                return response()->json(["msg" => "Product created successfully", "redirectRoute" => route($this->redirectTo)]);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }

        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view($this->page . "edit", compact("product"));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => ["required", "string"],
            'url' => ["nullable", "url"],
            'description' => ["required"],
            'logo' => ["nullable", "image", "mimes:jpg,png,jpeg,svg", "max:2048"],
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $product = Product::findOrFail($id);
                $oldLogo = $product->logo;
                $input = $request->except("_token");
                $input["slug"] = $request->title. '-'. (new Product())->setSlugAttribute($request->title);
                if($request->hasFile('logo')){
                    $input['logo'] = Upload::image($request, 'logo', $this->logodest, $oldLogo);
                }
                $product->update($input);
                DB::commit();
                return response()->json(["msg"=>"Product updated successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch(\Exception $e){
                DB::rollBack();
                return response()->json(["db_error"=>$e->getMessage()]);
            }
        }
    }

}
