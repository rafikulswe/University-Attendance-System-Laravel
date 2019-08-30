@extends('web.layouts.master')

@section('content')
        <!--Start Dashboard-->
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
        
                <h2 class="panel-title">Attendance List</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6" style="float:right;">
                        <div class="mb-md" style="float:right;">
                            <a href="{{route('createAttendance')}}" class="btn btn-primary create">Add <i class="fa fa-plus"></i></a>
                            <a href="{{route('ownAttendReport')}}" class="btn btn-primary create">Report <i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-none">
                    <thead>
                        <tr>
                            <th>Attendance Date</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                        <?php 
                        $attendance->start_time = DateTime::createFromFormat('H:i:s', $attendance->start_time)->format('g:i A');
                        $attendance->end_time = DateTime::createFromFormat('H:i:s', $attendance->end_time)->format('g:i A');
                        ?>
                        <tr class="gradeX">
                            <td>{{$attendance->attend_date}}</td>
                            <td>{{$attendance->start_time}}</td>
                            <td>{{$attendance->end_time}}</td>
                            <td class="actions">
                                @if($attendance->approval_status == 0)
                                <a href="{{route('editAttendance',$attendance->id)}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                @else Approved @endif
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
