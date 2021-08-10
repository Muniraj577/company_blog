@extends('layouts.admin.app')
@section('title', 'Social')
@section('social', 'active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row col-12 mb-2">
                <div class="col-sm-6">
                    <h1>Social</h1>
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
                                @if(count($socials) > 0)
                                <a href="{{ route('admin.social.edit') }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Social
                                </a>
                                @else
                                <a href="{{ route('admin.social.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Social
                                </a>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="Social" class="table table-responsive-xl text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Facebook Url</th>
                                        <th>Twitter Url</th>
                                        <th>Linkedin Url</th>
                                        <th>Instagram Url</th>
                                        {{-- <th class="hidden">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($socials as $key => $social)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>{{ $social->facebook_url }}</td>
                                            <td>{{ $social->twitter_url }}</td>
                                            <td>{{ $social->linkedin_url }}</td>
                                            <td>{{ $social->insta_url }}</td>
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
            $("#Social").DataTable({
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
