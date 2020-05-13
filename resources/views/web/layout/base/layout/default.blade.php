@extends('web.layout.base.layout.master')

@section('header')
    @include('web.layout.base.partials.header')
@endsection

@section('content')

    <div class="app-body">

        @if(View::exists('web.layout.sidebar'))
            @include('web.layout.sidebar')
        @endif

        <main class="main">

            <div class="container-fluid" id="app" :class="{'loading': loading}">
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
                @yield('body')
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
