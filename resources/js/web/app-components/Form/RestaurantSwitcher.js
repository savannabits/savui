import AppForm from './AppForm';

Vue.component('restaurant-switcher', {
    mixins: [AppForm],
    props: [],
    data: function() {
        return {
            form: {
                restaurant: null
            },
            restaurant: null,
            restaurants: null
        }
    },
    mounted() {
        this.restaurant = this.form.restaurant;
    },
    methods: {
        backupRestaurant() {
            this.restaurant = {...this.form.restaurant};
        },
        restoreRestaurant() {
            this.form.restaurant = {...this.restaurant};
        },
        switchRestaurant() {
            if (!this.form.restaurant) {
                this.$notify({
                    type: "error",
                    text: "No Outlet Selected"
                });
                this.restoreRestaurant();
                return false;
            }
            this.submitting = true;
            axios.put(`/api/switch-restaurant`, this.form).then ( res => {
                this.form.restaurant = res.data.payload;
                this.restaurant = res.data.payload;
                this.$notify({
                    type: "success",
                    title: "Success",
                    text: res.data.message
                });
            }).catch(err => {
                this.restoreRestaurant();
                this.$notify({
                    type: "error",
                    text: err.response ? err.response.data.message || err : (err.message || err)
                });
            }).finally(() => {
                this.submitting = false;
                window.location.reload(true)
            })
        }
    }
});
