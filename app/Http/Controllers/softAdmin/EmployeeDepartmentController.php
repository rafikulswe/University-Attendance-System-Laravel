<?php

namespace App\Http\Controllers\softAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\EmployeeDepartment;

class EmployeeDepartmentController extends Controller
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
        $data['userDepts'] = EmployeeDepartment::where('valid', 1)
            ->get();
        return view('softAdmin.department.userList',$data);
    }

    public function create(){
        return view('softAdmin.department.create');
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'depertment'        => 'required',
            'sort_name'         => 'required'
        ]);

        if ($validator->passes()) {
            EmployeeDepartment::create([
                "depertment"        => $request->depertment,
                "sort_name"         => $request->sort_name
            ]);
            return redirect()->route('admin.createDept')->with('message', 'Department has been created');
        }
    }

    public function edit($id){
        $data['userDept'] = EmployeeDepartment::find($id);
        return view('softAdmin.department.update',$data);
    }

    public function update(Request $request){
        $input = $request->all();
        $id = $request->id;
        $validator = Validator::make($input, [
            'depertment'        => 'required',
            'sort_name'         => 'required'
        ]);
        $updateCheck = EmployeeDepartment::where('id', $id)->where('valid', 1)->first();
        if ($validator->passes()) {
            $updateCheck->update([
                "depertment"        => $request->depertment,
                "sort_name"         => $request->sort_name
            ]);
            return redirect()->route('admin.editDept',$id)->with('message', 'Department has been Updated');
        }
    }
}
