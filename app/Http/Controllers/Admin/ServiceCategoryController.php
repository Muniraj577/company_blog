<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategoryRequest;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\DB;

class ServiceCategoryController extends Controller
{
    private $page = "admin.service_category.";
    private $redirectTo = "admin.service.category.index";

    public function index()
    {
        $categories = ServiceCategory::latest()->get();
        return view($this->page . "index", compact("categories"))->with("id");
    }

    public function create()
    {
        return view($this->page . "create");
    }

    public function store(ServiceCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->except("_token");
            $input["slug"] = getSlug($request->title);
            ServiceCategory::create($input);
            DB::commit();
            return redirect()->route($this->redirectTo)->with(notify("success", "Category created successfully"));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(notify("warning", $e->getMessage()));
        }
    }

    public function edit($id)
    {
        $category = ServiceCategory::findOrFail($id);
        return view($this->page . "edit", compact("category"));
    }

    public function update(ServiceCategoryRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $category = ServiceCategory::findOrFail($id);
            $input = $request->except("_token");
            $input["slug"] = getSlug($request->title);
            $category->update($input);
            DB::commit();
            return redirect()->route($this->redirectTo)->with(notify("success", "Category updated successfully"));
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(notify("warning", $e->getMessage()));
        }
    }
}
