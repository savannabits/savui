@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    Dashboard
                </div>

                <div class="w-full p-6">
                    <p class="text-gray-700">
                        You are logged in!
                    </p>
                </div>
            </div>
            <home-component v-cloak inline-template>
                <t-card>
                    <template class="bg-gray-100" v-slot:header>
                        <div class="font-bold">Here we are</div>
                    </template>
                    <div class="p-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias sit perspiciatis laboriosam doloribus, aliquam, porro quasi reiciendis.</div>

                    <div class="p-2">
                        <t-button @click="$refs.modal.show()" variant="primary"  class="mr-0">Create</t-button>
                        <t-modal v-cloak ref="modal" :click-to-close="false" :esc-to-close="false">
                            <p> WE are welcoming you to our party that will be in place x</p>
                            <t-button variant="success" @click="toggleDirections">@{{ show_directions ? 'Hide Directions': 'Show Directions' }}</t-button>
                            <t-alert :show="show_directions" ref="directions" variant="success">
                                Turn right at the grocery store.
                                Proceed to the furthest end of the road
                                Move a few steps to the left.
                                Follow the road that you see ahead.
                                I will be there waitin to receive you.
                            </t-alert>
                        </t-modal>
                    </div>
                    <div class="p-2">
                        <t-alert show variant="danger">Danger! Will, Robinson</t-alert>
                    </div>

                    <t-input-group
                        v-cloak
                        label="Password"
                        feedback="Password must be at least 6 characters long"
                        :status="false"
                    >
                        <t-input
                            v-cloak
                            value="password"
                            type="password"></t-input>
                    </t-input-group>
                </t-card>
            </home-component>
        </div>
    </div>
@endsection
