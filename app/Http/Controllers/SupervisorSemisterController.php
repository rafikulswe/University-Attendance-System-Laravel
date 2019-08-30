<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semisters;
use App\EmployeeSchedules;
use App\EmployeeAttendanceActivities;
use App\User;
use Auth;
use Validator;
use DB;
use DateTime;

class SupervisorSemisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $data['semisters'] = Semisters::where('employee_id', $user_id)
                ->where('valid', 1)
                ->get();
        return view('web.semister.semisterList', $data);
    }

    public function create(){
        return view('web.semister.create');
    }

    public function store(Request $request){
        $input = $request->all();
        $user_id = Auth::user()->id;
        $user_type = Auth::user()->assign_advisor;
        $validator = Validator::make($input, [
            'semister_name'    => 'required',
            'year'             => 'required',
            'version'          => 'required'
        ]);

        if ($validator->passes()) {
            DB::beginTransaction();
            Semisters::create([
                "employee_id"      => $user_id,
                "semister_name"    => $request->semister_name,
                "year"             => $request->year,
                "version"          => $request->version,
                "user_type"        => ($user_type == 0)? 1 : 2, //1=supervisor, 2= employee
                "approval_status"  => 0
            ]);

            $semister_id = Semisters::where('employee_id', $user_id)->orderBy('id', 'desc')->first()->id;
            EmployeeAttendanceActivities::create([
                "semister_id"      => $semister_id,
                "employee_id"      => $user_id,
                "assign_advisor_id"=> $user_type,
                "user_type"        => ($user_type == 0)? 1 : 2 //1=supervisor, 2= employee
            ]);
            DB::commit();
            return redirect()->route('createSupervisorSemister')->with('message', 'Schedule has been created');
        }
    }

    public function edit($id){
        $user_id = Auth::user()->id;
        $data['semister'] = Semisters::where('employee_id', $user_id)->where('valid', 1)->find($id);
        return view('web.semister.update', $data);
    }

    public function update(Request $request){
        $input = $request->all();
        $id = $request->id;
        $validator = Validator::make($input, [
            'semister_name'    => 'required',
            'year'             => 'required',
            'version'          => 'required'
        ]);
        $updateCheck = Semisters::where('id', $id)->where('valid', 1)->first();
        if ($validator->passes()) {
            $updateCheck->update([
                "semister_name"    => $request->semister_name,
                "year"             => $request->year,
                "version"          => $request->version
            ]);
            return redirect()->route('editSupervisorSemister',$id)->with('message', 'Schedule has been Updated');
        }
    }

    public function editSchedule($id){
        $user_id = Auth::user()->id;
        $data['semister_id'] = $semister_id = $id;
        $total_days = DB::table('schedule_days')->get();

        $used_schedule = EmployeeSchedules::join('semisters', 'semisters.id', '=', 'employee_schedules.semister_id')
                ->select('employee_schedules.*','semisters.*')
                ->where('employee_schedules.employee_id', $user_id) 
                ->where('semisters.approval_status', 1) 
                ->get();
        $used_scheduled = collect($used_schedule)->pluck('day_index')->all();
        // dd($used_scheduled);     
        
        foreach($total_days as $day) {
            $schedule = EmployeeSchedules::where('semister_id', $semister_id)
                ->where('employee_id', $user_id) 
                ->where('day_index', $day->day_index)
                ->first();
            
            if(!empty($schedule)) {
                $day->schedule = $schedule;

                $day->schedule->start_time = DateTime::createFromFormat('H:i:s', $day->schedule->start_time)->format('g:i A');
                $day->schedule->end_time = DateTime::createFromFormat('H:i:s', $day->schedule->end_time)->format('g:i A');

                if(in_array($schedule->day_index, $used_scheduled)) {
                    $day->disabled = true;
                }
            }
        }
        $data['approval_status'] = Semisters::where('id', $semister_id)->first()->approval_status;
        $data['total_days'] = $total_days;
        return view('web.semister.editSchedule', $data);
    }

    public function updateSchedule(Request $request){
        $input = $request->all();
        $semister_id = $request->semister_id;
        $user_id = $request->user_id;
        $days = $request->days;
        $start_times = $request->start_times;
        $end_times = $request->end_times;
        $output = array();

        if(!empty($days)) {
            $validation = true;
            foreach($days as $day) {
                if(empty($start_times[$day]) || empty($end_times[$day] || $start_times[$day]<$end_times[$day])) {
                    $validation = false;
                }
            }
            if($validation) {
                $schedule_db = EmployeeSchedules::where('semister_id', $semister_id)
                        ->where('employee_id', $user_id)
                        ->get()
                        ->pluck('day_index')
                        ->all();

                $schedule_diff = array_diff($schedule_db, $days);

                //DELETE DIFFRENT DATA
                EmployeeSchedules::where('semister_id', $semister_id)
                        ->where('employee_id', $user_id)
                        ->whereIn('day_index', $schedule_diff)
                        ->delete();

                foreach($days as $day) {
                    $start_time = DateTime::createFromFormat('g:i A', $start_times[$day]);
                    $start_time = $start_time->format('H:i:s');
                    
                    $end_time = DateTime::createFromFormat('g:i A', $end_times[$day]);
                    $end_time = $end_time->format('H:i:s');

                    $data['semister_id'] = $semister_id;
                    $data['employee_id'] = $user_id;
                    $data['day_index'] = $day;
                    $data['start_time'] = $start_time;
                    $data['end_time'] = $end_time;

                    $schedule = EmployeeSchedules::where('semister_id', $semister_id)
                            ->where('employee_id', $user_id)
                            ->where('day_index', $day)
                            ->first();
                                    
                    if(!empty($schedule)) {
                        EmployeeSchedules::where('semister_id', $semister_id)
                            ->where('employee_id', $user_id)
                            ->where('day_index', $day)
                            ->update($data);

                        $output['message'] = 'Schedule has been updated';
                    } else {
                        EmployeeSchedules::create($data);
                        $output['message'] = 'Schedule has been created';
                    }
                }
                $output['msgType'] = 'success';
            } else {
                $output['message'] = 'Please input time correctly';
                $output['msgType'] = 'danger';
            } 
        } else {
            $output['message'] = 'Please select a day';
            $output['msgType'] = 'danger';
        }  
        return redirect()->route('editSupervisorSchedule',$semister_id)->with($output);
    }

    public function employeeSemister()
    {
        $user_id = Auth::user()->id;
        $data['employeeSemisters'] = User::join('semisters', 'semisters.employee_id', '=', 'users.id')
                ->select('users.*', 'semisters.semister_name', 'semisters.year', 'semisters.version', 'semisters.id as semister_id', 'semisters.approval_status')
                ->where('users.assign_advisor', $user_id) 
                ->where('semisters.valid', 1) 
                ->get();
        return view('web.employeeSemister.semisterList', $data);
    }

    public function viewEmployeeSchedule($id)
    {
        $data['semister_id'] = $semister_id = $id;
        $data['activity_id'] = EmployeeAttendanceActivities::where('semister_id', $semister_id)->first()->id;
        $user_id = Auth::user()->id;
        $data['employeeSchedule'] = EmployeeSchedules::join('schedule_days', 'schedule_days.day_index', '=', 'employee_schedules.day_index')
                ->select('employee_schedules.*', 'schedule_days.day_name')
                ->where('employee_schedules.semister_id', $id)
                ->where('employee_schedules.valid', 1)
                ->get();
        return view('web.employeeSemister.scheduleView', $data);
    }
    
    public function approveEmployeeSchedule(Request $request)
    {
        $input = $request->all();
        $semister_id = $request->semister_id;
        $activity_id = $request->activity_id;
        $user_id = Auth::user()->id;

        $validator = Validator::make($input, [
            'approval_status'    => 'required'
        ]);
        
        $updateCheck = Semisters::where('id', $semister_id)->where('valid', 1)->first();
        $activityUpdateCheck = EmployeeAttendanceActivities::where('id', $activity_id)->first();
        // dd();
        if ($validator->passes()) {
            DB::beginTransaction();
            $updateCheck->update([
                "approval_status"    => $request->approval_status,
                "approved_by"        => $user_id
            ]);

            $activityUpdateCheck->update([
                "seen_status"        => 1
            ]);
            DB::commit();
            return redirect()->route('viewEmployeeSchedule',$semister_id)->with('message', 'Schedule Status has been Updated');
        }
    }

    public function justScheduleView($id)
    {
        $data['semister_id'] = $semister_id = $id;
        $user_id = Auth::user()->id;
        $data['employeeSchedule'] = EmployeeSchedules::join('schedule_days', 'schedule_days.day_index', '=', 'employee_schedules.day_index')
                ->select('employee_schedules.*', 'schedule_days.day_name')
                ->where('employee_schedules.semister_id', $id)->where('employee_schedules.valid', 1)->get();
        return view('web.employeeSemister.justScheduleView', $data);
    }
}
