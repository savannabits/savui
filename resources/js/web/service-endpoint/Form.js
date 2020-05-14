import AppForm from '../app-components/Form/AppForm';

export default {
    mixins: [AppForm],
    props: [],
    data: function() {
    return {
    form: {
    name:  '' ,
    endpoint:  '' ,
    description:  '' ,
    enabled:  false ,
    
    }
    }
    },
    mounted() {

    },
    methods: {

    }
}
