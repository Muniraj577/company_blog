@extends('layouts.admin.app')
@section('title', 'Company Information')
@section('general-setting', 'active')
@section('style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline" @if (count($generalsettings) == 0) style="display: none;"
                         @else style="display: block" @endif>
                        <div class="card-body box-profile">
                            <div class="text-center">
                            </div>
                            @foreach ($generalsettings as $generalsetting)
                                <p class="text-center">
                                <div id="newLogoImage">
                                    <img class="img-fluid d-block mx-auto"
                                        src="{{ $generalsetting->companyImage($generalsetting->company_logo) }}" alt=""
                                        style="width: 100px;">
                                </div>
                                </p>
                                <h3 class="profile-username text-center"><i class="fas fa-envelope"></i>
                                    <span id="cname">{{ $generalsetting->company_name }}</span>
                                </h3>
                                <p class="text-center"><i class="fas fa-envelope-open"></i>
                                    <span id="cemail">{{ $generalsetting->company_email }}</span>
                                </p>
                                <p class="text-center"><i class="fas fa-phone"></i> <span
                                        id="cphone">{{ $generalsetting->company_phone }}</span>
                                </p>
                                @if ($generalsetting->company_phone1 != null)
                                    <p class="text-center"><i class="fas fa-phone"></i> <span
                                            id="cphone1">{{ $generalsetting->company_phone1 }}</span>
                                    </p>
                                @endif
                                <p class="text-center"><i class="fas fa-map-marker"></i>
                                    <span id="caddress">{{ $generalsetting->company_address }}</span>
                                </p>

                                <form class="text-center"
                                    action="{{ route('admin.general.destroy', $generalsetting->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-center">Delete</button>
                                </form>

                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div @if (count($generalsettings) == 0) class="col-md-12" @else class="col-md-9" @endif>
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                @if (count($generalsettings) == 0)
                                    <li class="nav-item"><a class="nav-link @if (count($generalsettings)==0) active @endif"
                                            href="#general_setting" data-toggle="tab">Company Profile</a></li>
                                @else
                                    <li class="nav-item"><a class="nav-link @if (count($generalsettings)==1) active @endif"
                                            href="#edit_setting" data-toggle="tab">Company Profile</a></li>
                                @endif
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane @if (count($generalsettings)==0) active @endif" id="general_setting">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.general.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        {{-- @foreach ($errors->all() as $error)
                                            <p class="text-danger">{{ $error }}</p>
                                        @endforeach --}}
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Company Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="company_name"
                                                    autocomplete="company_name" value="{{ old('company_name') }}">
                                                @if ($errors->has('company_name'))
                                                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="company_slogan" class="col-sm-2 col-form-label">Company
                                                Slogan</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="{{ old('company_slogan') }}"
                                                    class="form-control" name="company_slogan"
                                                    autocomplete="company_slogan">
                                                @if ($errors->has('company_slogan'))
                                                    <span class="text-danger">
                                                        {{ $errors->first('company_slogan') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Company Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control"
                                                    value="{{ old('company_email') }}" name="company_email"
                                                    autocomplete="email">
                                                @if ($errors->has('company_email'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('company_email') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="company_phone" class="col-sm-2 col-form-label">Company Phone</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="company_phone"
                                                    autocomplete="company_phone" value="{{ old('company_phone') }}">
                                                @if ($errors->has('company_phone'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('company_phone') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="company_phone1" class="col-sm-2 col-form-label">Company
                                                Phone1</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="company_phone1"
                                                    autocomplete="company_phone1" value="{{ old('company_phone1') }}">
                                                @if ($errors->has('company_phone1'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('company_phone1') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="company_address" class="col-sm-2 col-form-label">Company
                                                Address</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control"
                                                    value="{{ old('company_address') }}" name="company_address"
                                                    autocomplete="company_address">
                                                @if ($errors->has('company_address'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('company_address') }}</span>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Upload logo</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="company_logo" class="form-control" id="img">
                                                <img src="#" id="imgPreview" alt="">
                                                @if ($errors->has('company_logo'))
                                                    <span class="text-danger">{{ $errors->first('company_logo') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane @if (count($generalsettings)==1) active @endif" id="edit_setting">
                                    @foreach ($generalsettings as $generalsetting)
                                        <input class="idClass" id="idVal" type="hidden" name="id"
                                            value="{{ $generalsetting->id }}">
                                        <form class="form-horizontal updateForm">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label">Company Name</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control company_name" id="company_name"
                                                        name="company_name" value="{{ $generalsetting->company_name }}"
                                                        autocomplete="company_name">
                                                    <div class="text-danger name_err"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="buttonSubmit btn btn-sm btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form class="updateForm">
                                            <div class="form-group row">
                                                <label for="company_slogan" class="col-sm-3 col-form-label">Company
                                                    Slogan</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="company_slogan"
                                                        value="{{ $generalsetting->company_slogan }}"
                                                        autocomplete="company_slogan">
                                                </div>

                                                <div class="col-md-2">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form class="updateForm">
                                            <div class="form-group row">
                                                <label for="company_email" class="col-sm-3 col-form-label">Company
                                                    Email</label>
                                                <div class="col-sm-7">
                                                    <input type="email" class="form-control company_email"
                                                        name="company_email" value="{{ $generalsetting->company_email }}"
                                                        autocomplete="company_email">
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </div>
                                            </div>

                                        </form>
                                        <form class="updateForm">
                                            <div class="form-group row">
                                                <label for="company_phone" class="col-sm-3 col-form-label">Company
                                                    Phone</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="company_phone"
                                                        value="{{ $generalsetting->company_phone }}"
                                                        autocomplete="company_phone">
                                                    <div class="text-danger phone_err"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </div>
                                            </div>

                                        </form>
                                        <form class="updateForm">
                                            <div class="form-group row">
                                                <label for="company_phone1" class="col-sm-3 col-form-label">Company
                                                    Phone1</label>
                                                <div class="col-sm-7">
                                                    <input id="company_phone1" type="text" class="form-control"
                                                        name="company_phone1"
                                                        value="{{ $generalsetting->company_phone1 }}"
                                                        autocomplete="company_phone1">
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </div>
                                            </div>

                                        </form>
                                        <form class="updateForm">
                                            <div class="form-group row">
                                                <label for="company_address" class="col-sm-3 col-form-label">Company
                                                    Address</label>
                                                <div class="col-sm-7">
                                                    <input id="company_address" type="text" class="form-control"
                                                        name="company_address"
                                                        value="{{ $generalsetting->company_address }}"
                                                        autocomplete="company_address">
                                                    <div class="text-danger add_err"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>

                                        <form class="updateForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="" class="col-sm-3 col-form-label">Upload Logo</label>
                                                <div class="col-sm-7">
                                                    <input type="file" class="form-control"
                                                        onchange="showImg(this, 'logoPreview')" name="company_logo"
                                                        value="{{ $generalsetting->company_logo }}">
                                                    <img id="logoPreview"
                                                        src="{{ asset('images/general/' . $generalsetting->company_logo) }}"
                                                        alt="" style="width: 100px;">
                                                    <div class="text-danger img_err"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function() {
            $(".updateForm").submit(function(e) {
                e.preventDefault();
                $(".phone_err").html('');
                $(".add_err").html('');
                $(".name_err").html('');
                $(".img_err").html('');
                let id = $("#idVal").val();
                let url = "{{ route('admin.general.update', ':id') }}";
                url = url.replace(':id', id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: new FormData(this),
                    success: function(data) {
                        console.log(data);
                        if (data.phone_err) {
                            $(".phone_err").html(data.phone_err);
                        } else if (data.add_err) {
                            $(".add_err").html(data.add_err);
                        } else if (data.name_err) {
                            $(".name_err").html(data.name_err);
                        } else if (data.img_err) {
                            $(".img_err").html(data.img_err);
                        } else {
                            var firstkey = Object.keys(data.datas)[0];
                            var fvalue = data.datas[firstkey];
                            console.log(data.datas[firstkey]);
                            if (firstkey == 'company_name') {
                                $("#cname").text(fvalue);
                                toastr.success('Company name updated successfully.');
                            } else if (firstkey == 'company_email') {
                                $("#cemail").text(fvalue);
                                toastr.success('Company email updated successfully.');
                            } else if (firstkey == 'company_address') {
                                $("#caddress").text(fvalue);
                                toastr.success('Company address updated successfully.');
                            } else if (firstkey == 'company_phone') {
                                $("#cphone").text(fvalue);
                                toastr.success('Company phone updated successfully.');
                            } else if (firstkey == 'company_phone1') {
                                $("#cphone1").text(fvalue);
                                toastr.success('Company phone updated successfully.');
                            } else if (firstkey == 'company_slogan') {
                                toastr.success('Company slogan updated successfully.');
                            } else if (firstkey == 'company_logo') {
                                let newLogo = `<img src="{{ asset('images/general/') }}/` +
                                    fvalue + `"
                                    alt="" class="img-fluid d-block mx-auto">`;
                                $("#newLogoImage").html(newLogo);
                                toastr.success('Company logo updated successfully.');
                            }
                        }

                    },
                });
            });
        });

    </script>
@endsection
