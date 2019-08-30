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
            
                            <h2 class="panel-title">{{$attendance->name}} @if($attendance->approval_status == 1) <span style="color:red;">Approved</span> @endif</h2>
                        </header>
                        <div class="panel-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success">{{Session::get('message')}}</div>
                            @endif

                            <table class="table table-bordered table-striped mb-none">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $start_time = DateTime::createFromFormat('H:i:s', $attendance->start_time)->format('g:i A');
                                        $end_time = DateTime::createFromFormat('H:i:s', $attendance->end_time)->format('g:i A');
                                    ?>
                                    <tr class="gradeX">
                                        <td>{{$attendance->attend_date}}</td>
                                        <td>{{$start_time}}</td>
                                        <td>{{$end_time}}</td>
                                    </tr>
                                </tbody>
                            </table><br>
                        <form class="form-horizontal form-bordered" action="{{route('approveEmpAttendance')}}" method="POST">
                            @csrf    

                            <input type="hidden" name="activity_id" value="{{$activity_id}}">
                            <input type="hidden" name="attendance_id" value="{{$attendance->id}}">
                            @if($attendance->approval_status == 0)
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="approve_remarks">Remarks</label>
                                <div class="col-md-6">
                                    <input type="text" name="approve_remarks" class="form-control" placeholder="eg.: Remarks" id="approve_remarks"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="approval_status">Approval Status</label>
                                <div class="col-md-6">
                                    <select data-plugin-selectTwo class="form-control populate" name="approval_status" id="approval_status" required>
                                        <option value="">Select Status</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button class="btn btn-primary" id="submit_btn" @if($attendance->approval_status == 1) style="display:none;" @endif>Submit</button>
                                    <a href="{{route('employeeAttendance')}}" class="btn btn-default">Back to List</a>
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
