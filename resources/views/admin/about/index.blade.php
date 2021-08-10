@extends('layouts.admin.app')
@section('title', 'About')
@section('about', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>About</h1>
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
                                <a href="{{ route('admin.about.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add About
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <p class="db_error"></p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="About" class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th class="hidden">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($abouts as $key => $about)
                                            <tr>
                                                <td>{{ ++$id }}</td>
                                                <td>
                                                    <img src="{{ $about->getImg($about->image) }}" class="imgSize" alt="">
                                                </td>
                                                <td>
                                                    <textarea style="width: 100%;">
                                                            {{ $about->description }}
                                                        </textarea>
                                                </td>
                                                <td>
                                                    <?php
                                                    $class = $about->status == 1 ? 'badge-success' : 'badge-warning';
                                                    ?>
                                                    <span style="cursor: pointer;" onclick="update_status($(this));"
                                                        data-id="{{ $about->id }}"
                                                        class="badge {{ $class }}">{{ $about->status == 1 ? 'Active' : 'Inactive' }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-inline-flex">
                                                        <a href="{{ route('admin.about.edit', $about->id) }}"
                                                            class="btn btn-sm btn-primary" title="Edit About">
                                                            Edit
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#About").DataTable();
        });

        $(document).ready(function() {
            $(".alert-warning").css('display', 'none');
        });

        function update_status(about) {
            let aboutId = $(about).data("id");
            $.ajax({
                url: "{{ route('admin.about.updateStatus') }}",
                type: "POST",
                data: {
                    "about_id": aboutId
                },
                success: function(data) {
                    if (data.db_error) {
                        $(".alert-warning").css('display', 'block');
                        $(".db_error").html(data.db_error);
                    }
                    toastr.success(data.msg);
                    location.reload();
                }
            });
        }
    </script>
@endsection
