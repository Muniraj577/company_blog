@extends('layouts.admin.app')
@section('title', 'Team')
@section('team', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Team</h1>
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
                                <a href="{{ route('admin.team.index') }}" class="btn btn-primary"><i
                                        class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data"
                                id="form">
                                @csrf
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <p class="db_error"></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
<div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="name">Full Name&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control" placeholder="Enter team name">
                                                    <span class="require name text-danger"></span>
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="designation">Designation&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="designation" class="form-control"
                                                        value="{{ old('designation') }}">
                                                    <span class="require designation text-danger"></span>
                                                    @error('designation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="description">Description</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea name="description" class="form-control" style="width: 100%;"
                                                        cols="30" rows="10">{{ old('description') }}</textarea>
                                                    <span class="require description text-danger"></span>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="status">Status</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="status" class="form-control">
                                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                    <span class="require status text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="image">Upload Team Image (2MB)&nbsp;<span
                                                            class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" name="image"
                                                        onchange="showImg(this, 'imgPreview')">
                                                    <img src="" id="imgPreview">
                                                    <span class="require image text-danger"></span>
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
                                                    <label for="fb_link">Facebook Url</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="fb_link" value="{{ old('fb_link') }}"
                                                        class="form-control" placeholder="Enter Facebook Link">
                                                    <span class="require fb_link text-danger"></span>
                                                    @error('fb_link')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="twitter_link">Twitter Url</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="twitter_link" value="{{ old('twitter_link') }}"
                                                        class="form-control" placeholder="Enter Twitter Url">
                                                    <span class="require twitter_link text-danger"></span>
                                                    @error('twitter_link')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="insta_link">Insta Url</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="insta_link" value="{{ old('insta_link') }}"
                                                        class="form-control" placeholder="Enter Insta Url">
                                                    <span class="require insta_link text-danger"></span>
                                                    @error('insta_link')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="linkedin_link">Linkedin Url</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="linkedin_link" value="{{ old('linkedin_link') }}"
                                                        class="form-control" placeholder="Enter Linkedin Url">
                                                    <span class="require linkedin_link text-danger"></span>
                                                    @error('linkedin_link')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                </div>
                                
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitForm(event);">Submit</button>
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
        $(document).ready(function() {
            $(".alert-warning").css('display', 'none');
        });

        function submitForm(e) {
            e.preventDefault();
            $('.require').css('display', 'none');
            let url = $("#form").attr("action");
            $.ajax({
                url: url,
                type: 'post',
                data: new FormData(this.form),
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.db_error) {
                        $(".alert-warning").css('display', 'block');
                        $(".db_error").html(data.db_error);
                    } else if (data.errors) {
                        var error_html = "";
                        $.each(data.errors, function(key, value) {
                            error_html = '<div>' + value + '</div>';
                            $('.' + key).css('display', 'block').html(error_html);
                        });
                    } else if (!data.errors && !data.db_error) {
                        location.href = data.redirectRoute;
                        toastr.success(data.msg);
                    }

                }
            });
        }
    </script>
@endsection
