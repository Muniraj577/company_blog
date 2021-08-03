<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    private $page = "admin.team.";
    private $redirectTo = "admin.team.index";
    private $destination = "images/team/";

    public function index()
    {
        $teams = Team::latest()->get();
        return view($this->page . "index", compact("teams"))->with("id");
    }

    public function create()
    {
        return view($this->page . "create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required"],
            "designation" => ["required"],
            "image" => ["required", "image", "mimes:jpeg,jpg,png", "max:2048"],
            "fb_link" => ["nullable", "url"],
            "twitter_link" => ["nullable", "url"],
            "insta_link" => ["nullable", "url"],
            "linkedin_link" => ["nullable", "url"],
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                if ($request->hasFile("image")) {
                    $file = Upload::image($request, "image", $this->destination, null);
                    $imageName = $input["image"] = $file["imageName"];
                }
                Team::create($input);
                DB::commit();
                if ($request->hasFile("image")) {
                    $file["image"]->move($this->destination, $imageName);
                }
                return response()->json(["msg" => "Team created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view($this->page . "edit", compact("team"));
    }

    public function update(Request $request, $id)
    {
        $validator = $this->__validation($request->all());
        if($validator->fails()){
            return response()->json(["errors"=>$validator->errors()]);
        }
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $team = Team::findOrFail($id);
                $oldImage = $team->image;
                $input = $request->except("_token");
                if($request->hasFile("image")){
                    $input["image"] = Upload::image($request, "image", $this->destination, $oldImage);
                }
                DB::commit();
                return response()->json(["msg"=>"Team updated successfully","redirectRoute"=>route($this->redirectTo)]);
            }catch(\Exception $e){
                DB::rollBack();
                return response()->json(["db_error"=>$e->getMessage()]);
            }
        }
    }

    private function __validation(array $data)
    {
        $validator = Validator::make($data, [
            "name" => ["required"],
            "designation" => ["required"],
            "image" => ["nullable", "image", "mimes:jpeg,jpg,png", "max:2048"],
            "fb_link" => ["nullable", "url"],
            "twitter_link" => ["nullable", "url"],
            "insta_link" => ["nullable", "url"],
            "linkedin_link" => ["nullable", "url"],
        ]);
        return $validator;
    }
}
