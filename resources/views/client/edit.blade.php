@extends('layouts.main')
@section('title', 'Client')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-headphones bg-danger"></i>
                         <div class="d-inline">
                            <h5>Add Client</h5>
                            {{--<span>CREATE A NEW Area</span>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @can('create') --}}
        <div class="row">
            <!-- start message area-->
            {{-- @include('alert.flash-message') --}}
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <form action="{{ route('client.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="client_category">Image</label>
                                        <input type="file" name="image" id="image"
                                               class="form-control @error('image') is-invalid @enderror"
                                               value="{{ old('image') }}" onchange="previewFile(this);" accept=".png, .jpg, .jpeg" >
                                        @error('image')
                                        <span class="text-red-error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Client Name<span class="text-red">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Client Name" value="{{ old('name', $client->name) }}" required>
                                        @error('name')
                                        <span class="text-red-error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Client Phone<span class="text-red">*</span></label>
                                        <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="+880" value="{{ old('phone', $client->phone) }}" required>
                                        @error('phone')
                                        <span class="text-red-error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="passport">Passport Number</label>
                                        <input type="text" name="passport" id="passport" class="form-control @error('passport') is-invalid @enderror" placeholder="1211****" value="{{ old('passport', $client->passport) }}">
                                        @error('passport')
                                        <span class="text-red-error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="service_type">Service Type</label>
                                        <select name="service_type" id="" class="form-control">
                                            <option value="">Select service Type</option>
                                            <option value="1">Hajj</option>
                                            <option value="2">Umrah</option>
                                        </select>
                                        @error('service_type')
                                        <span class="text-red-error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="package_id">Package</label>
                                        <select name="package_id" id="" class="form-control">
                                            <option value="">Select Package</option>
                                            <option value="1">Hajj</option>
                                            <option value="2">Umrah</option>
                                        </select>
                                        @error('package_id')
                                        <span class="text-red-error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="bill">Bill</label>
                                        <input type="text" name="bill" id="bill" class="form-control @error('bill') is-invalid @enderror" placeholder="Bill Amount" value="{{ old('bill', $client->bill) }}">
                                        @error('bill')
                                        <span class="text-red-error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="paid">Paid</label>
                                        <input type="text" name="paid" id="paid" class="form-control @error('paid') is-invalid @enderror" placeholder="Paid Amount" value="{{ old('paid', $client->paid) }}">
                                        @error('paid')
                                        <span class="text-red-error text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-30">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success mr-2">Add Client</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endcan --}}
    </div>
@endsection
