<?php

namespace App\Http\Controllers\System;

use App\Http\Requests\System\CreateUserRequest;
use App\Http\Requests\System\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Repositories\System\UserRepository;
use Spatie\Permission\Models\Role;
use Flash;
use DB;
use Response;
use Hash;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;

        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->orderBy('created_at', 'DESC')->paginate(30);
        return view('system.users.index')
            ->with('users', $users);
    }


    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $userRole = [];
        return view('system.users.create')->with(compact('roles','userRole'));;
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = $this->userRepository->create($input);

        $user->assignRole($request->input('roles'));

        Flash::success('Usuário cadastrado com sucesso.');

        return redirect(route('users.index'));
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $roles = Role::pluck('name','name')->all();
        $user = $this->userRepository->find($id);
        $userRole = $user->roles->pluck('name','name')->all();

        if (empty($user)) {
            Flash::error('Usuário não encontrado');
            return redirect(route('users.index'));
        }
        return view('system.users.edit')->with(compact('user','roles','userRole'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuário não encontrado');

            return redirect(route('users.index'));
        }

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        $user = $this->userRepository->updateById($id, $input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        Flash::success('Usuário atualizado com sucesso.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuário não encontrado');

            return redirect(route('users.index'));
        }

        $this->userRepository->deleteById($id);

        Flash::success('Usuário excluído com sucesso.');

        return redirect(route('users.index'));
    }
}
