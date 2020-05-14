@extends('web.layout.base.layout.default')

@section('title', trans("Show $serviceEndpoint->name"))

@section('body')

<div class="container-xl" xmlns="http://www.w3.org/1999/html">
    <div class="card">

            <service-endpoint-form
                :action="'{{ $serviceEndpoint->resource_url }}'"
                :data="{{ $serviceEndpoint->toJson() }}"
                v-cloak
                inline-template>
            
                <div class="form-edit">
                    <div class="card-header">
                        <i class="fa fa-eye"></i> Show
                    </div>
                    <div class="card-body">
                        <strong>Implement Show Here</strong>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('savannabits/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                </div>
        </service-endpoint-form>
    </div>
</div>

@endsection
