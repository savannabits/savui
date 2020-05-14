@extends('web.layout.base.layout.default')

@section('title', trans('admin.role.actions.edit', ['name' => $role->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <role-form
                :action="'{{ $role->resource_url }}'"
                :data="{{ $role->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.role.actions.edit', ['name' => $role->name]) }}
                    </div>

                    <div class="card-body">
                        @include('web.role.components.form-elements')
                        <div class="text-right">
                            <b-button squared type="submit" variant="primary" :disabled="submiting">
                                <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-save'"></i>
                                {{ trans('Update') }}
                            </b-button>
                        </div>
                        <hr>
                        <h4 class="text-center">Permissions</h4>
                        {{--<div class="form-check font-weight-bolder">
                            <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
                                <input class="form-check-input"
                                       id="check-all-perms"
                                       name="check_all_perms"
                                       type="checkbox"
                                       v-model="assign_all">
                                <label class="form-check-label" for="check-all-perms">
                                    Assign All
                                </label>
                            </div>
                        </div>--}}
                        <div class="row mb-2">
                            <b-button @click="toggleAllPermissions($event, true)" variant="success" class="font-weight-bolder" squared><i class="fa fa-check"></i> Assign All</b-button>
                            <b-button @click="toggleAllPermissions($event, false)" variant="danger" squared class="font-weight-bolder ml-2"><i class="fa fa-ban"></i> Revoke All</b-button>
                        </div>
                        <div class="row">
                            <div v-for="(group,key) of form.permissions_matrix" :key="key" class="border col-sm-6 col-md-4">
                                <h4 class="ml-md-auto text-center font-weight-bolder">@{{ key }}</h4>
                                <hr>
                                {{--                                <b-form-checkbox v-for="(permission,idx) of group" class="form-check-input" :key="permission.id" v-model="permission.checked" @change="togglePermission($event,permission)">@{{ permission.display_name }}</b-form-checkbox>--}}
                                <div v-for="(permission,idx) of group" :key="permission.id" class="form-check row">
                                    <div class="" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
                                        <input class="form-check-input"
                                               :id="`perm-${permission.id}-checkbox`"
                                               type="checkbox"
                                               :disabled="toggling"
                                               @change="togglePermission($event,permission)"
                                               v-model="permission.checked">
                                        <label :class="{'text-danger': !permission.checked}" class="form-check-label font-weight-bolder" :for="`perm-${permission.id}-checkbox`">
                                            @{{ permission.display_name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </form>
            </role-form>
        </div>
    </div>
@endsection
