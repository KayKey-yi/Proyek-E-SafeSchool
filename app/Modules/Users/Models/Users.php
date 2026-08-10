<?php

namespace App\Modules\Users\Models;

use App\Helpers\UsesUuid;
use App\Modules\Role\Models\Role;
use App\Modules\UserRole\Models\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'users';
	protected $fillable   = ['*'];

	public function roleuser()
	{
		return $this->hasManyThrough(Role::class, UserRole::class, 'id_user', 'id', 'id', 'id_role');
	}
}
