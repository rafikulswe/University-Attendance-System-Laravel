@extends('softAdmin.master')

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
            
                            <h2 class="panel-title">Update Status</h2>
                        </header>
                        <div class="panel-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success">{{Session::get('message')}}</div>
                            @endif

                            <table class="table table-bordered table-striped mb-none">
                                <thead>
                                    <tr>
                                        <th>Day Name</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employeeSchedule as $semister)
                                    <?php 
                                        $start_time = DateTime::createFromFormat('H:i:s', $semister->start_time)->format('g:i A');
                                        $end_time = DateTime::createFromFormat('H:i:s', $semister->end_time)->format('g:i A');
                                    ?>
                                    <tr class="gradeX">
                                        <td>{{$semister->day_name}}</td>
                                        <td>{{$start_time}}</td>
                                        <td>{{$end_time}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><br>
                        <form class="form-horizontal form-bordered" action="{{route('admin.approveSupervisorSchedule')}}" method="POST">
                            @csrf    

                            <input type="hidden" name="semister_id" value="{{$semister_id}}">
                            <input type="hidden" name="activity_id" value="{{$activity_id}}">
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

                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button class="btn btn-primary" id="submit_btn">Submit</button>
                                    <a href="{{route('admin.supervisorSemister')}}" class="btn btn-default">Back to List</a>
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
