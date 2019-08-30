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
            
                            <h2 class="panel-title">Create Semester</h2>
                        </header>
                        <div class="panel-body">
                            @if(Session::has('message'))
                                <div class="alert alert-success">{{Session::get('message')}}</div>
                            @endif
                            <form class="form-horizontal form-bordered" action="{{route('saveSupervisorSemister')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="semister_name">Semester Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="semister_name" class="form-control" placeholder="eg.: Spring" id="semister_name" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="year">Year</label>
                                    <div class="col-md-6">
                                        <select data-plugin-selectTwo class="form-control populate" name="year" id="year">
                                            <option value="">Select Year</option>
                                            <?php
                                                $limit = date('Y')-100;
                                                for ($Year=date('Y'); $Year >= $limit ; $Year--) { 
                                            ?> 
                                            <option value="<?php echo $Year;?>"> <?php echo $Year; ?> </option>
                                            <?php }; ?> 
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="version">Version</label>
                                    <div class="col-md-6">
                                        <input type="text" name="version" class="form-control" placeholder="eg.: v-1" id="version" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                        <a href="{{route('supervisorSemister')}}" class="btn btn-default">Back to List</a>
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

