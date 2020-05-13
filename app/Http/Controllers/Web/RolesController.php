<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Role\BulkDestroyRole;
use App\Http\Requests\Web\Role\DestroyRole;
use App\Http\Requests\Web\Role\IndexRole;
use App\Http\Requests\Web\Role\StoreRole;
use App\Http\Requests\Web\Role\UpdateRole;
use App\Role;
use Savannabits\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexRole $request
     * @return array|Factory|View
     */
    public function index(IndexRole $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Role::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'guard_name'],

            // set columns to searchIn
            ['id', 'name', 'guard_name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('web.role.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('role.create');

        return view('web.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRole $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreRole $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Role
        $role = Role::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('roles'), 'message' => trans('savannabits/admin-ui::admin.operation.succeeded')];
        }

        return redirect(url('/roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @throws AuthorizationException
     * @return void
     */
    public function show(Role $role)
    {
        $this->authorize('role.show', $role);

        
                return view('web.role.show', [
        'role' => $role,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Role $role)
    {
        $this->authorize('role.edit', $role);


        return view('web.role.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRole $request
     * @param Role $role
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateRole $request, Role $role)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Role
        $role->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('roles'),
                'message' => trans('savannabits/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect(url('/roles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRole $request
     * @param Role $role
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyRole $request, Role $role)
    {
        abort(403, "Deleting is not allowed at the moment");
        $role->delete();

        if ($request->ajax()) {
            return response(['message' => trans('savannabits/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyRole $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyRole $request) : Response
    {
        abort(403, "Bulk Deleting is not allowed at the moment");
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Role::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('savannabits/admin-ui::admin.operation.succeeded')]);
    }
}
