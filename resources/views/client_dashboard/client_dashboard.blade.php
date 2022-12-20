@extends('client_dashboard.main')
@section('title', 'Client')

@push('head')

    <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">

    <!-- izitoast -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endpush


@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>User Info</h5>
                            <span>

                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="http://127.0.0.1:8000/dashboard"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Client Info</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Client</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            {{-- @include('alert.flash-message') --}}
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">

                        <table id="table" class="table">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Passport</th>
                                <th>Phone Number</th>
                                <th>Bill</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{-- <td><img src="{{ asset('/upload/client/'.$client->image) }}" alt="" width="50" height="50"></td> --}}
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->passport }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->bill }}</td>
                                    <td>{{ $client->paid }}</td>
                                    <td>{{ $client->bill - $client->paid }}</td>
                                    <td><a href="{{ route('show-for-client', $client->id) }}" class="btn btn-primary">Show</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')

        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>


        // izitoast
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



        <script src="{{ asset('js/form-advanced.js') }}"></script>

        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




        <script>
            $(document).ready( function () {
                var searchable = [];
                var selectable = [];

                $.ajaxSetup({
                    headers:{
                        "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content"),
                    }
                });

                var dTable = $('#table').DataTable({
                    order: [],
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    processing: true,
                    responsive: false,
                    language: {
                        processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
                    },
                    scroller: {
                        loadingIndicator: false
                    },
                    pagingType: "full_numbers",
                    // dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",

                    // dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
                    //     buttons: [
                    //             {
                    //                 extend: 'copy',
                    //                 className: 'btn-sm btn-info',
                    //                 title: 'Brand_Models',
                    //                 header: false,
                    //                 footer: true,
                    //                 exportOptions: {
                    //                     // columns: ':visible'
                    //                 }
                    //             },
                    //             {
                    //                 extend: 'csv',
                    //                 className: 'btn-sm btn-success',
                    //                 title: 'Brand_Models',
                    //                 header: false,
                    //                 footer: true,
                    //                 exportOptions: {
                    //                     // columns: ':visible'
                    //                 }
                    //             },
                    //             {
                    //                 extend: 'excel',
                    //                 className: 'btn-sm btn-warning',
                    //                 title: 'Brand_Models',
                    //                 header: false,
                    //                 footer: true,
                    //                 exportOptions: {
                    //                     // columns: ':visible',
                    //                 }
                    //             },
                    //             {
                    //                 extend: 'pdf',
                    //                 className: 'btn-sm btn-primary',
                    //                 title: 'Brand_Models',
                    //                 pageSize: 'A2',
                    //                 header: false,
                    //                 footer: true,
                    //                 exportOptions: {
                    //                     // columns: ':visible'
                    //                 }
                    //             },
                    //             {
                    //                 extend: 'print',
                    //                 className: 'btn-sm btn-default',
                    //                 title: 'Brand_Models',
                    //                 // orientation:'landscape',
                    //                 pageSize: 'A2',
                    //                 header: true,
                    //                 footer: false,
                    //                 orientation: 'landscape',
                    //                 exportOptions: {
                    //                     // columns: ':visible',
                    //                     stripHtml: false
                    //                 }
                    //             }
                    //         ],
                });
            });
        </script>
    @endpush
@endsection
