<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
	/**
	 * index
	 *
	 * @return void
	 */
	public function index()
	{
		//get data from table departments
		$departments = Department::latest()->get();

		//make response JSON
		return response()->json([
			'success' => true,
			'message' => 'List Data Departments',
			'data'    => $departments
		], 200);
	}
	
	/**
	 * show
	 *
	 * @param  mixed $id
	 * @return void
	 */
	public function show($id)
	{
		//find department by ID
		$department = Department::findOrfail($id);

		//make response JSON
		return response()->json([
			'success' => true,
			'message' => 'Detail Data Department',
			'data'    => $department
		], 200);
	}
	
	/**
	 * store
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function store(Request $request)
	{
		//set validation
		$validator = Validator::make($request->all(), [
			'name'   => 'required',
		]);
		
		//response error validation
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		//save to database
		$department = Department::create([
			'name'     => $request->name
		]);

		//success save to database
		if($department) {
			return response()->json([
				'success' => true,
				'message' => 'Department Created',
				'data'    => $department
			], 201);
		} 

		//failed save to database
		return response()->json([
			'success' => false,
			'message' => 'Department Failed to Save',
		], 409);
	}
	
	/**
	 * update
	 *
	 * @param  mixed $request
	 * @param  mixed $department
	 * @return void
	 */
	public function update(Request $request, Department $department)
	{
		//set validation
		$validator = Validator::make($request->all(), [
			'name'   => 'required',
		]);
		
		//response error validation
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		//find department by ID
		$department = Department::findOrFail($department->id);

		if ($department) {
			//update department
			$department->update([
				'name'     => $request->name,
			]);

			return response()->json([
				'success' => true,
				'message' => 'Department Updated',
				'data'    => $department
			], 200);
		}

		//data department not found
		return response()->json([
			'success' => false,
			'message' => 'Department Not Found',
		], 404);
	}
	
	/**
	 * destroy
	 *
	 * @param  mixed $id
	 * @return void
	 */
	public function destroy($id)
	{
		//find department by ID
		$department = Department::findOrfail($id);

		if($department) {
			//delete department
			$department->delete();

			return response()->json([
				'success' => true,
				'message' => 'Department Deleted',
			], 200);
		}

		//data department not found
		return response()->json([
			'success' => false,
			'message' => 'Department Not Found',
		], 404);
	}
}