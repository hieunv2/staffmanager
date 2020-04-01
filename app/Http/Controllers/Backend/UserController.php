<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\ApiResourceController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Hashing\HashManager;
use Request;
use \Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserController extends ApiResourceController
{

	protected function setModel()
	{
		$this->model = new User;
	}

	/**
	 * @param UserStoreRequest $request
	 * @return mixed
	 */
	public function store(UserStoreRequest $request)
	{
		$data = $request->only($this->model->getFillable());

		$model = $this->query->create($data);
		$role = $request->get('role');
		$model->syncRoles([$role]);
		return $this->resultResponse($model);
	}

	/**
	 * @param UserUpdateRequest $request
	 * @param $id
	 * @return mixed
	 */
	public function update(UserUpdateRequest $request, $id)
	{
		$user = User::findOrFail($id);
		$role = optional($request->role)['name'];

		$user->syncRoles([$role]);

		return parent::_update($request, $id);
	}

	protected $hasher;

	/**
	 * Create a new repository instance.
	 *
	 * @param  \Illuminate\Hashing\HashManager $hasher
	 * @return void
	 */
	public function __construct(HashManager $hasher)
	{
		parent::__construct();
		$this->hasher = $hasher->driver();
	}
	
	public function login(LoginRequest $request)
	{
		$credentials = array_values($request->only('username', 'password'));
		
		if (!$user = $this->attempt(...$credentials)) {
			return response()->json(['errors' => ['username' => trans('error.wrongInfo')]], 422);
		}
		$token = $user->createToken('Access Token')->accessToken;
		$roles = $user->getRoleNames();
		return compact('user', 'token', 'roles');
	}
	
	/**
	 * @param string $user
	 * @param string $password
	 * @return User|null
	 */
	public function attempt(string $user, string $password): ?User
	{
		if (!$admin = User::where('email', $user)->orWhere('username', $user)->first()) {
			return null;
		}
		if (!$this->hasher->check($password, $admin->getAuthPassword())) {
			return null;
		}
		$admin->load('roles');
		return $admin;
	}

	public function info()
	{
		$info = Auth::user();
		$roles = $info->getRoleNames();
		return compact('info', 'roles');
	}

	public function logout()
	{
		if (Auth::check()) {
			Auth::user()->token()->revoke();
		}
		return response()->json(null, 204);
	}

	public function updateProfile(Request $request)
	{
		$rules = [
			'name' => 'required',
			'email' => 'required|email|',
		];

		$this->validate($request, $rules);

		$user = $request->user();
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->save();

		return response()->json(compact('user'));
	}

	public function updatePassword(Request $request)
	{
		$rules = [
			'new_password' => 'required',
			'confirm_new_password' => 'required|same:new_password'
		];

		$this->validate($request, $rules);

		$user = $request->user();
		$user->password = bcrypt($request->input('new_password'));
		$user->saveOrFail();

		return response()->json(compact('user'));
	}

	// add attribute in list api
	public function addFilter()
	{
	}

	// add attribute in details api
	public function addAppend() {
	}

	public function getAllRole(Request $request)
	{
		$user = \Auth::user();
		$roleLevel = 0;
		if ($user && $user->role) {
			$roleLevel = $user->role->level;
		};
		$roles = Role::where('level', '<=', $roleLevel)->get();
		return response()->json($roles);
	}

	public function profile()
	{
		$profile = Auth::user();
		return response()->json($profile);
	}
}
