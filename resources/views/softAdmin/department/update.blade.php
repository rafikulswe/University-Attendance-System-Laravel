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
            
                            <h2 class="panel-title">Create Department</h2>
                        </header>
                        <div class="panel-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success">{{Session::get('message')}}</div>
                                @endif
                            <form class="form-horizontal form-bordered" action="{{route('admin.updateDept')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="depertment">Department Name</label>
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="{{$userDept->id}}"/>
                                        <input type="text" name="depertment" class="form-control" placeholder="eg.: Software Engineering" id="depertment" value="{{$userDept->depertment}}" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="sort_name">Dept Sort Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="sort_name" class="form-control" placeholder="eg.: SWE" id="sort_name" value="{{$userDept->sort_name}}" required/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-primary" id="submit_btn">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                        <a href="{{route('admin.dept')}}" class="btn btn-default">Back to List</a>
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
