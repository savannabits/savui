import AppForm from '../app-components/Form/AppForm';
export default {
    mixins: [AppForm],
    props: [],
    data: function() {
        return {
            form: {
                name:  '' ,
                guard_name:  '',
                permissions_matrix: []
            },
            assign_all: false,
            toggling : false
        }
    },
    mounted() {
        this.fetchRole();
    },
    methods: {
        fetchRole() {
            let vm = this;
            let ld = vm.$loading.show();
            axios.get(`/api/roles/${vm.form.id}`).then(res => {
                vm.form = {...res.data.payload};
            }).catch(err => {
                vm.$notify({
                    type: "error",
                    title: "API ERROR",
                    text: err?.response?.data?.message || err?.message || err || "Error while fetching the role"
                });
            }).finally(() => {
                ld.hide();
            });
        },
        togglePermission(e, perm, group=null, idx=null) {
            let vm = this;
            vm.toggling = true;
            // let ld = vm.$loading.show();
            axios.post(`/api/roles/${vm.form.id}/permissions/toggle`,{
                permission: perm.name,
                checked: perm.checked
            }).then(res => {
            }).catch(err => {
                perm.checked = !perm.checked
                vm.$notify({
                    type: "error",
                    text: err?.response?.data?.message || err?.message || err || "Update error"
                })
            }).finally(err => {
                // vm.fetchRole();
                vm.toggling= false;
            })
        },
        toggleAllPermissions(e, status=true) {
            // let ld = this.$loading.show();
            this.toggling = true;
            let vm = this;
            axios.post(`/api/roles/${vm.form.id}/permissions/toggle-all`,{
                checked: status
            }).then(res => {
                vm.$notify({
                    title: "SUCCESS",
                    type: "success",
                    text: res.data.message
                });
            }).catch(err => {
                vm.$notify({
                    title: "ERROR",
                    type: "error",
                    text: err?.response?.data?.message || err?.message || err || "Server Error"
                });
                return false;
            }).finally(()=> {
                vm.fetchRole();
                this.toggling = false;
                // ld.hide();
            })
        },
    }
}
