<?php
namespace App\Modules\Pengguna\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Role\Models\Role;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Pengguna";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Pengguna::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Pengguna::pengguna', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_role = Role::all()->pluck('role','id');
		
		$data['forms'] = array(
			'role_id' => ['label' => 'Role Id', 'type' => 'select', 'value' => old("role_id"), 'required' => true, 'options' => $ref_role->all(), 'class' => 'select2'],
			'foto_profil' => ['label' => 'Foto Profil', 'type' => 'text', 'value' => old("foto_profil"), 'required' => false],
			'nama' => ['label' => 'Nama', 'type' => 'text', 'value' => old("nama"), 'required' => true],
			'email' => ['label' => 'Email', 'type' => 'text', 'value' => old("email"), 'required' => true],
			'password' => ['label' => 'Password', 'type' => 'text', 'value' => old("password"), 'required' => true],
			'nisn' => ['label' => 'Nisn', 'type' => 'number', 'value' => old("nisn"), 'required' => true],
			'nis' => ['label' => 'Nis', 'type' => 'number', 'value' => old("nis"), 'required' => true],
			'jenis_kelamin' => ['label' => 'Jenis Kelamin', 'type' => 'text', 'value' => old("jenis_kelamin"), 'required' => false],
			'kelas' => ['label' => 'Kelas', 'type' => 'text', 'value' => old("kelas"), 'required' => false],
			'no_hp' => ['label' => 'No Hp', 'type' => 'text', 'value' => old("no_hp"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Pengguna::pengguna_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'role_id' => 'required',
			'foto_profil' => 'required',
			'nama' => 'required',
			'email' => 'required',
			'password' => 'required',
			'nisn' => 'required',
			'nis' => 'required',
			'jenis_kelamin' => 'required',
			'kelas' => 'required',
			'no_hp' => 'required',
			
		]);

		$pengguna = new Pengguna();
		$pengguna->role_id = $request->input("role_id");
		$pengguna->foto_profil = $request->input("foto_profil");
		$pengguna->nama = $request->input("nama");
		$pengguna->email = $request->input("email");
		$pengguna->password = $request->input("password");
		$pengguna->nisn = $request->input("nisn");
		$pengguna->nis = $request->input("nis");
		$pengguna->jenis_kelamin = $request->input("jenis_kelamin");
		$pengguna->kelas = $request->input("kelas");
		$pengguna->no_hp = $request->input("no_hp");
		
		$pengguna->created_by = Auth::id();
		$pengguna->save();

		$text = 'membuat '.$this->title; //' baru '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return redirect()->route('pengguna.index')->with('message_success', 'Pengguna berhasil ditambahkan!');
	}

	public function show(Request $request, Pengguna $pengguna)
	{
		$data['pengguna'] = $pengguna;

		$text = 'melihat detail '.$this->title;//.' '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return view('Pengguna::pengguna_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Pengguna $pengguna)
	{
		$data['pengguna'] = $pengguna;

		$ref_role = Role::all()->pluck('role','id');
		
		$data['forms'] = array(
			'role_id' => ['label' => 'Role Id', 'type' => 'select', 'value' => $pengguna->role_id, 'required' => true, 'options' => $ref_role->all(), 'class' => 'select2', 'id' => 'role_id'],
			'foto_profil' => ['label' => 'Foto Profil', 'type' => 'text', 'value' => $pengguna->foto_profil, 'required' => false, 'id' => 'foto_profil'],
			'nama' => ['label' => 'Nama', 'type' => 'text', 'value' => $pengguna->nama, 'required' => true, 'id' => 'nama'],
			'email' => ['label' => 'Email', 'type' => 'text', 'value' => $pengguna->email, 'required' => true, 'id' => 'email'],
			'password' => ['label' => 'Password', 'type' => 'text', 'value' => $pengguna->password, 'required' => true, 'id' => 'password'],
			'nisn' => ['label' => 'Nisn', 'type' => 'number', 'value' => $pengguna->nisn, 'required' => true, 'id' => 'nisn'],
			'nis' => ['label' => 'Nis', 'type' => 'number', 'value' => $pengguna->nis, 'required' => true, 'id' => 'nis'],
			'jenis_kelamin' => ['label' => 'Jenis Kelamin', 'type' => 'text', 'value' => $pengguna->jenis_kelamin, 'required' => false, 'id' => 'jenis_kelamin'],
			'kelas' => ['label' => 'Kelas', 'type' => 'text', 'value' => $pengguna->kelas, 'required' => false, 'id' => 'kelas'],
			'no_hp' => ['label' => 'No Hp', 'type' => 'text', 'value' => $pengguna->no_hp, 'required' => true, 'id' => 'no_hp'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return view('Pengguna::pengguna_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'role_id' => 'required',
			'foto_profil' => 'required',
			'nama' => 'required',
			'email' => 'required',
			'password' => 'required',
			'nisn' => 'required',
			'nis' => 'required',
			'jenis_kelamin' => 'required',
			'kelas' => 'required',
			'no_hp' => 'required',
			
		]);

		$pengguna = Pengguna::find($id);
		$pengguna->role_id = $request->input("role_id");
		$pengguna->foto_profil = $request->input("foto_profil");
		$pengguna->nama = $request->input("nama");
		$pengguna->email = $request->input("email");
		$pengguna->password = $request->input("password");
		$pengguna->nisn = $request->input("nisn");
		$pengguna->nis = $request->input("nis");
		$pengguna->jenis_kelamin = $request->input("jenis_kelamin");
		$pengguna->kelas = $request->input("kelas");
		$pengguna->no_hp = $request->input("no_hp");
		
		$pengguna->updated_by = Auth::id();
		$pengguna->save();


		$text = 'mengedit '.$this->title;//.' '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return redirect()->route('pengguna.index')->with('message_success', 'Pengguna berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$pengguna = Pengguna::find($id);
		$pengguna->deleted_by = Auth::id();
		$pengguna->save();
		$pengguna->delete();

		$text = 'menghapus '.$this->title;//.' '.$pengguna->what;
		$this->log($request, $text, ['pengguna.id' => $pengguna->id]);
		return back()->with('message_success', 'Pengguna berhasil dihapus!');
	}

}
