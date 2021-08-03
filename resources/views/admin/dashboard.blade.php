@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('dashboard', 'active')
@section('content')
    <style>
        table td,
        th {
            padding: 15px 15px !important;
        }

        .color {
            background-color: red;
            color: #fff;
        }

    </style>
    <style>
        .bgcolor {
            background-color: #d00000;
            color: #fff;
            padding: 8px;
        }

        .bgcolor1 {
            background-color: #00b70c;
            color: #fff;
            padding: 8px;
        }

        .bstyle h5 {
            margin-bottom: 0;
            text-align: center;
            font-size: 16px;
            line-height: 1;
        }

        .paddingcol .col-md-2 {
            padding-right: 5px;
            padding-left: 5px;
        }

        .design {
            height: 30px;
            width: 30px;
        }

        .main {
            padding: 30px 40px 30px 30px;
        }

        .main1 {
            padding: 30px;
        }

    </style>
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card create-card">
                        <div class="card-body">
                            <button class="btn btn-primary">Dashboard</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script>
    
</script>
@endsection
