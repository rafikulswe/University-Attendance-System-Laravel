@extends('web.layouts.master')
<style>
    p {
        margin:0;
    }
    div:first-child .form-group {
        margin-top: 15px;
    }
    .disabled {
        pointer-events: none !important;
    }
</style>
@section('content')
        <!--Start Dashboard-->
        <section class="panel">
            <div class="row">
                <div class="col-xs-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <div class="panel-actions">
                                <a href="#" class="fa fa-caret-down"></a>
                                <a href="#" class="fa fa-times"></a>
                            </div>
            
                            <h2 class="panel-title">Upate Semester</h2>
                        </header>
                        <div class="panel-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success">{{Session::get('message')}}</div>
                            @endif
                        <form class="form-horizontal form-bordered" action="{{route('updateSupervisorSchedule')}}" method="POST">
                            @csrf

                            <input type="hidden" name="semister_id" value="{{$semister_id}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                            @foreach($total_days as $key => $day)
                                <div class="form-group">
                                    <p @if(isset($day->disabled)) class="disabled" @endif> <label class="col-lg-2 col-md-2 control-label"> {{$day->day_name}} <input type="checkbox" name="days[]" value="{{$day->day_index}}" @if(isset($day->schedule)) checked @endif class="pt5"> :</label></p>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <input type="text" data-plugin-timepicker class="form-control endTime" name="start_times[]" placeholder="Start Time" value="{{@$day->schedule->start_time}}" @if(isset($day->disabled)) readonly @endif> 
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <input type="text" data-plugin-timepicker  class="form-control endTime" name="end_times[]" placeholder="End Time" value="{{@$day->schedule->end_time}}" @if(isset($day->disabled)) readonly @endif>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button class="btn btn-primary" id="submit_btn" @if($approval_status == 1) disabled @endif>Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    <a href="{{route('supervisorSemister')}}" class="btn btn-default">Back to List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    </section>
                </div>
            </div>
        </section>
        <!-- end Dashboard -->
    </section>    
@endsection
