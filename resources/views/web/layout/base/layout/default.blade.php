@extends('web.layout.base.layout.master')

@section('header')
    @include('web.layout.base.partials.header')
@endsection

@section('content')

    <div class="app-body">

        @if(View::exists('web.layout.sidebar') && collect(currentRestaurant())->has('id'))
            @include('web.layout.sidebar')
        @endif

        <main class="main {{collect(currentRestaurant())->has('id') ?: 'ml-auto'}}">

            <div class="container-fluid" id="app" :class="{'loading': loading}">
                {{--Outlet Switcher--}}
                <restaurant-switcher
                    :data="{{collect(['restaurant' => currentRestaurant()])->toJson()}}"
                    :action="'{{ route('api.switch-restaurant') }}'"
                    v-cloak
                    inline-template>
                    <div class="card card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <div v-if="form.restaurant && form.restaurant.id" class="font-weight-bolder text-danger">Restaurant: <span class="text-primary">@{{ form.restaurant.display_name  }}</span></div>
                            <div class="font-weight-bolder text-danger" v-else>No Restaurant Selected</div>
                            <form class="form-horizontal ml-2 form-create"  method="post" @submit.prevent="switchRestaurant" novalidate>
                                <b-button type="button" variant="danger" v-b-modal.select-restaurant><i class="fa fa-exchange"></i> Switch</b-button>
                                <b-modal ok-only ok-title="Submit" id="select-restaurant" @hidden="switchRestaurant">
                                    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('restaurant'), 'has-success': fields.restaurant && fields.restaurant.valid }">
                                        <label for="restaurant" class="col-form-label text-md-right col-md-4">{{ trans('Select Restaurant') }}</label>
                                        <div class="col">
                                            <multiselect :options="{{collect(Auth::user()->restaurants ?? [])->toJson()}}" label="display_name" track-by="id" v-model="form.restaurant" v-validate="'required'" @change="validate($event)" :class="{'form-control-danger': errors.has('restaurant'), 'form-control-success': fields.restaurant && fields.restaurant.valid}" id="restaurant" name="restaurant" placeholder="{{ trans('Restaurant') }}"></multiselect>
                                            <div v-if="errors.has('restaurant')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('restaurant') }}</div>
                                        </div>
                                    </div>
                                </b-modal>
                            </form>
                        </div>
                    </div>
                </restaurant-switcher>
                <div class="modals">
                    <v-dialog/>
                </div>
                <div>
                    <notifications  position="top center">
                        <template slot="body" slot-scope="props">
                            <div class="savbits-notification" :class="{'success' : props.item.type === 'success', 'error': props.item.type==='error','warn': props.item.type==='warn'}">
                                <a class="title">
                                    @{{props.item.title}}
                                </a>
                                <a class="close" @click="props.close">
                                    <i class="fa fa-fw fa-close"></i>
                                </a>
                                <div v-html="props.item.text"></div>
                            </div>
                        </template>
                    </notifications>
                </div>
                @if (\Session::has('error'))
                    <div class="alert alert-danger"> {{\Session::get('error')}}</div>
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-danger"> {{\Session::get('success')}}</div>
                @endif
                @if (\Session::has('warning'))
                    <div class="alert alert-danger"> {{\Session::get('warning')}}</div>
                @endif
                @if (collect(currentRestaurant())->has('id'))
                    @yield('body')
                @endif
            </div>
        </main>
    </div>
@endsection

@section('footer')
    @include('web.layout.base.partials.footer')
@endsection

@section('bottom-scripts')
    @parent
@endsection
