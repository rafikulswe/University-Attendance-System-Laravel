<?php

namespace App\Http\Controllers\softAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\EmployeeDepartment;
use App\EmployeeDesignation;

class SupervisorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data['users'] = User::join('employee_departments', 'employee_departments.id', '=', 'users.depertment_id')
            ->join('employee_designations', 'employee_designations.id', '=', 'users.designation_id')
            ->select('users.*', 'employee_departments.depertment', 'employee_departments.sort_name', 'employee_designations.designation')
            ->where('users.valid', 1)
            ->where('users.assign_advisor', 0)
            ->where('users.is_supervisor', 1)
            ->get();
        return view('softAdmin.supervisor.userList',$data);
    }

    public function create(){
        $data['userDepts'] = EmployeeDepartment::where('valid', 1)->get();
        $data['userdesignations'] = EmployeeDesignation::where('valid', 1)->get();
        return view('softAdmin.supervisor.create',$data);
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'name'          => 'required',
            'email'         => 'required',
            'depertment_id' => 'required',
            'designation_id'=> 'required',
            'password'      => 'required'
        ]);

        if ($validator->passes()) {
            User::create([
                "name"          => $request->name,
                "email"         => $request->email,
                "depertment_id" => $request->depertment_id,
                "designation_id"=> $request->designation_id,
                "password"      => Hash::make($request->password),
                "generate_emp_id"=> $request->generate_emp_id,
                "is_supervisor" => 1,
                "assign_advisor"=> 0
            ]);
            return redirect()->route('admin.createSupervisor')->with('message', 'Supervisor Account has been created');
        }
    }

    public function edit($id){
        $data['user'] = User::find($id);
        $data['userDepts'] = EmployeeDepartment::where('valid', 1)->get();
        $data['userdesignations'] = EmployeeDesignation::where('valid', 1)->get();
        return view('softAdmin.supervisor.update',$data);
    }

    public function update(Request $request){
        $input = $request->all();
        $id = $request->id;
        // dd($id);
        $validator = Validator::make($input, [
            'name'          => 'required',
            'email'         => 'required',
            'depertment_id' => 'required',
            'designation_id'=> 'required'
        ]);
        $updateCheck = User::where('id', $id)->where('valid', 1)->first();
        if ($validator->passes()) {
            $updateCheck->update([
                "name"          => $request->name,
                "email"         => $request->email,
                "depertment_id" => $request->depertment_id,
                "designation_id"=> $request->designation_id
            ]);
            return redirect()->route('admin.editSupervisor',$id)->with('message', 'Supervisor Account has been Updated');
        }
    }

}
