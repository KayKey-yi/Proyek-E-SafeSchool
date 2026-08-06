<?php
namespace App\Modules\Roles\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Roles\Models\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Roles";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Roles::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Roles::roles', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'role_name' => ['label' => 'Role Name', 'type' => 'text', 'value' => old("role_name"), 'required' => true],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Roles::roles_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'role_name' => 'required',
			
		]);

		$roles = new Roles();
		$roles->role_name = $request->input("role_name");
		
		$roles->created_by = Auth::id();
		$roles->save();

		$text = 'membuat '.$this->title; //' baru '.$roles->what;
		$this->log($request, $text, ['roles.id' => $roles->id]);
		return redirect()->route('roles.index')->with('message_success', 'Roles berhasil ditambahkan!');
	}

	public function show(Request $request, Roles $roles)
	{
		$data['roles'] = $roles;

		$text = 'melihat detail '.$this->title;//.' '.$roles->what;
		$this->log($request, $text, ['roles.id' => $roles->id]);
		return view('Roles::roles_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Roles $roles)
	{
		$data['roles'] = $roles;

		
		$data['forms'] = array(
			'role_name' => ['label' => 'Role Name', 'type' => 'text', 'value' => $roles->role_name, 'required' => true, 'id' => 'role_name'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$roles->what;
		$this->log($request, $text, ['roles.id' => $roles->id]);
		return view('Roles::roles_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'role_name' => 'required',
			
		]);

		$roles = Roles::find($id);
		$roles->role_name = $request->input("role_name");
		
		$roles->updated_by = Auth::id();
		$roles->save();


		$text = 'mengedit '.$this->title;//.' '.$roles->what;
		$this->log($request, $text, ['roles.id' => $roles->id]);
		return redirect()->route('roles.index')->with('message_success', 'Roles berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$roles = Roles::find($id);
		$roles->deleted_by = Auth::id();
		$roles->save();
		$roles->delete();

		$text = 'menghapus '.$this->title;//.' '.$roles->what;
		$this->log($request, $text, ['roles.id' => $roles->id]);
		return back()->with('message_success', 'Roles berhasil dihapus!');
	}

}
