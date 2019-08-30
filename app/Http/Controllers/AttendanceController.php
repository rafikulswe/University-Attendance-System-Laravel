<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DailyAttendances;
use App\EmployeeAttendanceActivities;
use Auth;
use Validator;
use DB;
use DateTime;
use PDF;

class AttendanceController extends Controller
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
        $data['attendances'] = DailyAttendances::where('employee_id', $user_id)
            ->where('valid', 1)
            ->get();
        return view('web.attendance.attendList', $data);
    }

    public function create()
    {
        return view('web.attendance.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        $user_type = Auth::user()->assign_advisor;

        $validator = Validator::make($input, [
            'attend_date'    => 'required',
            'start_time'     => 'required',
            'end_time'       => 'required'
        ]);

        $attend_date = DateTime::createFromFormat('m/d/Y', $request->attend_date)->format('Y-m-d');

        $start_time = DateTime::createFromFormat('g:i A', $request->start_time);
        $start_time = $start_time->format('H:i:s');
        
        $end_time = DateTime::createFromFormat('g:i A', $request->end_time);
        $end_time = $end_time->format('H:i:s');

        if ($validator->passes()) {
            DB::beginTransaction();
            DailyAttendances::create([
                "employee_id"      => $user_id,
                "attend_date"      => $attend_date,
                "start_time"       => $start_time,
                "end_time"         => $end_time,
                "user_type"        => ($user_type == 0)? 1 : 2, //1=supervisor, 2= employee
                "approval_status"  => 0
            ]);
            $attendance_id = DailyAttendances::where('employee_id', $user_id)->orderBy('id', 'desc')->first()->id;
            //Record employee activity for notifications
            EmployeeAttendanceActivities::create([
                "attendance_id"    => $attendance_id,
                "employee_id"      => $user_id,
                "attend_date"      => $attend_date,
                "assign_advisor_id"=> $user_type,
                "user_type"        => ($user_type == 0)? 1 : 2 //1=supervisor, 2= employee
            ]);
            DB::commit();
            return redirect()->route('createAttendance')->with('message', 'Attendance has been Inserted');
        }
        
    }

    public function edit($id){
        $user_id = Auth::user()->id;
        $data['attendance'] = DailyAttendances::where('employee_id', $user_id)->where('valid', 1)->find($id);
        return view('web.attendance.update', $data);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $id = $request->id;
        $user_id = Auth::user()->id;
        $user_type = Auth::user()->assign_advisor;

        $validator = Validator::make($input, [
            'attend_date'    => 'required',
            'start_time'     => 'required',
            'end_time'       => 'required'
        ]);
        
        $attend_date = DateTime::createFromFormat('m/d/Y', $request->attend_date)->format('Y-m-d');

        $start_time = DateTime::createFromFormat('g:i A', $request->start_time);
        $start_time = $start_time->format('H:i:s');
        
        $end_time = DateTime::createFromFormat('g:i A', $request->end_time);
        $end_time = $end_time->format('H:i:s');

        $attendanceUpdateCheck = DailyAttendances::where('id', $id)->where('valid', 1)->where('employee_id', $user_id)->first();
        $AcitivityUpdateCheck = EmployeeAttendanceActivities::where('attendance_id', $id)->where('employee_id', $user_id)->first();
        if ($validator->passes()) {
            DB::beginTransaction();
            $attendanceUpdateCheck->update([
                "attend_date"      => $attend_date,
                "start_time"       => $start_time,
                "end_time"         => $end_time
            ]);

            $AcitivityUpdateCheck->update([
                "attend_date"      => $attend_date
            ]);
            DB::commit();
            return redirect()->route('editAttendance',$id)->with('message', 'Attendance has been Updated');
        }
    }

    //For View Employee Notifications
    public function employeeAttendance(){
        $user_id = Auth::user()->id;
        $data['attendances'] = EmployeeAttendanceActivities::join('users', 'users.id', '=', 'employee_attendance_activities.employee_id')
                ->join('daily_attendances', 'daily_attendances.id', '=', 'employee_attendance_activities.attendance_id')
                ->select('employee_attendance_activities.*', 'users.name', 'daily_attendances.approval_status')
                ->where('employee_attendance_activities.assign_advisor_id', $user_id) 
                ->where('employee_attendance_activities.user_type', 2) 
                ->get();
        $data['semisters'] = EmployeeAttendanceActivities::join('users', 'users.id', '=', 'employee_attendance_activities.employee_id')
                ->join('semisters', 'semisters.id', '=', 'employee_attendance_activities.semister_id')
                ->select('employee_attendance_activities.*', 'users.name', 'semisters.approval_status')
                ->where('employee_attendance_activities.assign_advisor_id', $user_id) 
                ->where('employee_attendance_activities.user_type', 2) 
                ->get();
        return view('web.employeeAttendance.attendanceList', $data);
    }

    public function viewEmpAttendance($id)
    {
        $data['activity_id'] = $activity_id = $id;

        $data['attendance'] = DailyAttendances::join('employee_attendance_activities', 'employee_attendance_activities.attendance_id', '=', 'daily_attendances.id')
                ->join('users', 'users.id', '=', 'daily_attendances.employee_id')
                ->select('daily_attendances.*', 'users.name')
                ->where('employee_attendance_activities.id', $activity_id) 
                ->first();
        return view('web.employeeAttendance.attendDetails', $data);
    }

    public function approveEmpAttendance(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
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
                "approved_by"        => $user_id
            ]);

            $activityUpdateCheck->update([
                "seen_status"        => 1
            ]);
            DB::commit();   
            return redirect()->route('viewEmpAttendance',$activity_id)->with('message', 'Attendace Status has been Updated');
        }
    }

    //Own Report Search
    public function ownReportSearch()
    {
        return view('web.attendance.searchOwnReport');
    }
    public function ownReportSearchAction(Request $request)
    {
        $input = $request->all();
        $data['employee_id'] = $user_id = Auth::user()->id;
        $data['date_from'] = $date_from = $request->date_from;
        $data['date_to'] = $date_to = $request->date_to;

        $date_from = DateTime::createFromFormat('m/d/Y', $date_from)->format('Y-m-d');
        $date_to = DateTime::createFromFormat('m/d/Y', $date_to)->format('Y-m-d');

        $data['employeeReport'] = DailyAttendances::where('employee_id', '=',  $user_id)
                ->whereBetween('attend_date', [$date_from, $date_to]) 
                ->get();
        $data['employeeDetails'] = User::find($user_id);
        return view('web.attendance.searchOwnReportResult', $data);
    }

    //Report Search for Supervisor
    public function reportSearch()
    {
        $data['employees'] = DailyAttendances::join('users', 'users.id', '=', 'daily_attendances.employee_id')
                ->select('daily_attendances.*', 'users.name')
                ->where('daily_attendances.user_type', 2) 
                ->get();
        return view('web.employeeAttendance.searchReport', $data);
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
        return view('web.employeeAttendance.searchReportResult', $data);
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
