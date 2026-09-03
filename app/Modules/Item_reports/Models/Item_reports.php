<?php

namespace App\Modules\Item_reports\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Users\Models\Users;
use App\Modules\report_statuses\Models\report_statuses as ReportStatuses;


class Item_reports extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'item_reports';
	protected $fillable   = ['*'];

	public function user()
	{
		return $this->belongsTo(Users::class, 'user_id');
	}

	public function status()
	{
		return $this->belongsTo(ReportStatuses::class, 'status_id');
	}

	
}
