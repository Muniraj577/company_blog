@extends('layouts.admin.app')
@section('title', 'User')
@section('user', 'active')
@section('content')
    <style>
        .form-control {
            padding: .175rem .75rem;
        }

    </style>
    <?php $user = getUser(); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ $user->avatarImg($user->avatar) }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><i class="fas fa-user"></i> {{ $user->name }}
                            </h3>
                            <p class="text-center"><i class="fas fa-envelope"></i> {{ $user->email }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a
                                        class="nav-link {{ $errors->has('current_password') || $errors->has('password') ? 'active' : '' }}"
                                        href="#change-password" data-toggle="tab">Change Password</a></li>
                                <li class="nav-item"><a class="nav-link {{ $errors->has('email') ? 'active' : '' }}"
                                        href="#change-email" data-toggle="tab">Change
                                        Email</a></li>
                                <li class="nav-item"><a class="nav-link{{ $errors->has('image') ? 'active' : '' }}"
                                        href="#change-image" data-toggle="tab">Update
                                        Profile</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane {{ $errors->has('current_password') || $errors->has('password') ? 'active' : '' }}"
                                    id="change-password">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.user.adminNewPassword') }}" id="passwordForm">
                                        @csrf
                                        {{-- @foreach ($errors->all() as $error)
                                            <p class="text-danger">{{ $error }}</p>
                                        @endforeach --}}
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Current
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="current_password"
                                                    autocomplete="current-password">
                                                @error('current_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new_password" class="col-sm-2 col-form-label">New
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password" id="password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Confirm New
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane {{ $errors->has('email') ? 'active' : '' }}" id="change-email">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.user.changeAdminEmail') }}" id="changeEmailForm">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" placeholder="Email"
                                                    value="{{ $user->email }}" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">New Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Enter your new email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane {{ $errors->has('image') ? 'active' : '' }}" id="change-image">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.user.chageAdminAvatar') }}"
                                        enctype="multipart/form-data" id="updateProfileForm">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Full Name:</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="{{ old('name', $user->name) }}"
                                                    class="form-control" name="name" id="name">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 col-form-label">Address:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    value="{{ old('address', $user->address) }}" name="address"
                                                    id="address">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-2 col-form-label">Phone:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    value="{{ old('phone', $user->phone) }}" name="phone" id="phone">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                        </div>
                                        <div class="form-group row">
                                            <label for="image" class="col-sm-2 col-form-label">Choose Image:</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="image" id="img">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <img id="imgPreview"
                                                src="{{ asset('images/admin/avatars/' . $user->avatar) }}" alt=""
                                                style="width: 100px; height: 100px;">

                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
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
        $("#passwordForm").validate({
            rules: {
                current_password: {
                    required: true,
                },
                password: {
                    required: true,
                    passwordCheck: true,
                    minlength: 10,
                },
                password_confirmation: {
                    equalTo: "#password",
                },
            },
            messages: {
                password: {
                    required: "New Password is required",
                    minlength: "Password must be of at least 10 characters.",
                    passwordCheck: "Password must contain at least one uppercase , lowercase, digit and special character",
                },
                password_confirmation: {
                    equalTo: "Password confirmation does not match.",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $("#changeEmailForm").validate({
            rules: {
                email: {
                    required: {
                        depends: function() {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    customemail: true,
                },
            },
            messages: {
                email: {
                    required: "Email is required",
                    customemail: "Please enter valid email address",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $("#updateProfileForm").validate({
            rules: {
                name: {
                    required: true,
                    lettersonly: true,
                },
                address:{
                    lettersonly: true,
                },
                phone: {
                    digits: true,
                    minlength: 10,
                    maxlength: 13
                },
            },
            messages: {
                email: {
                    required: "Email is required",
                    customemail: "Please enter valid email address",
                },
                phone: {
                    digits: "Phone must contain only numeric value",
                    minlength: "Phone must have at least 10 digits",
                    maxlength: "The phone length must not be greater than 13",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
