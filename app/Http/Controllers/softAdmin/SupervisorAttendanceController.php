<?php

namespace App\Http\Controllers\softAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\DailyAttendances;
use App\EmployeeAttendanceActivities;
use Validator;
use DateTime;
use PDF;
use DB;

class SupervisorAttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $data['attendances'] = EmployeeAttendanceActivities::join('users', 'users.id', '=', 'employee_attendance_activities.employee_id')
                ->join('daily_attendances', 'daily_attendances.id', '=', 'employee_attendance_activities.attendance_id')
                ->select('employee_attendance_activities.*', 'users.name', 'daily_attendances.approval_status')
                ->where('employee_attendance_activities.assign_advisor_id', 0) 
                ->where('employee_attendance_activities.user_type', 1) 
                ->get();
        $data['semisters'] = EmployeeAttendanceActivities::join('users', 'users.id', '=', 'employee_attendance_activities.employee_id')
                ->join('semisters', 'semisters.id', '=', 'employee_attendance_activities.semister_id')
                ->select('employee_attendance_activities.*', 'users.name', 'semisters.approval_status')
                ->where('employee_attendance_activities.assign_advisor_id', 0) 
                ->where('employee_attendance_activities.user_type', 1) 
                ->get();
        return view('softAdmin.supervisorAttendance.attendanceList', $data);
    }

    public function viewSupAttendance($id)
    {
        $data['activity_id'] = $activity_id = $id;

        $data['attendance'] = DailyAttendances::join('employee_attendance_activities', 'employee_attendance_activities.attendance_id', '=', 'daily_attendances.id')
                ->join('users', 'users.id', '=', 'daily_attendances.employee_id')
                ->select('daily_attendances.*', 'users.name')
                ->where('employee_attendance_activities.id', $activity_id) 
                ->first();
        return view('softAdmin.supervisorAttendance.attendDetails', $data);
    }

    public function approveSupAttendance(Request $request)
    {
        $input = $request->all();
        $activity_id = $request->activity_id;
        $attendance_id = $request->attendance_id;

        $validator = Validator::make($input, [
            'approval_status'    => 'required'
        ]);
        
        $attendanceUpdateCheck = DailyAttendances::where('id', $attendance_id)->where('valid', 1)->first();
        $activityUpdateCheck = EmployeeAttendanceActivities::where('id', $activity_id)->first();
        if ($validator->passes()) {
            DB::beginTransaction();
            $attendanceUpdateCheck->update([
                "approval_status"    => $request->approval_status,
                "approve_remarks"    => $request->approve_remarks,
                "approved_by"        => 0
            ]);

            $activityUpdateCheck->update([
                "seen_status"        => 1
            ]);
            DB::commit(); 
            return redirect()->route('admin.viewSupAttendance',$activity_id)->with('message', 'Attendace Status has been Updated');
        }
    }

    public function reportSearch()
    {
        $data['employees'] = DailyAttendances::join('users', 'users.id', '=', 'daily_attendances.employee_id')
                ->select('daily_attendances.*', 'users.name')
                ->where('daily_attendances.user_type', 1) 
                ->get();
        return view('softAdmin.supervisorAttendance.searchReport', $data);
    }
    public function reportSearchAction(Request $request)
    {
        $input = $request->all();
        $data['employee_id'] = $employee_id = $request->employee_id;
        $data['date_from'] = $date_from = $request->date_from;
        $data['date_to'] = $date_to = $request->date_to;

        $date_from = DateTime::createFromFormat('m/d/Y', $date_from)->format('Y-m-d');
        $date_to = DateTime::createFromFormat('m/d/Y', $date_to)->format('Y-m-d');

        $data['employeeReport'] = DailyAttendances::where('employee_id', '=',  $employee_id)
                ->whereBetween('attend_date', [$date_from, $date_to]) 
                ->get();
        $data['employeeDetails'] = User::find($employee_id);
        return view('softAdmin.supervisorAttendance.searchReportResult', $data);
    }

    public function printReport(Request $request)
    {
        $input = $request->all();
        $employee_id = $request->employee_id;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $date_from = DateTime::createFromFormat('m/d/Y', $date_from)->format('Y-m-d');
        $date_to = DateTime::createFromFormat('m/d/Y', $date_to)->format('Y-m-d');

        $data['employeeReport'] = DailyAttendances::where('employee_id', '=',  $employee_id)
                ->whereBetween('attend_date', [$date_from, $date_to]) 
                ->get();
        $data['employeeDetails'] = User::find($employee_id);

        $pdf = PDF::loadView('web.employeeAttendance.searchReportResultpdf', $data);
        return $pdf->setPaper('a4', 'landscape')->download('Attendance Report.pdf');
    }
}
