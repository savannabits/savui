<?php

namespace App\Http\Controllers\Web;

use App\Helpers\SavbitsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Permission\BulkDestroyPermission;
use App\Http\Requests\Web\Permission\DestroyPermission;
use App\Http\Requests\Web\Permission\IndexPermission;
use App\Http\Requests\Web\Permission\StorePermission;
use App\Http\Requests\Web\Permission\UpdatePermission;
use App\Permission;
use Strathmore\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PermissionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPermission $request
     * @return array|Factory|View
     */
    public function index(IndexPermission $request)
    {
        // create and AdminListing instance for a specific model and
        $data = SavbitsHelper::listing(Permission::class, $request)->process();

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('web.permission.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('permission.create');

        return view('web.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermission $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePermission $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Permission
        $permission = Permission::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('permissions'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect(url('/permissions'));
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @throws AuthorizationException
     * @return void
     */
    public function show(Permission $permission)
    {
        $this->authorize('permission.show', $permission);


                return view('web.permission.show', [
        'permission' => $permission,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Permission $permission)
    {
        $this->authorize('permission.edit', $permission);


        return view('web.permission.edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermission $request
     * @param Permission $permission
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePermission $request, Permission $permission)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Permission
        $permission->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('permissions'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect(url('/permissions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPermission $request
     * @param Permission $permission
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPermission $request, Permission $permission)
    {
        abort(403, "Deleting is not allowed at the moment");
        $permission->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyPermission $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPermission $request) : Response
    {
        abort(403, "Bulk Deleting is not allowed at the moment");
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Permission::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
