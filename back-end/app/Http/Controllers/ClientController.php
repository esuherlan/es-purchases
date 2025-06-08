<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
	/**
	 * index
	 *
	 * @return void
	 */
	public function index()
	{
		$clients = Client::select('clients.*', 'departments.name AS department_name')
								->join('departments', 'departments.id', '=', 'clients.department_id')
								->where('clients.is_deleted', 0)
								->get();

		return response()->json([
			'success' => true,
			'message' => 'List Data Clients',
			'data'    => $clients
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
		$client = Client::select('clients.*', 'departments.name AS department_name')
								->join('departments', 'departments.id', '=', 'clients.department_id')
								->where('clients.id', '=', $id)
								->get();

		return response()->json([
			'success' => true,
			'message' => 'Detail Data Client',
			'data'    => $client
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
			'nik'    			=> 'required',
			'name'   			=> 'required',
			'department_id'   => 'required',
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$client = Client::create([
			'nik'     => $request->nik,
			'name'     => $request->name,
			'department_id'     => $request->department_id
		]);

		if ($client) {
			return response()->json([
				'success' => true,
				'message' => 'Client Created',
				'data'    => $client
			], 201);
		} 

		return response()->json([
			'success' => false,
			'message' => 'Client Failed to Save',
		], 409);
	}
	
	/**
	 * update
	 *
	 * @param  mixed $request
	 * @param  mixed $client
	 * @return void
	 */
	public function update(Request $request, client $client)
	{
		$validator = Validator::make($request->all(), [
			'nik'   				=> 'required',
			'name'   			=> 'required',
			'department_id'   => 'required'
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$client = Client::findOrFail($client->id);

		if ($client) {
			$client->update([
				'nik'     			=> $request->nik,
				'name'     			=> $request->name,
				'department_id'	=> $request->department_id
			]);

			return response()->json([
				'success' => true,
				'message' => 'Client Updated',
				'data'    => $client
			], 200);
		}

		return response()->json([
			'success' => false,
			'message' => 'Client Not Found',
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
		$client = Client::findOrfail($id);

		if ($client) {
			// soft delete (not hard delete data from db, just change the is_deleted status)
			$client->update([
				'is_deleted' => true
			]);

			return response()->json([
				'success' => true,
				'message' => 'Client Deleted',
			], 200);
		}

		return response()->json([
			'success' => false,
			'message' => 'Client Not Found',
		], 404);
	}
}