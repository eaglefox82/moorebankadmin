@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header">Welcome {{ Auth::user()->firstname }}, </h3>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                           <h4>Today's date: <?php echo date('l - jS F Y'); ?></h4>
                                <h4
                                    @if ($rolldiff == '1')
                                       style="color: red;"
                                    @endif
                                >Current Roll date: {{date("l - jS F Y",strtotime($rolldate))}}
                                @if ($rolldiff == '1')
                                - Please Create new Roll
                             @endif
                            </h4>
                        </div>
                </div>
            </div>
        </div>
        <div class = "row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-university fa-2x"></i>
                        </div>
                        <p class="card-category">Members Present<br><br></p>
                        <h3 class="card-title">{{$currentroll->count()}}</h3>
                        <a href="{{action('RollController@index')}}" class="card-link">View Roll</a>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-book fa-2x"></i>
                        </div>
                        <p class="card-category">Members on Roll<br><br></p>
                        <h3 class="card-title">{{$members->where ('active','Y')->where('member_type', 'League')->count()}}</h3>
                        <a href="{{action('MembersController@index')}}" class="card-link">View Members</a>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-percent fa-2x"></i>
                        </div>
                        <p class="card-category">Sqn Attendance<br><br></p>
                        <h3 class="card-title">{{number_format(($currentroll->count()/$members->where ('active','Y')->where('member_type', 'League')->count())*100),2}}%</h3>
                        <a href="{{action('RollController@index')}}" class="card-link">View Roll</a>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-child fa-2x"></i>
                        </div>
                        <p class="card-category">Pending Vouchers<br><br></p>
                        <h3 class="card-title">{{$active->count()}}</h3>
                        <a href="{{action('ActiveKidsController@index')}}" class='card-link'>View Vouchers</a>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-user-o fa-2x"></i>
                        </div>
                        <p class="card-category">Officers Present<br><br></p>
                        <h3 class="card-title">{{$officers->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                        <p class="card-category">WO/TO's Present<br><br></p>
                        <h3 class="card-title">{{$to->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-angle-double-down fa-2x"></i>
                        </div>
                        <p class="card-category">NCOs Present<br><br></p>
                        <h3 class="card-title">{{$nco->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-group fa-2x"></i>
                        </div>
                        <p class="card-category">Cadets Present<br><br></p>
                        <h3 class="card-title">{{$cadet->count()}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-birthday-cake fa-2x"></i>
                        </div>
                        <p class="card-category">Upcoming Birthdays<br><br></p>
                            <h3 class="card-title">{{$members->where('birthday', '<', '30')->count()}}</h3>
                            <a href="{{action('MembersController@birthday')}}" class='card-link'>View Birthdays</a>
                            <div class="card-footer">
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-usd fa-2x"></i>
                        </div>
                        <p class="card-category">Subs Collected<br><br></p>
                        <br>
                         <h3 class="card-title">${{$total}}</h3>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    @if($tend == 1)
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-arrow-up fa-2x"></i>
                    @else
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-arrow-down fa-2x"></i>
                    @endif
                        </div>
                        <p class="card-category">Yearly Sqn Attendance<br><br></p>
                            <h3 class="card-title">{{number_format($avgattendance,2)}}% </h3>
                            <div class="card-footer">
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card card-stats">
                    @if($membershipdiff > 0)
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-user-plus fa-2x"></i>
                    @else
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-user-plus fa-2x"></i>
                    @endif
                        </div>
                        <p class="card-category">Membership Increase YTD<br><br></p>
                            <h3 class="card-title">{{$membershipdiff}}</h3>
                            <div class="card-footer">
                            </div>
                    </div>
                </div>
            </div>



    </div>


</div>
@endsection
