@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(session()->has('success'))
        <div class="row">
            <div class="col-12 alert alert-success" role="alert">
                <strong>{{session()->get('success')}}</strong>
            </div>
        </div>
    @endif
    @if(session()->has('failure'))
        <div class="row">
            <div class="col-12 alert alert-danger" role="alert">
                <strong>{{session()->get('failure')}}</strong>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class = "pull-left">
                        <form cclass="navbar-form">
                            <span class="bmd-form-group">
                                <div class="input-group no-border">
                                    <button class = "btn btn-white btn-round btn-just-icon fa fa-search"></button>
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Roll Here"/>
                                </div>
                            </span>
                        </form>
                    </div>
                  <!--  <div class="pull-right new-button">
                        <a href="{{action('RollController@create')}}" class="btn btn-primary"  title="Create New Roll"><i class="fa fa-plus fa-2x"></i>Create New Roll</a>
                    </div>  -->
                    <button class="btn btn-round btn-primary pull-right" data-toggle="modal" data-target="#newrollModal"><i class="fa fa-plus fa-2x"></i>New Roll</button>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table" id="roll">
                            <thead class = "text-primary">
                            <h4> Roll Date: {{date("l - jS F Y",strtotime($rolldate))}}</h4>
                                <tr>
                                    <th width="20%"></th>
                                    <th class="text-center">Member</th>
                                    <th width = "20%" class="text-center">Rank</th>
                                    <th class="text-center">Present</th>
                                    <th class="text-center">Voucher Balance</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($member as $r)
                                <tr>
                                    <td class="text-center">
                                        @if ($r->status == 'A')
                                        <a href="{{action('RollController@paid', $r->id)}}" title="Paid" class="btn btn-success btn-round"><i class="material-icons">done</i></a>
                                        <a href="{{action('RollController@voucher', $r->id)}}"  title="Voucher" class="btn btn-info btn-round"><i class ="material-icons">local_activity</i></a>
                                        <a href="{{action('RollController@notpaid', $r->id)}}" title="Not Paid" class="btn btn-danger btn-round"><i class="material-icons">close</i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$r->member->last_name}}, {{$r->member->first_name}} </td>
                                    <td class="text-center">{{$r->member->memberrank->rank}}</td>
                                    <td class="text-center">{{$r->rollstatus->status}}</td>
                                    @if ($r->ActiveKids->sum('balance') != 0)
                                        <td class="text-center"><strong>${{$r->ActiveKids->sum('balance')}}</strong></td>
                                    @else
                                        <td style="border-top: 1px #ddd solid"></td>
                                    @endif
                                    <td>
                                        <a href="{{action('MembersController@show', $r->member->id)}}" title="Show Member" class="btn btn-success btn-round"><i class="fa fa-info"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newrollModal" tabindex="-1" role="dialog" aria-labelledby="NewRollLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">New Roll</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!!Form::open(array('action' => ['RollController@store'], 'method'=>'POST', 'class'=>'form-horizontal'))!!}
            <div class="modal-body">
                    <div class="form-group">
                        <label class="label-control">Enter Date:</label>
                            <div class="input-group">
                                <input type="text" class="form-control datetimepicker" name="rolldate" value="{{Carbon\Carbon::now()->format('d-m-Y')}}">
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-round">Create Roll</button>
            </div>
            {!!Form::close()!!}
          </div>
        </div>
    </div>
@endsection


@section ('scripts')

<script>
   // Write on keyup event of keyword input element
   $(document).ready(function(){
     $("#search").keyup(function(){
     _this = this;

     // Show only matching TR, hide rest of them
     $.each($("#roll tbody tr"), function() {
       if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
       {
           $(this).hide();
       }
       else
       {
          $(this).show();
       }
     });
  });
});
</script>



@stop
