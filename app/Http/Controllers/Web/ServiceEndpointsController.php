<?php

namespace App\Http\Controllers\Web;

use App\Helpers\SavbitsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ServiceEndpoint\BulkDestroyServiceEndpoint;
use App\Http\Requests\Web\ServiceEndpoint\DestroyServiceEndpoint;
use App\Http\Requests\Web\ServiceEndpoint\IndexServiceEndpoint;
use App\Http\Requests\Web\ServiceEndpoint\StoreServiceEndpoint;
use App\Http\Requests\Web\ServiceEndpoint\UpdateServiceEndpoint;
use App\ServiceEndpoint;
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

class ServiceEndpointsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexServiceEndpoint $request
     * @return array|Factory|View
     */
    public function index(IndexServiceEndpoint $request)
    {
        // create and AdminListing instance for a specific model and
        $data = SavbitsHelper::listing(ServiceEndpoint::class, $request)->customQuery(function($q) {
            //TODO: Insert your query modification here
        })->process();

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('web.service-endpoint.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('service-endpoint.create');

        return view('web.service-endpoint.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreServiceEndpoint $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreServiceEndpoint $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ServiceEndpoint
        $serviceEndpoint = new ServiceEndpoint($sanitized);
        $serviceEndpoint->saveOrFail();
        if ($request->ajax()) {
            return ['redirect' => url('service-endpoints'), 'message' => trans('savannabits/admin-ui::admin.operation.succeeded')];
        }

        return redirect(url('/service-endpoints'));
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceEndpoint $serviceEndpoint
     * @throws AuthorizationException
     * @return void
     */
    public function show(ServiceEndpoint $serviceEndpoint)
    {
        $this->authorize('service-endpoint.show', $serviceEndpoint);


        return view('web.service-endpoint.show', [
        'serviceEndpoint' => $serviceEndpoint,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ServiceEndpoint $serviceEndpoint
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ServiceEndpoint $serviceEndpoint)
    {
        $this->authorize('service-endpoint.edit', $serviceEndpoint);


        return view('web.service-endpoint.edit', [
            'serviceEndpoint' => $serviceEndpoint,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateServiceEndpoint $request
     * @param ServiceEndpoint $serviceEndpoint
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateServiceEndpoint $request, ServiceEndpoint $serviceEndpoint)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ServiceEndpoint
        $serviceEndpoint->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('service-endpoints'),
                'message' => trans('savannabits/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect(url('/service-endpoints'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyServiceEndpoint $request
     * @param ServiceEndpoint $serviceEndpoint
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyServiceEndpoint $request, ServiceEndpoint $serviceEndpoint)
    {
        abort(403, "Deleting is not allowed at the moment");
        $serviceEndpoint->delete();

        if ($request->ajax()) {
            return response(['message' => trans('savannabits/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyServiceEndpoint $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyServiceEndpoint $request) : Response
    {
        abort(403, "Bulk Deleting is not allowed at the moment");
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ServiceEndpoint::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('savannabits/admin-ui::admin.operation.succeeded')]);
    }
}
