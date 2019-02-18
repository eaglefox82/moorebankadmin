@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class = "col-sm-12">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title font-weight-bold">Member Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>First Name:</th>
                                <td style="border-top: 1px #ddd solid">{{$member->first_name}}</td>
                                <th>Last Name:</th>
                                <td style="border-top: 1px #ddd solid">{{$member->last_name}}</td>
                                <th>Rank:</th>
                                <td style="border-top: 1px #ddd solid">{{$member->memberrank->rank}}</td>
                            </tr>
                            <tr>
                                <th>Age:</th>
                                <td>{{$member->age}} years</td>
                                <th>Date of Joining:</th>
                                <td>{{date("d/m/Y",strtotime($member->date_joined))}}</td>
                                <th>Service:</td>
                                <td>{{number_format((float)$member->service)}} years</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class = "col-sm-12">
                <div class = "card">
                    <div class="card-header card-header-icon card-header-rose">
                        <h4 class="card-title font-weight-bold">Active Kids Vouchers</h4>
                            <div class="pull-right new-button">
                                <a href="{{action('ActiveKidsController@voucher', $member->id)}}" class="btn btn-primary" title="Add Voucher"><i class="fa fa-plus fa-2x"></i> Add Voucher</a>
                             </div>
                    </div>
                    <div class="table-responsive">
                    <h4> Voucher Balance: ${{number_format($member->ActiveKids->sum('balance'),2)}}</h4>
                        <table class="table">
                            <thead class = 'text-primary'>
                                <th class="text-center">Date</th>
                                <th class="text-center">Voucher</th>
                                <th class="text-center">Balance</th>
                            </thead>
                            <tbody>
                            @foreach ($member->ActiveKids as $t)
                            <tr>
                                <td class="text-center">{{date('j/n/Y', strtotime($t->date_received))}}</td>
                                <td class="text-center">{{$t->voucher_number}}</td>
                                <td class="text-center">${{$t->balance}}</td>
                            </tr>
                            @endforeach
                            </tbody> 
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection