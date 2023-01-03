@extends('client_dashboard.main')
@section('title', 'User Deatils')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline pt-5">
                        <h5 class="pt-10" >User Details</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <button class="btn btn-info" onclick="printDiv()" id="print">Print</button>
                <div class="card-body" id="printTable">
                    <style>
                        .heding{
                            background: #5b9bd5 !important;
                        }
                        #print{
                            text-align: center;
                             margin: 0 auto;
                        }
                        .table-striped tbody tr:nth-of-type(odd) {
                                            background-color: rgb(91 154 212 / 38%);
                                        }
                        .att_img{
                            width: 65px;
                             height: 65px;
                        }
                        @media print{
                            .heding{
                                background: #5b9bd5;
                            }
                            .uts{
                                display: block
                            }
                            .table-striped tbody tr:nth-of-type(odd) {
                                background-color: rgb(91 154 212 / 38%);
                            }
                            #print{
                                display:none;
                            }
                        #data_table{
                            width: 100% !important;
                            border-collapse:collapse;
                            text-align: left;
                        }
                        #data_table tr td{
                           text-align: left;
                           padding:10px;
                        }
                        #data_table tr th{
                           text-align: left;
                           padding:10px;
                        }
                        .text-center{
                            text-align: center;
                        }
                        }

                        </style>
                    <div class="logoimg text-center">
                        <img src="{{ asset('img/show-page-header.png') }}" alt="" >
                        <h3 style="display: none;" class="uts">Union Toursim Service</h3>
                    </div>
                    <br>
                    <table style="width:100%" id="data_table" border="1"  class="table table-bordered table-striped data-table table-hover">
                            <tr class="heding">
                                <th style="color:#fff;font-weight:bold">Personal Info</th>
                                <th style="color:#fff;font-weight:bold">Data</th>
                              </tr>
                            <tr>
                                <th>Attachment</th>
                                <td><img class="att_img" src="{{asset('upload/client/'.$client->image)}}" alt=""></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{ Carbon\Carbon::parse($client->created_at)->format('d F, Y') ?? '--' }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $client->name }}</td>
                            </tr>
                            <tr>
                                <th>Passport No</th>
                                <td>{{ $client->passport }}</td>
                            </tr>
                            <tr>
                                <th>Mobile No</th>
                                <td>{{ $client->phone }}</td>
                            </tr>
                            <tr>
                                <th>Package Name</th>
                                <td>{{ $client->packages->name }}</td>
                            </tr>
                            <tr>
                                <th>Package Amount</th>
                                <td>{{ $client->bill }}</td>
                            </tr>
                            <tr>
                                <th>Paid Amount</th>
                                <td>{{ $client->paid }}</td>
                            </tr>
                            <tr>
                                <th>Due Amount</th>
                                <td>{{ $client->bill - $client->paid }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($client->bill - $client->paid == 0)
                                        <span class="badge badge-success">Paid</span>
                                    @else
                                        <span class="badge badge-danger">Due</span>
                                    @endif
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printDiv()
{

  var divToPrint=document.getElementById('printTable');
  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>
@endsection
