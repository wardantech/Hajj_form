@extends('layouts.main')
@section('title', 'Client Deatils')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline pt-5">
                        <h5 class="pt-10" >Client Details</h5>
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
                <button class="btn btn-info" id="print">Print</button>
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
                        @media print{
                            .heding{
                                background: #5b9bd5;
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
                    <h4 class="text-center">Report ABC HAJ AGENCY</h4><br>
                    <table style="width:100%" id="data_table" border="1"  class="table table-bordered table-striped data-table table-hover">
                            <tr class="heding">
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
                                <td>{{ $client->packages->amount }}</td>
                            </tr>
                            <tr>
                                <th>Paid Amount</th>
                                <td>{{ $client->paid }}</td>
                            </tr>
                            <tr>
                                <th>Due Amount</th>
                                <td>{{ $client->due }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('#print').on('click',function(){
printData();
})
</script>
@endsection
