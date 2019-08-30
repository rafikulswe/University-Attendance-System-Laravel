@extends('softAdmin.master')

@section('content')
        <!--Start Dashboard-->
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
        
                <h2 class="panel-title">Department List</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6" style="float:right;">
                        <div class="mb-md" style="float:right;">
                            <a href="{{route('admin.createDept')}}" class="btn btn-primary create">Add <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped mb-none">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Department</th>
                            <th>Sort Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userDepts as $userDept)
                        <tr class="gradeX">
                            <td>{{$userDept->id}}</td>
                            <td>{{$userDept->depertment}}</td>
                            <td>{{$userDept->sort_name}}</td>
                            <td class="actions">
                                <a href="{{route('admin.editDept',$userDept->id)}}" class="on-default"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
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
