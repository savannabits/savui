@extends('web.layout.base.layout.default')

@section('title', trans('admin.service-endpoint.actions.edit', ['name' => $serviceEndpoint->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <service-endpoint-form
                :action="'{{ $serviceEndpoint->resource_url }}'"
                :data="{{ $serviceEndpoint->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.service-endpoint.actions.edit', ['name' => $serviceEndpoint->name]) }}
                    </div>

                    <div class="card-body">
                        @include('web.service-endpoint.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('savannabits/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </service-endpoint-form>

        </div>
    
</div>

@endsection
