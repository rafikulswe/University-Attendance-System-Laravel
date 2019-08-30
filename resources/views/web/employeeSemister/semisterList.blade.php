@extends('web.layouts.master')

@section('content')
        <!--Start Dashboard-->
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
        
                <h2 class="panel-title">Employee Semester List</h2>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-striped mb-none">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeSemisters as $semister)
                        <tr class="gradeX">
                            <td>{{$semister->name}}</td>
                            <td>{{$semister->semister_name}}-{{$semister->year}}-{{$semister->version}}</td>
                            <td class="actions">
                                <a href="{{route('viewEmployeeSchedule',$semister->semister_id)}}" class="btn btn-info" @if($semister->approval_status == 1) disabled @endif>Schedule</a>
                                @if($semister->approval_status == 1) Approved @endif
                                @if($semister->approval_status == 1) <a href="{{route('justScheduleView',$semister->semister_id)}}" class="btn btn-info">View</a> @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <!-- end Dashboard -->
    </section>            
@endsection
