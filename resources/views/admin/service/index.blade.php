@extends('layouts.admin.app')
@section('title', 'Service')
@section('service', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Service</h1>
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
                                <a href="{{ route('admin.service.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Service
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="Service" class="table table-responsive-xl text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Logo</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th class="hidden">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $key => $service)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>
                                                <img src="{{ $service->getLogo($service->logo) }}" class="imgSize" alt="">
                                            </td>
                                            <td>{{ $service->category->title }}</td>
                                            <td>{{ $service->status ? "Active" : "Inactive" }}</td>
                                            <td>
                                            <div class="d-inline-flex">
                                                <a href="{{ route("admin.service.edit", $service->id) }}"
                                                    class="btn btn-sm btn-primary" title="Edit Service">
                                                    <i class="fa fa-edit iCheck"></i> Edit
                                                </a>
                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

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
            $("#Service").DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,
                "dom": 'lBfrtip',
                "buttons": [{
                        extend: 'collection',
                        text: "<i class='fa fa-ellipsis-v'></i>",
                        buttons: [{
                                extend: 'copy',
                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'csv',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'excel',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'pdf',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                }
                            },
                            {
                                extend: 'print',

                                exportOptions: {
                                    columns: 'th:not(:last-child)'
                                },

                            },
                        ],

                    },
                    {
                        extend: 'colvis',
                        columns: ':not(.hidden)'
                    }
                ],
                "language": {
                    "infoEmpty": "No entries to show",
                    "emptyTable": "No data available",
                    "zeroRecords": "No records to display",
                }
            });
            dataTablePosition();
        });
    </script>
@endsection
