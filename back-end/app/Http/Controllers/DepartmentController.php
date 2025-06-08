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
		$departments = Department::where('is_deleted', 0)
		->latest()
		->get();

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
		$department = Department::findOrfail($id);

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
		$validator = Validator::make($request->all(), [
			'name'   => 'required',
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$department = Department::create([
			'name'     => $request->name
		]);

		if ($department) {
			return response()->json([
				'success' => true,
				'message' => 'Department Created',
				'data'    => $department
			], 201);
		} 

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
		$validator = Validator::make($request->all(), [
			'name'   => 'required',
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$department = Department::findOrFail($department->id);

		if ($department) {
			$department->update([
				'name'     => $request->name,
			]);

			return response()->json([
				'success' => true,
				'message' => 'Department Updated',
				'data'    => $department
			], 200);
		}

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
		$department = Department::findOrfail($id);

		if ($department) {
			// soft delete (not hard delete data from db, just change the is_deleted status)
			$department->update([
				'is_deleted' => true
			]);

			return response()->json([
				'success' => true,
				'message' => 'Department Deleted',
			], 200);
		}

		return response()->json([
			'success' => false,
			'message' => 'Department Not Found',
		], 404);
	}
}