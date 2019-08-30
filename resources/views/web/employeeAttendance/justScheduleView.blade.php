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
            
                            <h2 class="panel-title">View Schedule</h2>
                        </header>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped mb-none">
                                <thead>
                                    <tr>
                                        <th>Day Name</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supervisorSchedule as $semister)
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
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="{{route('admin.supervisorSemister')}}" class="btn btn-default">Back to List</a>
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
