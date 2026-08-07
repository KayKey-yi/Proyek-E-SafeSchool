<?php
namespace App\Modules\Item_reports\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Item_reports\Models\Item_reports;
use App\Modules\Users\Models\Users;
use App\Modules\ReportStatuses\Models\ReportStatuses;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Item_reportsController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Item Reports";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Item_reports::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Item_reports::item_reports', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_users = Users::all()->pluck('name','id');
		$ref_report_statuses = ReportStatuses::all()->pluck('status_name','id');
		
		$data['forms'] = array(
			'user_id' => ['label' => 'User Id', 'type' => 'select', 'value' => old("user_id"), 'required' => true, 'options' => $ref_users->all(), 'class' => 'select2'],
			'status_id' => ['label' => 'Status Id', 'type' => 'select', 'value' => old("status_id"), 'required' => true, 'options' => $ref_report_statuses->all(), 'class' => 'select2'],
			'jenis_laporan' => ['label' => 'Jenis Laporan', 'type' => 'text', 'value' => old("jenis_laporan"), 'required' => true],
			'nama_barang' => ['label' => 'Nama Barang', 'type' => 'text', 'value' => old("nama_barang"), 'required' => true],
			'kategori_barang' => ['label' => 'Kategori Barang', 'type' => 'text', 'value' => old("kategori_barang"), 'required' => false],
			'merek' => ['label' => 'Merek', 'type' => 'text', 'value' => old("merek"), 'required' => false],
			'warna' => ['label' => 'Warna', 'type' => 'text', 'value' => old("warna"), 'required' => false],
			'ciri_ciri' => ['label' => 'Ciri Ciri', 'type' => 'textarea', 'value' => old("ciri_ciri"), 'required' => false],
			'lokasi' => ['label' => 'Lokasi', 'type' => 'text', 'value' => old("lokasi"), 'required' => false],
			'tanggal' => ['label' => 'Tanggal', 'type' => 'text', 'value' => old("tanggal"), 'required' => false, 'class' => 'datepicker'],
			'foto' => ['label' => 'Foto', 'type' => 'text', 'value' => old("foto"), 'required' => false],
			'is_anonymous' => ['label' => 'Is Anonymous', 'type' => 'select', 'value' => old("is_anonymous"), 'required' => true, 'options' => ['1' => 'Ya', '0' => 'Tidak']],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Item_reports::item_reports_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'status_id' => 'required',
			'jenis_laporan' => 'required',
			'nama_barang' => 'required',
			'kategori_barang' => 'required',
			'merek' => 'required',
			'warna' => 'required',
			'ciri_ciri' => 'required',
			'lokasi' => 'required',
			'tanggal' => 'required',
			'foto' => 'required',
			'is_anonymous' => 'required',
			
		]);

		$item_reports = new Item_reports();
		$item_reports->user_id = $request->input("user_id");
		$item_reports->status_id = $request->input("status_id");
		$item_reports->jenis_laporan = $request->input("jenis_laporan");
		$item_reports->nama_barang = $request->input("nama_barang");
		$item_reports->kategori_barang = $request->input("kategori_barang");
		$item_reports->merek = $request->input("merek");
		$item_reports->warna = $request->input("warna");
		$item_reports->ciri_ciri = $request->input("ciri_ciri");
		$item_reports->lokasi = $request->input("lokasi");
		$item_reports->tanggal = $request->input("tanggal");
		$item_reports->foto = $request->input("foto");
		$item_reports->is_anonymous = $request->input("is_anonymous");
		
		$item_reports->created_by = Auth::id();
		$item_reports->save();

		$text = 'membuat '.$this->title; //' baru '.$item_reports->what;
		$this->log($request, $text, ['item_reports.id' => $item_reports->id]);
		return redirect()->route('item_reports.index')->with('message_success', 'Item Reports berhasil ditambahkan!');
	}

	public function show(Request $request, Item_reports $item_reports)
	{
		$data['item_reports'] = $item_reports;

		$text = 'melihat detail '.$this->title;//.' '.$item_reports->what;
		$this->log($request, $text, ['item_reports.id' => $item_reports->id]);
		return view('Item_reports::item_reports_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Item_reports $item_reports)
	{
		$data['item_reports'] = $item_reports;

		$ref_users = Users::all()->pluck('name','id');
		$ref_report_statuses = ReportStatuses::all()->pluck('status_name','id');
		
		$data['forms'] = array(
			'user_id' => ['label' => 'User Id', 'type' => 'select', 'value' => $item_reports->user_id, 'required' => true, 'options' => $ref_users->all(), 'class' => 'select2', 'id' => 'user_id'],
			'status_id' => ['label' => 'Status Id', 'type' => 'select', 'value' => $item_reports->status_id, 'required' => true, 'options' => $ref_report_statuses->all(), 'class' => 'select2', 'id' => 'status_id'],
			'jenis_laporan' => ['label' => 'Jenis Laporan', 'type' => 'text', 'value' => $item_reports->jenis_laporan, 'required' => true, 'id' => 'jenis_laporan'],
			'nama_barang' => ['label' => 'Nama Barang', 'type' => 'text', 'value' => $item_reports->nama_barang, 'required' => true, 'id' => 'nama_barang'],
			'kategori_barang' => ['label' => 'Kategori Barang', 'type' => 'text', 'value' => $item_reports->kategori_barang, 'required' => false, 'id' => 'kategori_barang'],
			'merek' => ['label' => 'Merek', 'type' => 'text', 'value' => $item_reports->merek, 'required' => false, 'id' => 'merek'],
			'warna' => ['label' => 'Warna', 'type' => 'text', 'value' => $item_reports->warna, 'required' => false, 'id' => 'warna'],
			'ciri_ciri' => ['label' => 'Ciri Ciri', 'type' => 'textarea', 'value' => $item_reports->ciri_ciri, 'required' => false, 'id' => 'ciri_ciri'],
			'lokasi' => ['label' => 'Lokasi', 'type' => 'text', 'value' => $item_reports->lokasi, 'required' => false, 'id' => 'lokasi'],
			'tanggal' => ['label' => 'Tanggal', 'type' => 'text', 'value' => $item_reports->tanggal, 'required' => false, 'class' => 'datepicker', 'id' => 'tanggal'],
			'foto' => ['label' => 'Foto', 'type' => 'text', 'value' => $item_reports->foto, 'required' => false, 'id' => 'foto'],
			'is_anonymous' => ['label' => 'Is Anonymous', 'type' => 'select', 'value' => $item_reports->is_anonymous, 'required' => true, 'options' => ['1' => 'Ya', '0' => 'Tidak'], 'id' => 'is_anonymous'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$item_reports->what;
		$this->log($request, $text, ['item_reports.id' => $item_reports->id]);
		return view('Item_reports::item_reports_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'status_id' => 'required',
			'jenis_laporan' => 'required',
			'nama_barang' => 'required',
			'kategori_barang' => 'required',
			'merek' => 'required',
			'warna' => 'required',
			'ciri_ciri' => 'required',
			'lokasi' => 'required',
			'tanggal' => 'required',
			'foto' => 'required',
			'is_anonymous' => 'required',
			
		]);

		$item_reports = Item_reports::find($id);
		$item_reports->user_id = $request->input("user_id");
		$item_reports->status_id = $request->input("status_id");
		$item_reports->jenis_laporan = $request->input("jenis_laporan");
		$item_reports->nama_barang = $request->input("nama_barang");
		$item_reports->kategori_barang = $request->input("kategori_barang");
		$item_reports->merek = $request->input("merek");
		$item_reports->warna = $request->input("warna");
		$item_reports->ciri_ciri = $request->input("ciri_ciri");
		$item_reports->lokasi = $request->input("lokasi");
		$item_reports->tanggal = $request->input("tanggal");
		$item_reports->foto = $request->input("foto");
		$item_reports->is_anonymous = $request->input("is_anonymous");
		
		$item_reports->updated_by = Auth::id();
		$item_reports->save();


		$text = 'mengedit '.$this->title;//.' '.$item_reports->what;
		$this->log($request, $text, ['item_reports.id' => $item_reports->id]);
		return redirect()->route('item_reports.index')->with('message_success', 'Item Reports berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$item_reports = Item_reports::find($id);
		$item_reports->deleted_by = Auth::id();
		$item_reports->save();
		$item_reports->delete();

		$text = 'menghapus '.$this->title;//.' '.$item_reports->what;
		$this->log($request, $text, ['item_reports.id' => $item_reports->id]);
		return back()->with('message_success', 'Item Reports berhasil dihapus!');
	}

}
