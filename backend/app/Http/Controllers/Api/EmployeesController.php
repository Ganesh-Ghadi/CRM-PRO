<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\EmployeeResource;
use App\Http\Controllers\Api\BaseController;

class EmployeesController extends BaseController
{
    /**
     * Display All Employees.
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        $employees = Employee::all();
        return $this->sendResponse(['Users'=> UserResource::collection($users),'Employees'=> EmployeeResource::collection($employees)], "all Employees retrived sucessfully");
    }

    /**
     * Store Employees.
     */
    public function store(Request $request): JsonResponse
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->active = $request->input('active');
        $user->password = Hash::make($request->input('password'));
        $user->save();
         $memberRole = $request->input("role");
         $memberRole = Role::where("name",$memberRole)->first();
       
        $user->assignRole($memberRole);
        
        $employee = new Employee();
        $employee->user_id = $user->id;
        $employee->employee_name = $request->input('employee_name');
        $employee->department_id = $request->input('department_id');
        $employee->email = $request->input('email');
        $employee->mobile = $request->input('mobile');
        $employee->joining_date = $request->input('joining_date');
        $employee->resignation_date = $request->input('resignation_date');
        $employee->save();
       
        return $this->sendResponse(['User'=> new UserResource($user), 'employee'=>new EmployeeResource($employee)], "Employees stored successfully");
    }

    /**
     * Show Employee.
     */
    public function show(string $id): JsonResponse
    {
        $employee = Employee::find($id);

        if(!$employee){
            return $this->sendError("Employee not found", ['error'=>'Employee not found']);
        }
        $user = User::find($employee->user_id);
        return $this->sendResponse(['User'=> new UserResource($user), 'employee'=>new EmployeeResource($employee)], "Employee retrived successfully");
    }

    /**
     * Update Employee.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $employee = Employee::find($id);

        if(!$employee){
            return $this->sendError("Employee not found", ['error'=>'Employee not found']);
        }
        $user = User::find($employee->user_id);
        $user->name = $request->input('employee_name');
        $user->email = $request->input('email');
        $user->active = $request->input('active');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $memberRole = $request->input("role");
        $memberRole = Role::where("name",$memberRole)->first();
        $user->assignRole($memberRole);
                       
        $employee->employee_name = $request->input('employee_name');
        $employee->department_id = $request->input('department_id');
        $employee->email = $request->input('email');
        $employee->mobile = $request->input('mobile');
        $employee->joining_date = $request->input('joining_date');
        $employee->resignation_date = $request->input('resignation_date');
        $employee->save();
       
        return $this->sendResponse(['User'=> new UserResource($user), 'employee'=>new EmployeeResource($employee)], "Employees updated successfully");

    }

    /**
     * Remove Employee.
     */
    public function destroy(string $id): JsonResponse
    {
        $employee = Employee::find($id);
        if(!$employee){
            return $this->sendError("employee not found", ['error'=>'employee not found']);
        }
        $user = User::find($employee->user_id);
        $employee->delete();
        $user->delete();
        return $this->sendResponse([], "employee deleted successfully");
    }
}