<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
	/**
	 * index
	 *
	 * @return void
	 */
	public function index()
	{
		$products = Product::where('is_deleted', 0)
							->latest()
							->get();

		return response()->json([
			'success' => true,
			'message' => 'List Data Products',
			'data'    => $products
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
		$product = Product::findOrfail($id);

		return response()->json([
			'success' => true,
			'message' => 'Detail Data Product',
			'data'    => $product
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
			'serial_number'   => 'required',
			'name'   			=> 'required',
			'unit'   			=> 'required',
			'location'			=> 'required',
			'stock'				=> 'required',
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$product = Product::create([
			'serial_number'	=> $request->serial_number,
			'name'     			=> $request->name,
			'unit'     			=> $request->unit,
			'location'     	=> $request->location,
			'stock'     		=> $request->stock,
			'description'     => $request->description,
		]);

		if ($product) {
			return response()->json([
				'success' => true,
				'message' => 'Product Created',
				'data'    => $product
			], 201);
		} 

		return response()->json([
			'success' => false,
			'message' => 'Product Failed to Save',
		], 409);
	}
	
	/**
	 * update
	 *
	 * @param  mixed $request
	 * @param  mixed $product
	 * @return void
	 */
	public function update(Request $request, product $product)
	{
		$validator = Validator::make($request->all(), [
			'serial_number'   => 'required',
			'name'   			=> 'required',
			'unit'   			=> 'required',
			'location'			=> 'required',
			'stock'				=> 'required',
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$product = Product::findOrFail($product->id);

		if ($product) {
			$product->update([
				'serial_number'	=> $request->serial_number,
				'name'     			=> $request->name,
				'unit'     			=> $request->unit,
				'location'     	=> $request->location,
				'stock'     		=> $request->stock,
				'description'     => $request->description,
			]);

			return response()->json([
				'success' => true,
				'message' => 'Product Updated',
				'data'    => $product
			], 200);
		}

		return response()->json([
			'success' => false,
			'message' => 'Product Not Found',
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
		$product = Product::findOrfail($id);

		if ($product) {
			// soft delete (not hard delete data from db, just change the is_deleted status)
			$product->update([
				'is_deleted' => true
			]);

			return response()->json([
				'success' => true,
				'message' => 'Product Deleted',
			], 200);
		}

		return response()->json([
			'success' => false,
			'message' => 'Product Not Found',
		], 404);
	}
}