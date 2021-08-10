<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SocialController extends Controller
{
    private $page = "admin.social.";
    private $redirectTo = "admin.social.index";

    public function index()
    {
        $socials = Social::all();
        return view($this->page . "index", compact("socials"))->with("id");
    }

    public function create()
    {
        $social = Social::orderBy("id", "desc")->first();
        return view($this->page . "create", compact("social"));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "facebook_url" => ["nullable", "url"],
            "twitter_url" => ["nullable", "url"],
            "linkedin_url" => ["nullable", "url"],
            "insta_url" => ["nullable", "url"],
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");

                Social::create($input);

                DB::commit();
                return response()->json(["msg" => "Social created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function edit()
    {
        $social = Social::orderBy("id", "desc")->first();
        return view($this->page . "edit", compact("social"));

    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "facebook_url" => ["nullable", "url"],
            "twitter_url" => ["nullable", "url"],
            "linkedin_url" => ["nullable", "url"],
            "insta_url" => ["nullable", "url"],
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                Social::truncate();
                Social::create($input);
                DB::commit();
                return response()->json(["msg" => "Social updated successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }
}
