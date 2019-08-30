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
            
                            <h2 class="panel-title">Search Report</h2>
                        </header>
                        <div class="panel-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success">{{Session::get('message')}}</div>
                            @endif
                            <form class="form-horizontal form-bordered" action="{{route('admin.attendanceReportAction')}}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="employee_id">Select Employee</label>
                                    <div class="col-md-6">
                                        <select data-plugin-selectTwo class="form-control populate" name="employee_id" id="employee_id" required>
                                            <option value="">Select Employee</option>
                                            @foreach ($employees as $employee)
                                            <option value="{{$employee->employee_id}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="date_from">From:</label>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" data-plugin-datepicker class="form-control" id="date_from" name="date_from" value="" placeholder="From">
                                        </div>
                                    </div>  

                                    <label class="col-md-1 control-label" for="date_to">To:</label>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" data-plugin-datepicker class="form-control" id="date_to" name="date_to" value="" placeholder="To">
                                        </div>
                                    </div>  
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button type="submit" class="btn btn-primary" id="submit_btn">Search</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
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

