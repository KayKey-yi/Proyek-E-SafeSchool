<?php

namespace App\Modules\Pengguna\Models;

use App\Helpers\UsesUuid;
use App\Modules\Role\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = [
		'deleted_at' => 'datetime',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
		'password' => 'hashed',
	];
	protected $table      = 'pengguna';
	protected $fillable   = ['*'];

	public function role(): BelongsTo
	{
		return $this->belongsTo(Role::class, 'role_id');
	}
}
