<?php

namespace App\Http\Controllers\softAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\EmployeeDepartment;
use App\EmployeeDesignation;

class EmployeeController extends Controller
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
        $data['users'] = User::join('employee_departments', 'employee_departments.id', '=', 'users.depertment_id')
            ->join('employee_designations', 'employee_designations.id', '=', 'users.designation_id')
            ->select('users.*', 'employee_departments.depertment', 'employee_departments.sort_name', 'employee_designations.designation')
            ->where('users.valid', 1)
            ->where('users.is_supervisor', 0)
            ->get();

        return view('softAdmin.employee.userList',$data);
    }

    public function create(){
        $data['supervisor'] = User::where('valid', 1)
            ->where('assign_advisor', 0)
            ->where('is_supervisor', 1)
            ->get();
        $data['userDepts'] = EmployeeDepartment::where('valid', 1)->get();
        $data['userdesignations'] = EmployeeDesignation::where('valid', 1)->get();
        return view('softAdmin.employee.create', $data);
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name'          => 'required',
            'email'         => 'required',
            'depertment_id' => 'required',
            'designation_id'=> 'required',
            'password'      => 'required',
            'assign_advisor'=> 'required'
        ]);

        if ($validator->passes()) {
            User::create([
                "name"          => $request->name,
                "email"         => $request->email,
                "depertment_id" => $request->depertment_id,
                "designation_id"=> $request->designation_id,
                "password"      => Hash::make($request->password),
                "generate_emp_id"=> $request->generate_emp_id,
                "is_supervisor" => 0,
                "is_employee"   => 1,
                "assign_advisor"=> $request->assign_advisor
            ]);
            return redirect()->route('admin.createEmployee')->with('message', 'Employee Account has been created');
        }
    }

    public function edit($id){
        $data['user'] = User::find($id);
        $data['supervisor'] = User::where('valid', 1)
            ->where('assign_advisor', 0)
            ->where('is_supervisor', 1)
            ->get();
        $data['userDepts'] = EmployeeDepartment::where('valid', 1)->get();
        $data['userdesignations'] = EmployeeDesignation::where('valid', 1)->get();
        return view('softAdmin.employee.update',$data);
    }

    public function update(Request $request){
        $input = $request->all();
        $id = $request->id;
        $validator = Validator::make($input, [
            'name'          => 'required',
            'email'         => 'required',
            'depertment_id' => 'required',
            'designation_id'=> 'required',
            'assign_advisor'=> 'required'
        ]);
        $updateCheck = User::where('id', $id)->where('valid', 1)->first();
        if ($validator->passes()) {
            $updateCheck->update([
                "name"          => $request->name,
                "email"         => $request->email,
                "depertment_id" => $request->depertment_id,
                "designation_id"=> $request->designation_id,
                "assign_advisor"=> $request->assign_advisor
            ]);
            return redirect()->route('admin.editEmployee',$id)->with('message', 'Employee Account has been Updated');
        }
    }
}
