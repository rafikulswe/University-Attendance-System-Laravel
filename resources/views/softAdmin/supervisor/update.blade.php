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
            
                            <h2 class="panel-title">Create Supervisor</h2>
                        </header>
                        <div class="panel-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success">{{Session::get('message')}}</div>
                                @endif
                            <form class="form-horizontal form-bordered" action="{{route('admin.updateSupervisor')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">Supervisor Name</label>
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="{{$user->id}}"/>
                                        <input type="text" name="name" class="form-control" placeholder="eg.: John Doe" id="name" value="{{$user->name}}" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="email">Supervisor Email</label>
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
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button class="btn btn-primary" id="submit_btn">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                        <a href="{{route('admin.supervisor')}}" class="btn btn-default">Back to List</a>
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

@section('javaScript')
<script>
    $("#basicInfoForm").formValidation().on('success.form.fv', function(e) {
        e.preventDefault();
        $("#submit_btn").val("Saving...").attr("disabled", "disabled");
        var postData = $(this).serializeArray();

        $.ajax({
            url : "{{route('admin.saveSupervisor')}}",
            type: "POST",
            data: postData,
            dataType: 'json',
            success:function(data){
                var status = parseInt(data.status);

                if(data.status ==1) {
                   $('#errorMsg').html('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <i class="fa fa-adjust alert-icon"></i> '+data.messege+'</div>');
                    $("#submit_btn").removeAttr("disabled").removeClass("disabled");
                    setTimeout(function() {$('#massDiv').hide()}, 3000);
                    // $('.social_links_main_row').load(' .social_links_main_div');
                } 
                else if(data.status==0) {
                    $('#errorMsg').html('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <i class="fa fa-adjust alert-icon"></i> '+data.messege+'</div>');
                        setTimeout(function() {$('#massDiv').hide()}, 3000);
                }
                $("#submit_btn").val("Submit").removeAttr("disabled").removeClass("disabled");
            }
        });
    });
</script>
@endsection