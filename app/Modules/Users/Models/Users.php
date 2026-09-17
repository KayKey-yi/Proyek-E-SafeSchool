<?php

namespace App\Modules\Users\Models;

use App\Helpers\Format;
use App\Helpers\UsesUuid;
use App\Modules\Role\Models\Role;
use App\Modules\UserRole\Models\UserRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = [
		'deleted_at' => 'datetime',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
		'password' => 'hashed',
	];
	protected $table      = 'users';
	protected $guarded = [];

	protected function createdAt(): Attribute
	{
		return Attribute::make(
			function ($value) {
				return Format::tanggal($value);
			});
	}

	public function initials()
	{
		return Format::inisial($this->name);
	}

	public function roleuser()
	{
		return $this->hasManyThrough(Role::class, UserRole::class, 'id_user', 'id', 'id', 'id_role');
	}
}
