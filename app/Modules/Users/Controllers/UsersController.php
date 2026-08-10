<?php
namespace App\Modules\Users\Controllers;

use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Users\Models\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Users";

	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Users::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Users::users', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'name' => ['label' => 'Name', 'type' => 'text', 'value' => old("name"), 'required' => true],
			'username' => ['label' => 'Username', 'type' => 'text', 'value' => old("username"), 'required' => true],
			'email' => ['label' => 'Email', 'type' => 'text', 'value' => old("email"), 'required' => true],
			'email_verified_at' => ['label' => 'Email Verified At', 'type' => 'text', 'value' => old("email_verified_at"), 'required' => false],
			'password' => ['label' => 'Password', 'type' => 'text', 'value' => old("password"), 'required' => true],
			'identitas' => ['label' => 'Identitas', 'type' => 'text', 'value' => old("identitas"), 'required' => false],
			'remember_token' => ['label' => 'Remember Token', 'type' => 'text', 'value' => old("remember_token"), 'required' => false],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Users::users_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'username' => 'required',
			'email' => 'required',
			'email_verified_at' => 'required',
			'password' => 'required',
			'identitas' => 'required',
			'remember_token' => 'required',
			
		]);

		$users = new Users();
		$users->name = $request->input("name");
		$users->username = $request->input("username");
		$users->email = $request->input("email");
		$users->email_verified_at = $request->input("email_verified_at");
		$users->password = $request->input("password");
		$users->identitas = $request->input("identitas");
		$users->remember_token = $request->input("remember_token");
		
		$users->created_by = Auth::id();
		$users->save();

		$text = 'membuat '.$this->title; //' baru '.$users->what;
		$this->log($request, $text, ['users.id' => $users->id]);
		return redirect()->route('users.index')->with('message_success', 'Users berhasil ditambahkan!');
	}

	public function show(Request $request, Users $users)
	{
		$data['users'] = $users;

		$text = 'melihat detail '.$this->title;//.' '.$users->what;
		$this->log($request, $text, ['users.id' => $users->id]);
		return view('Users::users_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Users $users)
	{
		$data['users'] = $users;

		
		$data['forms'] = array(
			'name' => ['label' => 'Name', 'type' => 'text', 'value' => $users->name, 'required' => true, 'id' => 'name'],
			'username' => ['label' => 'Username', 'type' => 'text', 'value' => $users->username, 'required' => true, 'id' => 'username'],
			'email' => ['label' => 'Email', 'type' => 'text', 'value' => $users->email, 'required' => true, 'id' => 'email'],
			'email_verified_at' => ['label' => 'Email Verified At', 'type' => 'text', 'value' => $users->email_verified_at, 'required' => false, 'id' => 'email_verified_at'],
			'password' => ['label' => 'Password', 'type' => 'text', 'value' => $users->password, 'required' => true, 'id' => 'password'],
			'identitas' => ['label' => 'Identitas', 'type' => 'text', 'value' => $users->identitas, 'required' => false, 'id' => 'identitas'],
			'remember_token' => ['label' => 'Remember Token', 'type' => 'text', 'value' => $users->remember_token, 'required' => false, 'id' => 'remember_token'],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$users->what;
		$this->log($request, $text, ['users.id' => $users->id]);
		return view('Users::users_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'name' => 'required',
			'username' => 'required',
			'email' => 'required',
			'email_verified_at' => 'required',
			'password' => 'required',
			'identitas' => 'required',
			'remember_token' => 'required',
			
		]);

		$users = Users::find($id);
		$users->name = $request->input("name");
		$users->username = $request->input("username");
		$users->email = $request->input("email");
		$users->email_verified_at = $request->input("email_verified_at");
		$users->password = $request->input("password");
		$users->identitas = $request->input("identitas");
		$users->remember_token = $request->input("remember_token");
		
		$users->updated_by = Auth::id();
		$users->save();


		$text = 'mengedit '.$this->title;//.' '.$users->what;
		$this->log($request, $text, ['users.id' => $users->id]);
		return redirect()->route('users.index')->with('message_success', 'Users berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$users = Users::find($id);
		$users->deleted_by = Auth::id();
		$users->save();
		$users->delete();

		$text = 'menghapus '.$this->title;//.' '.$users->what;
		$this->log($request, $text, ['users.id' => $users->id]);
		return back()->with('message_success', 'Users berhasil dihapus!');
	}

}
