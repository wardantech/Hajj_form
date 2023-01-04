@extends('layouts.main')
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
            <div class="col-lg-4">
                <div class="page-title-actions float-right">
                    <a title="Back Button" href="{{ route('client.index') }}" type="button" class="btn btn-sm btn-dark">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Back
                    </a>
                    <a title="Create Button" href="{{ route('client.create') }}" type="button" class="btn btn-sm btn-success">
                        <i class="fas fa-plus mr-1"></i>
                        Create
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="d-flex printbtn">
                    <button class="btn btn-info" onclick='printDiv()' id="print">Print</button>
                <button class="btn btn-info" onclick='printDivWithPad()' id="printWithPad">Print with Pad</button>
                </div>
                <div class="card-body" id="printTable">
                    <div class="logoimg text-center">
                        <img id="head_logo" src="{{ asset('img/show-page-header.png') }}" alt="" >
                        <h3 style="display: none;" class="uts">Union Toursim Service</h3>
                        <img class="att_img" src="{{asset('upload/client/'.$client->image)}}" alt="">
                    </div>
                    <br>
                    <div id="pad">
                        <style>
                            .heding{
                                background: #5b9bd5 !important;
                            }
                            .logoimg {
                                height: 200px;
                            }
                            #print{
                                text-align: center;
                                width: 120px;
                                margin-right: 10px;
                            }
                            .printbtn{
                                text-align: center;
                                margin: 0 auto;
                            }
                            #printWithPad{
                                width: 120px;
                            }
                            .table-striped tbody tr:nth-of-type(odd) {
                                                background-color: rgb(91 154 212 / 38%);
                                            }

                        .att_img{
                            width: 200px;
                            height: 200px;
                            float: right;
                            position: absolute;
                            right: 0;
                            }
                            @media print{
                              .heding{
                                    background: #5b9bd5;
                                }
                                .att_img{
                            width: 180px;
                            height: 200px;
                            float: right;
                            position: absolute;
                            right: 0;
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
                            <p id="mt200"></p>
                        <table style="width:100%" id="data_table" border="1"  class="table table-bordered table-striped data-table table-hover">
                            <tr style="background:#5b9bd5; " class="heding">
                                <th style="color:#fff;font-weight:bold">Personal Info</th>
                                <th style="color:#fff;font-weight:bold">Data</th>
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
</div>
<script>
    function printDiv()
{

  var divToPrint=document.getElementById('printTable');
  var mt200 = document.getElementById('mt200').style.marginTop = "0px";
  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
function printDivWithPad()
{
  var divToPrint=document.getElementById('pad');
 var mt200 = document.getElementById('mt200').style.marginTop = "200px";
  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();
  setTimeout(function(){newWin.close();},10);

}
</script>
@endsection
