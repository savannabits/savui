import AppForm from '../app-components/Form/AppForm';

Vue.component('permission-form', {
    mixins: [AppForm],
    props: [],
    data: function() {
        return {
            form: {
                name:  '' ,
                guard_name:  '' ,
                
            }
        }
    },
    mounted() {

    },
    methods: {

    }
});
