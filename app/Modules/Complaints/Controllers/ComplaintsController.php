<?php
namespace App\Modules\Complaints\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Complaints\Models\Complaints;
use App\Modules\Users\Models\Users;
use App\Modules\report_statuses\Models\report_statuses as ReportStatuses;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintsController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Complaints";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Complaints::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Complaints::complaints', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_users = Users::all()->pluck('name','id');
		$ref_report_statuses = ReportStatuses::all()->pluck('status_name','id');
		
		$data['forms'] = array(
			'user_id' => ['label' => 'User Id', 'type' => 'select', 'value' => old("user_id"), 'required' => true, 'options' => $ref_users->all(), 'class' => 'select2'],
			'status_id' => ['label' => 'Status Id', 'type' => 'select', 'value' => old("status_id"), 'required' => true, 'options' => $ref_report_statuses->all(), 'class' => 'select2'],
			'judul' => ['label' => 'Judul', 'type' => 'text', 'value' => old("judul"), 'required' => true],
			'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'value' => old("deskripsi"), 'required' => true],
			'lokasi' => ['label' => 'Lokasi', 'type' => 'text', 'value' => old("lokasi"), 'required' => false],
			'foto' => ['label' => 'Foto', 'type' => 'text', 'value' => old("foto"), 'required' => false],
			'is_anonymous' => ['label' => 'Is Anonymous', 'type' => 'select', 'value' => old("is_anonymous"), 'required' => true, 'options' => ['1' => 'Ya', '0' => 'Tidak']],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Complaints::complaints_create', array_merge($data, ['title' => $this->title]));
	}

	public function userCreate()
	{
		return view('user.pengaduan.create');
	}

	public function userIndex()
	{
		$reports = Complaints::query()
			->where('user_id', Auth::id())
			->latest('created_at')
			->get();
		$statuses = ReportStatuses::query()
			->whereIn('id', $reports->pluck('status_id'))
			->get()
			->keyBy('id');

		return view('user.pengaduan.index', compact('reports', 'statuses'));
	}

	public function userSuccess()
	{
		return view('user.pengaduan.success');
	}

	public function userStore(Request $request)
	{
		$data = $request->validate([
			'kategori' => ['required', 'string', 'max:150'],
			'lokasi' => ['required', 'string', 'max:100'],
			'waktu' => ['required', 'date'],
			'deskripsi' => ['required', 'string', 'max:500'],
			'bukti' => ['nullable', 'file', 'mimes:png,jpg,jpeg', 'max:5120'],
			'anonim' => ['nullable', 'boolean'],
		]);

		$status = ReportStatuses::query()->first();
		if (! $status) {
			return back()->withInput()->withErrors(['kategori' => 'Status pengaduan belum tersedia.']);
		}

		$complaint = new Complaints();
		$complaint->user_id = Auth::id();
		$complaint->status_id = $status->id;
		$complaint->judul = $data['kategori'];
		$complaint->deskripsi = "Waktu kejadian: {$data['waktu']}\n\n{$data['deskripsi']}";
		$complaint->lokasi = $data['lokasi'];
		$complaint->foto = $request->hasFile('bukti') ? $request->file('bukti')->store('complaints', 'public') : null;
		$complaint->is_anonymous = $request->boolean('anonim');
		$complaint->created_by = Auth::id();
		$complaint->save();

		return redirect()->route('complaints.user.success');
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'status_id' => 'required',
			'judul' => 'required',
			'deskripsi' => 'required',
			'lokasi' => 'required',
			'foto' => 'required',
			'is_anonymous' => 'required',
			
		]);

		$complaints = new Complaints();
		$complaints->user_id = $request->input("user_id");
		$complaints->status_id = $request->input("status_id");
		$complaints->judul = $request->input("judul");
		$complaints->deskripsi = $request->input("deskripsi");
		$complaints->lokasi = $request->input("lokasi");
		$complaints->foto = $request->input("foto");
		$complaints->is_anonymous = $request->input("is_anonymous");
		
		$complaints->created_by = Auth::id();
		$complaints->save();

		$text = 'membuat '.$this->title; //' baru '.$complaints->what;
		$this->log($request, $text, ['complaints.id' => $complaints->id]);
		return redirect()->route('complaints.index')->with('message_success', 'Complaints berhasil ditambahkan!');
	}

	public function show(Request $request, Complaints $complaints)
	{
		$data['complaints'] = $complaints;

		$text = 'melihat detail '.$this->title;//.' '.$complaints->what;
		$this->log($request, $text, ['complaints.id' => $complaints->id]);
		return view('Complaints::complaints_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Complaints $complaints)
	{
		$data['complaints'] = $complaints;

		$ref_users = Users::all()->pluck('name','id');
		$ref_report_statuses = ReportStatuses::all()->pluck('status_name','id');
		
		$data['forms'] = array(
			'user_id' => ['label' => 'User Id', 'type' => 'select', 'value' => $complaints->user_id, 'required' => true, 'options' => $ref_users->all(), 'class' => 'select2', 'id' => 'user_id'],
			'status_id' => ['label' => 'Status Id', 'type' => 'select', 'value' => $complaints->status_id, 'required' => true, 'options' => $ref_report_statuses->all(), 'class' => 'select2', 'id' => 'status_id'],
			'judul' => ['label' => 'Judul', 'type' => 'text', 'value' => $complaints->judul, 'required' => true, 'id' => 'judul'],
			'deskripsi' => ['label' => 'Deskripsi', 'type' => 'textarea', 'value' => $complaints->deskripsi, 'required' => true, 'id' => 'deskripsi'],
			'lokasi' => ['label' => 'Lokasi', 'type' => 'text', 'value' => $complaints->lokasi, 'required' => false, 'id' => 'lokasi'],
			'foto' => ['label' => 'Foto', 'type' => 'text', 'value' => $complaints->foto, 'required' => false, 'id' => 'foto'],
			'is_anonymous' => ['label' => 'Is Anonymous', 'type' => 'select', 'value' => $complaints->is_anonymous, 'required' => true, 'options' => ['1' => 'Ya', '0' => 'Tidak'], 'id' => 'is_anonymous'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$complaints->what;
		$this->log($request, $text, ['complaints.id' => $complaints->id]);
		return view('Complaints::complaints_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'status_id' => 'required',
			'judul' => 'required',
			'deskripsi' => 'required',
			'lokasi' => 'required',
			'foto' => 'required',
			'is_anonymous' => 'required',
			
		]);

		$complaints = Complaints::find($id);
		$complaints->user_id = $request->input("user_id");
		$complaints->status_id = $request->input("status_id");
		$complaints->judul = $request->input("judul");
		$complaints->deskripsi = $request->input("deskripsi");
		$complaints->lokasi = $request->input("lokasi");
		$complaints->foto = $request->input("foto");
		$complaints->is_anonymous = $request->input("is_anonymous");
		
		$complaints->updated_by = Auth::id();
		$complaints->save();


		$text = 'mengedit '.$this->title;//.' '.$complaints->what;
		$this->log($request, $text, ['complaints.id' => $complaints->id]);
		return redirect()->route('complaints.index')->with('message_success', 'Complaints berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$complaints = Complaints::find($id);
		$complaints->deleted_by = Auth::id();
		$complaints->save();
		$complaints->delete();

		$text = 'menghapus '.$this->title;//.' '.$complaints->what;
		$this->log($request, $text, ['complaints.id' => $complaints->id]);
		return back()->with('message_success', 'Complaints berhasil dihapus!');
	}

}
