import AppForm from '../app-components/Form/AppForm';

Vue.component('admin-user-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                username:  '' ,
                user_number:  '' ,
                first_name:  '' ,
                last_name:  '' ,
                email:  '' ,
                password:  '' ,
                activated:  false ,
                forbidden:  false ,
                language:  '' ,
                
            }
        }
    }
});