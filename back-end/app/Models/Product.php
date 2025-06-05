<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   use HasFactory;
	
	/**
	 * filllable
	 *
	 * @var array
	 */
	protected $fillable = [
		'serial_number', 'name', 'unit', 'location', 'quantity', 'description', 'is_deleted'
	];
}
