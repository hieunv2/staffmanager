<?php

namespace App\Models;

use App\Models\Traits\SyncOneToMany;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
	use SoftDeletes, EloquentJoin, SyncOneToMany;
	
	/**
	 * Cast the given keys to integers if they are numeric and string otherwise.
	 *
	 * @param  array $keys
	 * @return array
	 */
	protected function castKeys(array $keys)
	{
		return (array)array_map(function ($v) {
			return $this->castKey($v);
		}, $keys);
	}
	
	/**
	 * Cast the given key to an integer if it is numeric.
	 *
	 * @param  mixed $key
	 * @return mixed
	 */
	protected function castKey($key)
	{
		return is_numeric($key) ? (int)$key : (string)$key;
	}
	
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];
	
	protected $hidden = [
		'deleted_at'
	];
}
