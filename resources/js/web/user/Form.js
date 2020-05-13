import AppForm from '../app-components/Form/AppForm';
export default {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                email:  '' ,
                email_verified_at:  '' ,
                password:  '' ,
                first_name:  '' ,
                middle_name:  '' ,
                last_name:  '' ,
                dob:  '' ,
                gender:  '' ,
                username:  '' ,
                guid:  '' ,
                domain:  '' ,

            }
        }
    }
}
