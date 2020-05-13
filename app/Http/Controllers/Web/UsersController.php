<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\DestroyUser;
use App\Http\Requests\Web\User\IndexUser;
use App\Http\Requests\Web\User\StoreUser;
use App\Http\Requests\Web\User\UpdateUser;
use App\User;
use Spatie\Permission\Models\Role;
use Savannabits\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexUser $request
     * @return array|Factory|View
     */
    public function index(IndexUser $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(User::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'email', 'email_verified_at', 'first_name', 'middle_name', 'last_name', 'dob', 'gender', 'username', 'guid', 'domain'],

            // set columns to searchIn
            ['id', 'name', 'email', 'first_name', 'middle_name', 'last_name', 'dob', 'gender', 'username', 'guid', 'domain']
        );

        if ($request->ajax()) {
            return ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')];
        }

        return view('web.user.index', ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('user.create');

        return view('web.user.create',[
            'activation' => Config::get('admin-auth.activation_enabled'),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUser $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreUser $request)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();

        // Store the User
        $user = User::create($sanitized);

        // But we do have a roles, so we need to attach the roles to the user
        $user->roles()->sync(collect($request->input('roles', []))->map->id->toArray());

        if ($request->ajax()) {
            return ['redirect' => url('users'), 'message' => trans('savannabits/admin-ui::admin.operation.succeeded')];
        }

        return redirect(url('/users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return void
     * @throws AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize('user.show', $user);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('user.edit', $user);

        $user->load('roles');

        return view('web.user.edit', [
            'user' => $user,
            'activation' => Config::get('admin-auth.activation_enabled'),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUser $request
     * @param  User $user
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateUser $request, User $user)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();

        // Update changed values User
        $user->update($sanitized);

        // But we do have a roles, so we need to attach the roles to the user
        if($request->input('roles')) {
            $user->roles()->sync(collect($request->input('roles', []))->map->id->toArray());
        }

        if ($request->ajax()) {
            return ['redirect' => url('users'), 'message' => trans('savannabits/admin-ui::admin.operation.succeeded')];
        }

        return redirect(url('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyUser $request
     * @param  User $user
     * @return ResponseFactory|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(DestroyUser $request, User $user)
    {
        $user->delete();

        if ($request->ajax()) {
            return response(['message' => trans('savannabits/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    }
