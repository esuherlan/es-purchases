<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	use HasFactory;
	/**
	 * filllable
	 *
	 * @var array
	 */
	protected $fillable = [
		'nik', 'name', 'department_id', 'is_deleted'
	];
}
