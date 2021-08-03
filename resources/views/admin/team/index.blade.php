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
                                <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Team
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="Team" class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Facebook Link</th>
                                            <th>Twitter Link</th>
                                            <th>Insta Link</th>
                                            <th>Linkedin Link</th>
                                            <th>Status</th>
                                            <th class="hidden">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teams as $key => $team)
                                            <tr>
                                                <td>{{ ++$id }}</td>
                                                <td>
                                                    <img src="{{ $team->getImg($team->image) }}" class="imgSize" alt="">
                                                </td>
                                                <td>{{ $team->name }}</td>
                                                <td>{{ $team->designation }}</td>
                                                <td>{{ $team->fb_link }}</td>
                                                <td>{{ $team->twitter_link }}</td>
                                                <td>{{ $team->insta_link }}</td>
                                                <td>{{ $team->linkedin_link }}</td>
                                                <td>{{ $team->status ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <div class="d-inline-flex">
                                                        <a href="{{ route('admin.team.edit', $team->id) }}"
                                                            class="btn btn-sm btn-primary" title="Edit Team">
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
            $("#Team").DataTable();
        });
    </script>
@endsection
