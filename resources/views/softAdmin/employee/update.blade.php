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
            
                            <h2 class="panel-title">Create Employee</h2>
                        </header>
                        <div class="panel-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success">{{Session::get('message')}}</div>
                            @endif
                        <form class="form-horizontal form-bordered" action="{{route('admin.updateEmployee')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">Employee Name</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{$user->id}}"/>
                                    <input type="text" name="name" class="form-control" placeholder="eg.: John Doe" id="name" value="{{$user->name}}" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">Employee Email</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="email" value="{{$user->email}}"/>
                                    <input type="email" name="email" class="form-control" placeholder="eg.: demo@gmail.com" id="email" value="{{$user->email}}" disabled required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Depertment</label>
                                <div class="col-md-6">
                                    <select data-plugin-selectTwo class="form-control populate" name="depertment_id">
                                        <option value="">Select Supervisor</option>
                                        @foreach ($userDepts as $userDept)
                                            <option @if($user->depertment_id == $userDept->id) selected @endif value="{{$userDept->id}}">{{$userDept->depertment}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Designation</label>
                                <div class="col-md-6">
                                    <select data-plugin-selectTwo class="form-control populate" name="designation_id">
                                        <option value="">Select Designation</option>
                                        @foreach ($userdesignations as $userdesignation)
                                            <option @if($user->designation_id == $userdesignation->id) selected @endif value="{{$userdesignation->id}}">{{$userdesignation->designation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Assign Supervisor</label>
                                <div class="col-md-6">
                                    <select data-plugin-selectTwo class="form-control populate" name="assign_advisor">
                                        <option value="">Select Supervisor</option>
                                        @foreach ($supervisor as $advisor)
                                            <option @if($user->assign_advisor == $advisor->id) selected @endif value="{{$advisor->id}}">{{$advisor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button class="btn btn-primary" id="submit_btn">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    <a href="{{route('admin.employee')}}" class="btn btn-default">Back to List</a>
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
