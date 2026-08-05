<?php
namespace App\Modules\report_statuses\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\report_statuses\Models\report_statuses;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class report_statusesController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Report Statuses";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = report_statuses::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('report_statuses::report_statuses', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'status_name' => ['label' => 'Status Name', 'type' => 'text', 'value' => old("status_name"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('report_statuses::report_statuses_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'status_name' => 'required',
			
		]);

		$report_statuses = new report_statuses();
		$report_statuses->status_name = $request->input("status_name");
		
		$report_statuses->created_by = Auth::id();
		$report_statuses->save();

		$text = 'membuat '.$this->title; //' baru '.$report_statuses->what;
		$this->log($request, $text, ['report_statuses.id' => $report_statuses->id]);
		return redirect()->route('report_statuses.index')->with('message_success', 'Report Statuses berhasil ditambahkan!');
	}

	public function show(Request $request, report_statuses $report_statuses)
	{
		$data['report_statuses'] = $report_statuses;

		$text = 'melihat detail '.$this->title;//.' '.$report_statuses->what;
		$this->log($request, $text, ['report_statuses.id' => $report_statuses->id]);
		return view('report_statuses::report_statuses_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, report_statuses $report_statuses)
	{
		$data['report_statuses'] = $report_statuses;

		
		$data['forms'] = array(
			'status_name' => ['label' => 'Status Name', 'type' => 'text', 'value' => $report_statuses->status_name, 'required' => true, 'id' => 'status_name'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$report_statuses->what;
		$this->log($request, $text, ['report_statuses.id' => $report_statuses->id]);
		return view('report_statuses::report_statuses_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'status_name' => 'required',
			
		]);

		$report_statuses = report_statuses::find($id);
		$report_statuses->status_name = $request->input("status_name");
		
		$report_statuses->updated_by = Auth::id();
		$report_statuses->save();


		$text = 'mengedit '.$this->title;//.' '.$report_statuses->what;
		$this->log($request, $text, ['report_statuses.id' => $report_statuses->id]);
		return redirect()->route('report_statuses.index')->with('message_success', 'Report Statuses berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$report_statuses = report_statuses::find($id);
		$report_statuses->deleted_by = Auth::id();
		$report_statuses->save();
		$report_statuses->delete();

		$text = 'menghapus '.$this->title;//.' '.$report_statuses->what;
		$this->log($request, $text, ['report_statuses.id' => $report_statuses->id]);
		return back()->with('message_success', 'Report Statuses berhasil dihapus!');
	}

}
