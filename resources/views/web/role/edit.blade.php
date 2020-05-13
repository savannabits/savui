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
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('savannabits/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </role-form>

        </div>
    
</div>

@endsection
