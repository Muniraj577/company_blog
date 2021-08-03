<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $page = "admin.user.";
    private $destination = "images/admin/user/avatar/";
    private $redirectTo = "admin.user.index";

    public function index()
    {
        $users = User::latest()->get();
        return view($this->page . "index", compact("users"))->with("id");
    }

    public function create()
    {
        return view($this->page . "create");
    }

    public function store(UserRequest $request)
    {
        try {
            // $image = $request->file('avatar');
            // dd($image);
            DB::beginTransaction();
            $input = $request->except("_token");
            $input["password"] = Hash::make($request->password);
            if ($request->hasFile('avatar')) {
                $file = Upload::image($request, 'avatar', $this->destination, null);
                $imageName = $input["avatar"] = $file['imageName'];
                $image = $file["image"];
            }
            User::create($input);
            DB::commit();
            if ($request->hasFile('avatar')) {
                moveFile($image, $this->destination, $imageName);
            }
            return redirect()->route($this->redirectTo)->with(notify("success", "User created successfully."));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(notify("warning", $e->getMessage()))->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view($this->page . "edit", compact("user"));
    }

    public function update(UserRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $oldImage = $user->avatar;
            $oldPassword = $user->password;
            $input = $request->except("_token");
            if($request->filled('password')){
                $input["password"] = Hash::make($request->password);
            } else {
                $input["password"] = $oldPassword;
            }
            if($request->hasFile('avatar')){
                $input['avatar'] = Upload::image($request,'avatar', $this->destination, $oldImage);
            }
            $user->update($input);
            DB::commit();
            return redirect()->route($this->redirectTo)->with(notify("success", "User updated successfully"));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(notify("warning", $e->getMessage()))->withInput();
        }
    }

    public function profile()
    {
        $user = getUser();
        return view($this->page."profile",compact("user"));
    }
}
