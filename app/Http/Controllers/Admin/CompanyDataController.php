<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralRequest;
use App\Models\CompanyData;
use App\Models\Upload;
use Illuminate\Http\Request;

class CompanyDataController extends Controller
{
    protected $destination = 'images/general/';

    public function index()
    {
        $generalsettings = CompanyData::all()->take(1);
        return view('admin.general.index', compact('generalsettings'));
    }

    public function store(GeneralRequest $request)
    {
        $input = $request->except('_token');
        if ($request->hasFile('company_logo')) {
            $file = Upload::image($request, 'company_logo', $this->destination, null);
            $imageName = $input['company_logo'] = $file["imageName"];
        }
        $general = CompanyData::create($input);
        if($request->hasFile("company_logo")){
            $file["image"]->move($this->destination, $imageName);
        }
        return redirect()->route('admin.general.index')->with(notify('success', 'Company Data created successfully'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_token');
        $general = CompanyData::findOrFail($id);
        $oldlogo = $general->company_logo;
        if ($request->hasFile('company_logo')) {
            $allowed_ext = ['jpg', 'png', 'svg', 'jpeg', 'JPG', 'PNG', 'JPEG', 'SVG'];
            $ext = $request->company_logo->getClientOriginalExtension();
            $fileSize = formatBytes($request->company_logo->getSize());
            if (!in_array($ext, $allowed_ext)) {
                $img_err = 'Only jpg, png, svg and jpeg format are supported';
                return response()->json(['img_err' => $img_err]);
            } else {
                if ($fileSize > 4) {
                    $img_err = 'Logo size cannot be greater than 4MB';
                    return response()->json(['img_err' => $img_err]);
                }
            }
            $input['company_logo'] = Upload::image($request, 'company_logo', $this->destination, $oldlogo);
        } else {
            $input['company_logo'] = $oldlogo;
        }
        if ($request->has('company_name')) {
            if ($request->company_name == null || $request->company_name == '') {
                $error = 'Company name is required';
                return response()->json(['name_err' => $error]);
            }
        } elseif ($request->has('company_address')) {
            if ($request->company_address == null || $request->company_address == '') {
                $error = 'Company address is required';
                return response()->json(['add_err' => $error]);
            }
        } elseif ($request->has('company_phone')) {
            if ($request->company_phone == null || $request->company_phone == '') {
                $error = 'Company phone is required';
                return response()->json(['phone_err' => $error]);
            }
        }
        $general = $general->update($input);
        $notification = array(
            'alert-type' => 'success',
            'msg' => 'Company Data updated',
        );
        return response()->json(['datas' => $input, 'noti' => $notification]);

    }

    public function destroy(Request $request, $id)
    {
        $general = CompanyData::find($id);
        $file = $general->company_logo;
        FileUnlink($this->destination, $file);
        $general->truncate();
        return redirect()->route('admin.general.index')->with(notify('error', 'Company Data deleted!'));
    }
}
