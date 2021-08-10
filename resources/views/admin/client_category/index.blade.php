@extends('layouts.admin.app')
@section('title', 'Client Category')
@section('client-category', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Client Category</h1>
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
                                <a href="{{ route('admin.client.category.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Client Category
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="ClientCategory" class="table table-responsive-xl text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th class="hidden">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>{{ $category->title }}</td>
                                            <td>{{ $category->status ? "Active" : "Inactive" }}</td>
                                            <td>
                                            <div class="d-inline-flex">
                                                <a href="{{ route("admin.client.category.edit", $category->id) }}"
                                                    class="btn btn-sm btn-primary" title="Edit Client Category">
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
            $("#ClientCategory").DataTable({
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
