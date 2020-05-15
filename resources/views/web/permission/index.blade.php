@extends('web.layout.base.layout.default')

@section('title', trans('admin.permission.actions.index'))

@section('body')

    <permission-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('permissions') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.permission.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('permissions/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.permission.actions.create') }}</a>
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block table-responsive">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="{{ trans('savannabits/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('savannabits/admin-ui::admin.btn.search') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">

                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr>
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th>

                                        <th is='sortable' :column="'id'">{{ trans('admin.permission.columns.id') }}</th>
                                        <th is='sortable' :column="'name'">{{ trans('admin.permission.columns.name') }}</th>
                                        <th is='sortable' :column="'guard_name'">{{ trans('admin.permission.columns.guard_name') }}</th>
                                        <th is='sortable' :column="'group'">{{ trans('Perm Group') }}</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td>

                                        <td>@{{ item.id }}</td>
                                        <td>@{{ item.name }}</td>
                                        <td>@{{ item.guard_name }}</td>
                                        <td>@{{ item.group }}</td>

                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
{{--                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('savannabits/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>--}}
                                                </div>
                                                {{--<form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('savannabits/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>--}}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('savannabits/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('savannabits/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('savannabits/admin-ui::admin.index.try_changing_items') }}</p>
                                <a class="btn btn-primary btn-spinner" href="{{ url('permissions/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.permission.actions.create') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </permission-listing>

@endsection
