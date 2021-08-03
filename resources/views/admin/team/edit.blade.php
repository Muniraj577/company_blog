@extends('layouts.admin.app')
@section('title', 'Product')
@section('product', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
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
                                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left iCheck"></i>&nbsp;Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                                id="form">
                                @csrf
                                @method('put')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <p class="db_error"></p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="title">Title&nbsp;<span class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="title" value="{{ old('title', $product->title) }}"
                                                        class="form-control" placeholder="Enter product title">
                                                    <span class="require title text-danger"></span>
                                                    @error('title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="url">URL</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="url" class="form-control"
                                                        value="{{ old('url', $product->url) }}">
                                                    <span class="require url text-danger"></span>
                                                    @error('url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="description">Description&nbsp;<span
                                                            class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea name="description" class="form-control" style="width: 100%;"
                                                        cols="30" rows="10">{{ old('description', $product->description) }}</textarea>
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
                                                        <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                    <span class="require status text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="logo">Upload Product Logo (2MB)&nbsp;<span
                                                            class="req">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" name="logo"
                                                        onchange="showImg(this, 'imgPreview')">
                                                    <img src="{{ $product->getLogo($product->logo) }}" class="imgSize" id="imgPreview">
                                                    <span class="require logo text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="button" class="btn btn-primary"
                                                onclick="submitForm(event);">Submit</button>
                                        </div>
                                    </div>
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
                _method:"put",
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
                    } else if(!data.errors && !data.db_error) {
                        location.href = data.redirectRoute;
                        toastr.success(data.msg);
                    }

                }
            });
        }
    </script>
@endsection
