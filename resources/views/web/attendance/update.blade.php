@extends('web.layouts.master')

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
                        <form class="form-horizontal form-bordered" action="{{route('updateAttendance')}}" method="POST">
                            @csrf

                            <?php 
                                $attend_date = DateTime::createFromFormat('Y-m-d', $attendance->attend_date)->format('m/d/Y');
                                $start_time = DateTime::createFromFormat('H:i:s', $attendance->start_time)->format('g:i A');
                                $end_time = DateTime::createFromFormat('H:i:s', $attendance->end_time)->format('g:i A');
                            ?>
                            <input type="hidden" name="id" value="{{$attendance->id}}"/>
                            <div class="form-group">
                                <div class="col-lg-4 col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" data-plugin-datepicker class="form-control" name="attend_date" value="{{$attend_date}}" placeholder="Date">
                                    </div>
                                </div>  

                                <div class="col-lg-4 col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </span>
                                        <input type="text" data-plugin-timepicker class="form-control" id="start_time" name="start_time" placeholder="In Time" value="{{$start_time}}">
                                    </div>
                                </div>   

                                <div class="col-lg-4 col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </span>
                                        <input type="text" data-plugin-timepicker class="form-control" id="end_time" name="end_time" placeholder="Out Time" value="{{$end_time}}">
                                    </div>
                               </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button class="btn btn-primary" id="submit_btn">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    <a href="{{route('attendance')}}" class="btn btn-default">Back to List</a>
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
