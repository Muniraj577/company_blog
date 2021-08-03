@extends('layouts.admin.app')
@section('title', 'User')
@section('user', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title float-right">
                                <a href="{{ route("admin.user.index") }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.user.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data" id="form">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="name">Full Name &nbsp;<span class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            placeholder="Enter full name" id="" value="{{ $user->name }}">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="email">Email Address &nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="email" name="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            value="{{ $user->email }}">
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="password">Password &nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="password" name="password" id="password" value=""
                                                            class="form-control @error('password') is-invalid @enderror">
                                                        @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="password_confirmation">Confirm Password &nbsp;<span
                                                                class="req">*</span></label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control @error('password_confirmation') is-invalid @enderror">
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="address">Address</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="address" value="{{ $user->address }}"
                                                            class="form-control @error('address') is-invalid @enderror">
                                                        @error('address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="phone">Phone</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" name="phone" value="{{ $user->phone }}"
                                                            class="form-control @error('phone') is-invalid @enderror">
                                                        @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="avatar">Upload profile pic</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" name="avatar" id="img" onchange="showImg(this, 'imgPreview')"
                                                            class="form-control @error('avatar') is-invalid @enderror">
                                                        <img src="{{ $user->userImg($user->avatar) }}" id="imgPreview"
                                                            class="imgSize" alt="">
                                                        @error('avatar')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $("#form").validate({
            rules: {
                name: "required",
                email: {
                    required: {
                        depends: function() {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    customemail: true,
                },
                password: {
                    required: false,
                    passwordCheck: true,
                    minlength: 10,
                },
                password_confirmation: {
                    equalTo: "#password",
                },
                phone: {
                    required: false,
                    digits: true,
                    minlength: 10,
                    maxlength: 13,
                    
                },
                avatar: {
                    accept: "image/*",
                    extension: "jpg|jpeg|png|svg"
                },
            },
            messages: {
                name: "The name field is required",
                email: {
                    required: "Email is required",
                    customemail: "Please enter valid email address",
                },
                password: {
                    required: "Password field is required",
                    minlength: "Password must be of at least 10 characters.",
                    passwordCheck: "Password must contain at least one uppercase , lowercase, digit and special character",
                },
                password_confirmation: {
                    equalTo: "Password confirmation does not match.",
                },
                phone: {
                    digits: "Phone must contain only numeric value",
                    minlength: "Phone must have at least 10 digits",
                    maxlength: "The phone length must not be greater than 13",
                },
                avatar: {
                    accept: "Please upload a valid image",
                    extension: "Image must be of type jpg, jpeg, png, svg",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
