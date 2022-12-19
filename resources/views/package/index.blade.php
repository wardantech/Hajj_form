@extends('layouts.main')
@section('title', 'Packages')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Packages')}}</h5>
                            <span>{{ __('List of packages')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('package.create')}}">{{ __('Create package')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
        @include('include.message')
        <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('Packages')}}</h3></div>
                    <div class="card-body">
                        <table id="user_table" class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('Amount')}}</th>
                                <th>{{ __('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <!--server side users table script-->
        <script src="{{ asset('js/custom.js') }}"></script>
    @endpush
@endsection



{{--@extends('layouts.main')--}}
{{--@section('title', 'Packages')--}}
{{--@section('content')--}}
    {{--<!-- push external head elements to head -->--}}
    {{--@push('head')--}}
        {{--<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">--}}
    {{--@endpush--}}

{{--@section('content')--}}
    {{--<div class="container">--}}
        {{--<div class="row justify-content-center">--}}
            {{--<div class="col-md-8">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header d-flex justify-content-between align-items-center">--}}
                        {{--<p class="m-0">Package List</p>--}}
                        {{--<a href="{{route('package.create')}}">Create Package</a>--}}
                    {{--</div>--}}
                    {{--<div class="card-body">--}}
                        {{--<table class="table table-bordered" id="table">--}}
                            {{--<thead style="text-align: center">--}}
                                {{--<tr>--}}
                                    {{--<th><b>Name</b></th>--}}
                                    {{--<th><b>Amount</b></th>--}}
                                    {{--<th><b>Action</b></th>--}}
                                  {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody style="text-align: center">--}}
                                {{--@foreach($packages as $package)--}}
                                    {{--<tr>--}}
                                        {{--<th>{{$package->name}}</th>--}}
                                        {{--<th>{{$package->amount}}</th>--}}
                                        {{--<th>--}}
                                            {{--<a href="{{route('package.edit', $package->id)}}" title="edit" class="btn btn-sm btn-warning"><i class='bx bxs-edit-alt'></i></a>--}}
                                            {{--<a href="{{route('package.destroy', $package->id)}}" title="edit" class="btn btn-sm btn-warning"><i class='bx bxs-edit-alt'></i></a>--}}
                                        {{--</th>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--@push('script')--}}
        {{--<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>--}}
        {{--<!--get role wise permissiom ajax script-->--}}
        {{--<script src="{{ asset('js/get-role.js') }}"></script>--}}
    {{--@endpush--}}
{{--@endsection--}}
