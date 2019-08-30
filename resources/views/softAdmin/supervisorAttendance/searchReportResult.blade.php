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
            
                            <h2 class="panel-title">{{$employeeDetails->name}}'s Report</h2>
                        </header>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped mb-none">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>In Time</th>
                                        <th>Out Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employeeReport as $report)
                                    <?php 
                                        $start_time = DateTime::createFromFormat('H:i:s', $report->start_time)->format('g:i A');
                                        $end_time = DateTime::createFromFormat('H:i:s', $report->end_time)->format('g:i A');
                                    ?>
                                    <tr class="gradeX">
                                        <td>{{$report->attend_date}}</td>
                                        <td>{{$start_time}}</td>
                                        <td>{{$end_time}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><br>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                        <a href="{{route('admin.printReport', ['employee_id'=>$employee_id, 'date_from'=>$date_from, 'date_to'=>$date_to])}}" target="_blank" class="btn btn-default">PDF</a>
                                    <a href="{{route('admin.attendanceReport')}}" class="btn btn-default">Search Again</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <!-- end Dashboard -->
    </section>    
@endsection
