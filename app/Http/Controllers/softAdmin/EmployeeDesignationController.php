<?php

namespace App\Http\Controllers\softAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\EmployeeDesignation;

class EmployeeDesignationController extends Controller
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
        $data['userDesignations'] = EmployeeDesignation::where('valid', 1)
            ->get();
        return view('softAdmin.designation.userList',$data);
    }

    public function create(){
        return view('softAdmin.designation.create');
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'designation'        => 'required'
        ]);

        if ($validator->passes()) {
            EmployeeDesignation::create([
                "designation"        => $request->designation
            ]);
            return redirect()->route('admin.createDesignation')->with('message', 'Designation has been created');
        }
    }

    public function edit($id){
        $data['userDesignation'] = EmployeeDesignation::find($id);
        return view('softAdmin.designation.update',$data);
    }

    public function update(Request $request){
        $input = $request->all();
        $id = $request->id;
        $validator = Validator::make($input, [
            'designation'   => 'required'
        ]);
        $updateCheck = EmployeeDesignation::where('id', $id)->where('valid', 1)->first();
        if ($validator->passes()) {
            $updateCheck->update([
                "designation"  => $request->designation
            ]);
            return redirect()->route('admin.editDesignation',$id)->with('message', 'Designation has been Updated');
        }
    }
}
