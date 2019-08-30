<?php

namespace App\Http\Controllers\softAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Semisters;
use App\EmployeeSchedules;
use App\EmployeeAttendanceActivities;
use App\User;
use Auth;
use Validator;
use DB;

class SupervisorScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function supervisorSemister()
    {
        $data['supervisorSemisters'] = User::join('semisters', 'semisters.employee_id', '=', 'users.id')
                ->select('users.*', 'semisters.semister_name', 'semisters.year', 'semisters.version', 'semisters.id as semister_id', 'semisters.approval_status')
                ->where('users.assign_advisor', 0) 
                ->where('semisters.valid', 1) 
                ->get();
        return view('softAdmin.supervisorSemister.semisterList', $data);
    }

    public function viewSupervisorSchedule($id)
    {
        $data['semister_id'] = $semister_id = $id;
        $data['activity_id'] = EmployeeAttendanceActivities::where('semister_id', $semister_id)->first()->id;
        $data['employeeSchedule'] = EmployeeSchedules::join('schedule_days', 'schedule_days.day_index', '=', 'employee_schedules.day_index')
                ->select('employee_schedules.*', 'schedule_days.day_name')
                ->where('employee_schedules.semister_id', $id)
                ->where('employee_schedules.valid', 1)
                ->get();
        return view('softAdmin.supervisorSemister.scheduleView', $data);
    }
    
    public function approveSupervisorSchedule(Request $request)
    {
        $input = $request->all();
        $semister_id = $request->semister_id;
        $activity_id = $request->activity_id;

        $validator = Validator::make($input, [
            'approval_status'    => 'required'
        ]);
        
        $updateCheck = Semisters::where('id', $semister_id)->where('valid', 1)->first();
        $activityUpdateCheck = EmployeeAttendanceActivities::where('id', $activity_id)->first();
        if ($validator->passes()) {
            DB::beginTransaction();
            $updateCheck->update([
                "approval_status"    => $request->approval_status,
                "approved_by"        => 0
            ]);

            $activityUpdateCheck->update([
                "seen_status"        => 1
            ]);
            DB::commit();
            return redirect()->route('admin.viewSupervisorSchedule',$semister_id)->with('message', 'Schedule Status has been Updated');
        }
    }

    public function justScheduleView($id)
    {
        $data['semister_id'] = $semister_id = $id;
        $data['supervisorSchedule'] = EmployeeSchedules::join('schedule_days', 'schedule_days.day_index', '=', 'employee_schedules.day_index')
                ->select('employee_schedules.*', 'schedule_days.day_name')
                ->where('employee_schedules.semister_id', $id)->where('employee_schedules.valid', 1)->get();
        return view('softAdmin.supervisorSemister.justScheduleView', $data);
    }
}
