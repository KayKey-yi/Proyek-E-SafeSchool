<?php

namespace App\Modules\Complaints\Models;

use App\Helpers\UsesUuid;
use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Users\Models\Users;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Complaints extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'complaints';
	protected $fillable   = ['*'];

	public function user(): BelongsTo
	{
		return $this->belongsTo(Users::class, 'user_id');
	}

	public function pengguna(): BelongsTo
	{
		return $this->belongsTo(Pengguna::class, 'pengguna_id');
	}
}
