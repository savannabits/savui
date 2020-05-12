@extends('savannabits/admin-ui::admin.layout.default')

@section('title', trans('admin.admin-user.actions.edit_profile'))

@section('body')

    <div class="container-xl">

        <div class="card">

            <profile-edit-profile-form
                :action="'{{ url('admin/profile') }}'"
                :data="{{ $adminUser->toJson() }}"
                
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action">

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.admin-user.actions.edit_profile') }}
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="avatar-upload">
                                    @include('savannabits/admin-ui::admin.includes.avatar-uploader', [
                                        'mediaCollection' => app(\Savannabits\AdminAuth\Models\AdminUser::class)->getMediaCollection('avatar'),
                                        'media' => $adminUser->getThumbs200ForCollection('avatar')
                                    ])
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group row align-items-center" :class="{'has-danger': errors.has('username'), 'has-success': fields.username && fields.username.valid }">
                                    <label for="username" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.admin-user.columns.username') }}</label>
                                    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-7'">
                                        <input type="text" v-model="form.username" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('username'), 'form-control-success': fields.username && fields.username.valid}" id="username" name="username" placeholder="{{ trans('admin.admin-user.columns.username') }}">
                                        <div v-if="errors.has('username')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('username') }}</div>
                                    </div>
                                </div>
                                
                                <div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_number'), 'has-success': fields.user_number && fields.user_number.valid }">
                                    <label for="user_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.admin-user.columns.user_number') }}</label>
                                    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-7'">
                                        <input type="text" v-model="form.user_number" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('user_number'), 'form-control-success': fields.user_number && fields.user_number.valid}" id="user_number" name="user_number" placeholder="{{ trans('admin.admin-user.columns.user_number') }}">
                                        <div v-if="errors.has('user_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_number') }}</div>
                                    </div>
                                </div>
                                
                                <div class="form-group row align-items-center" :class="{'has-danger': errors.has('first_name'), 'has-success': fields.first_name && fields.first_name.valid }">
                                    <label for="first_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.admin-user.columns.first_name') }}</label>
                                    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-7'">
                                        <input type="text" v-model="form.first_name" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('first_name'), 'form-control-success': fields.first_name && fields.first_name.valid}" id="first_name" name="first_name" placeholder="{{ trans('admin.admin-user.columns.first_name') }}">
                                        <div v-if="errors.has('first_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('first_name') }}</div>
                                    </div>
                                </div>
                                
                                <div class="form-group row align-items-center" :class="{'has-danger': errors.has('last_name'), 'has-success': fields.last_name && fields.last_name.valid }">
                                    <label for="last_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.admin-user.columns.last_name') }}</label>
                                    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-7'">
                                        <input type="text" v-model="form.last_name" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('last_name'), 'form-control-success': fields.last_name && fields.last_name.valid}" id="last_name" name="last_name" placeholder="{{ trans('admin.admin-user.columns.last_name') }}">
                                        <div v-if="errors.has('last_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('last_name') }}</div>
                                    </div>
                                </div>
                                
                                <div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
                                    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.admin-user.columns.email') }}</label>
                                    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-7'">
                                        <input type="text" v-model="form.email" v-validate="'required|email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.admin-user.columns.email') }}">
                                        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
                                    </div>
                                </div>
                                
                                <div class="form-group row align-items-center" :class="{'has-danger': errors.has('language'), 'has-success': fields.language && fields.language.valid }">
                                    <label for="language" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.admin-user.columns.language') }}</label>
                                    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-7'">
                                        <multiselect v-model="form.language" placeholder="{{ trans('savannabits/admin-ui::admin.forms.select_an_option') }}" :options="{{ $locales->toJson() }}" open-direction="bottom"></multiselect>
                                        <div v-if="errors.has('language')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('language') }}</div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('savannabits/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

            </profile-edit-profile-form>

        </div>

    </div>

@endsection
