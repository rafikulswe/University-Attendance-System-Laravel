@extends('softAdmin.master')

@section('content')
        <!--Start Dashboard-->
        <section class="panel">
            <header class="page-header">
                <h2>Supervisor Notifications</h2>
            
                <div class="right-wrapper pull-right">
                    <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>
            <div class="panel-body">
                <!--Start Dashboard-->
                <section class="panel">
                        <div class="tab-content">
                            <div id="everything" class="tab-pane active">
                                <p class="total-results text-muted">All Supervisor's Notifications</p>
        
                                <ul class="list-unstyled search-results-list" style="max-width: 100%!important;">
                                    @if(!empty($attendances))
                                    @foreach ($attendances as $notification)
                                    <li>
                                        @if($notification->approval_status == 1)
                                        <p class="result-type">
                                            <span class="label label-primary">Approved</span>
                                        </p>
                                        @else 
                                        <p class="result-type">
                                            <span class="label label-warning">Pending</span>
                                        </p>
                                        @endif
                                        <a href="{{route('admin.viewSupAttendance',$notification->id)}}">
                                            <div class="result-data">
                                                <p class="h3 title text-primary">{{$notification->name}}</p>
                                                <p class="description">Dear Sir, I didn't gave fingerprint on {{$notification->attend_date}}, that's why i give my in & out time. Please verify and approve it. Thank You</p>
                                            </div>
                                        </a>
                                    </li>   
                                    @endforeach
                                    @endif

                                    @if(!empty($semisters))
                                    @foreach ($semisters as $semister)
                                    <li>
                                        @if($semister->approval_status == 1)
                                        <p class="result-type">
                                            <span class="label label-primary">Approved</span>
                                        </p>
                                        @else 
                                        <p class="result-type">
                                            <span class="label label-warning">Pending</span>
                                        </p>
                                        @endif
                                        <a href="{{route('admin.viewSupervisorSchedule',$semister->id)}}">
                                            <div class="result-data">
                                                <p class="h3 title text-primary">{{$semister->name}}</p>
                                                <p class="description">Dear Sir, I created a new schedule. Please check and approve it. Thank You</p>
                                            </div>
                                        </a>
                                    </li>   
                                    @endforeach
                                    @endif

                                </ul>
        
                                {{-- <hr class="solid mb-none" /> --}}
                            </div>
                        </div>
                </section>
                <!-- end Dashboard -->
            </div>
        </section>
        <!-- end Dashboard -->
    </section>            
@endsection
