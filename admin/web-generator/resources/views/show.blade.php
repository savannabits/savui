{{'@'}}extends('web.layout.base.layout.default')

{{'@'}}section('title', trans("Show ${{ $modelVariableName }}->{{$modelTitle}}"))

{{'@'}}section('body')

<div class="container-xl" xmlns="http://www.w3.org/1999/html">
    <div class="card">

            @if($hasTranslatable)<{{ $modelJSName }}-form
                :action="'{{'{{'}} ${{ $modelVariableName }}->resource_url }}'"
                :data="{{'{{'}} ${{ $modelVariableName }}->toJsonAllLocales() }}"
                :locales="@{{ json_encode($locales) }}"
                :send-empty-locales="false"
                v-cloak
                inline-template>
            @else<{{ $modelJSName }}-form
                :action="'{{'{{'}} ${{ $modelVariableName }}->resource_url }}'"
                :data="{{'{{'}} ${{ $modelVariableName }}->toJson() }}"
                v-cloak
                inline-template>
            @endif

                <div class="form-edit">
                    <div class="card-header">
                        <i class="fa fa-eye"></i> {{ 'Show' }}
                    </div>
                    <div class="card-body">
                        <strong>Implement Show Here</strong>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            @{{ trans('savannabits/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                </div>
        </{{ $modelJSName }}-form>
    </div>
</div>

{{'@'}}endsection
