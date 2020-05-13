@extends('web.layout.base.layout.default')

@section('title', trans('admin.user.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="card">

            <user-form
                :action="'{{ url('users') }}'"
                :activation="!!'{{ $activation }}'"
                
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action">

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.user.actions.create') }}
                    </div>

                    <div class="card-body">

                        @include('web.user.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('savannabits/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

            </user-form>

        </div>

    </div>

@endsection
