@extends('web.layout.base.layout.default')

@section('title', trans('admin.user.actions.index'))

@section('body')

    <user-listing
        :data="{{ $data->toJson() }}"
        :activation="!!'{{ $activation }}'"
        :url="'{{ url('users') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.user.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('users/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.user.actions.create') }}</a>
                    </div>
                    <div class="card-body" v-cloak>
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
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>

                            </div>
                        </form>

                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th is='sortable' :column="'id'">{{ trans('admin.user.columns.id') }}</th>
                                    <th is='sortable' :column="'name'">{{ trans('admin.user.columns.name') }}</th>
                                    <th is='sortable' :column="'email'">{{ trans('admin.user.columns.email') }}</th>
                                    <th is='sortable' :column="'email_verified_at'">{{ trans('admin.user.columns.email_verified_at') }}</th>
                                    <th is='sortable' :column="'first_name'">{{ trans('admin.user.columns.first_name') }}</th>
                                    <th is='sortable' :column="'middle_name'">{{ trans('admin.user.columns.middle_name') }}</th>
                                    <th is='sortable' :column="'last_name'">{{ trans('admin.user.columns.last_name') }}</th>
                                    <th is='sortable' :column="'dob'">{{ trans('admin.user.columns.dob') }}</th>
                                    <th is='sortable' :column="'gender'">{{ trans('admin.user.columns.gender') }}</th>
                                    <th is='sortable' :column="'username'">{{ trans('admin.user.columns.username') }}</th>
                                    <th is='sortable' :column="'guid'">{{ trans('admin.user.columns.guid') }}</th>
                                    <th is='sortable' :column="'domain'">{{ trans('admin.user.columns.domain') }}</th>
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection">
                                    <td >@{{ item.id }}</td>
                                    <td >@{{ item.name }}</td>
                                    <td >@{{ item.email }}</td>
                                    <td >@{{ item.email_verified_at | datetime }}</td>
                                    <td >@{{ item.first_name }}</td>
                                    <td >@{{ item.middle_name }}</td>
                                    <td >@{{ item.last_name }}</td>
                                    <td >@{{ item.dob }}</td>
                                    <td >@{{ item.gender }}</td>
                                    <td >@{{ item.username }}</td>
                                    <td >@{{ item.guid }}</td>
                                    <td >@{{ item.domain }}</td>
                                    
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning" v-show="!item.activated" @click="resendActivation(item.resource_url + '/resend-activation')" title="Resend activation" role="button"><i class="fa fa-envelope-o"></i></button>
                                            </div>
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('savannabits/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                            </div>
                                            <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('savannabits/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                            </form>
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
                            <a class="btn btn-primary btn-spinner" href="{{ url('users/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('savannabits/admin-ui::admin.btn.new') }} User</a>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </user-listing>

@endsection
