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
		//get data from table clients
		$clients = Client::latest()->get();

		//make response JSON
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
		//find client by ID
		$client = Client::findOrfail($id);

		//make response JSON
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
		//set validation
		$validator = Validator::make($request->all(), [
			'nik'    			=> 'required',
			'name'   			=> 'required',
			'department_id'   => 'required',
		]);
		
		//response error validation
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		//save to database
		$client = Client::create([
			'nik'     => $request->nik,
			'name'     => $request->name,
			'department_id'     => $request->department_id
		]);

		//success save to database
		if($client) {
			return response()->json([
				'success' => true,
				'message' => 'Client Created',
				'data'    => $client
			], 201);
		} 

		//failed save to database
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
		//set validation
		$validator = Validator::make($request->all(), [
			'nik'   				=> 'required',
			'name'   			=> 'required',
			'department_id'   => 'required'
		]);
		
		//response error validation
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		//find client by ID
		$client = Client::findOrFail($client->id);

		if ($client) {
			//update client
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

		//data client not found
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
		//find client by ID
		$client = Client::findOrfail($id);

		if($client) {
			//delete client
			$client->delete();

			return response()->json([
				'success' => true,
				'message' => 'Client Deleted',
			], 200);
		}

		//data client not found
		return response()->json([
			'success' => false,
			'message' => 'Client Not Found',
		], 404);
	}
}