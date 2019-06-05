@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Squadron Accounting</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
        <div class = "row">
           
            <div class="col-lg-3 col-md-6 col-sm-6">                
                <div class = "card card-stats">
                    <div class ="card-header card-header-info card-header-icon">
                        <div class ="card-icon">
                            <i class="fa fa-handshake-o fa-2x"></i>
                        </div>
                         <p class="card-category">Outstanding Subs<br><br></p>
                        <h3 class="card-title">${{($outstanding*10)}}</h3>
                        <div class = "card-footer">
                            <a href={{action('SquadronAccountingController@outstanding')}}>List Members</a>
                        </div>
                    </div>
                </div>   
            </div> 

            <div class="col-lg-3 col-md-6 col-sm-6">                
                    <div class = "card card-stats">
                        <div class ="card-header card-header-info card-header-icon">
                            <div class ="card-icon">
                                <i class="fa fa-handshake-o fa-2x"></i>
                            </div>
                             <p class="card-category">Requests<br><br></p>
                            <h3 class="card-title">${{$requestbalance}}</h3>
                            <div class = "card-footer">
                                <a href=#>List Invoices</a>
                            </div>
                        </div>
                    </div>   
                </div> 

        </div>


</div>
@endsection
