import AppForm from '../app-components/Form/AppForm';

export default {
    mixins: [AppForm],
    props: [],
    data: function() {
    return {
    form: {
    @foreach($columns as $column){{ $column['name'].':' }} @if($column['type'] == 'json') {{ 'this.getLocalizedFormDefaults()' }} @elseif($column['type'] == 'boolean') {!! "false" !!} @else {!! "''" !!} @endif,
    @endforeach

    }
    }
    },
    mounted() {

    },
    methods: {

    }
}
