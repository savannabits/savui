import { BaseListing } from 'craftable';
import moment from "moment";
let _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };
export default {
	mixins: [BaseListing],
    data() {
	    return {
	        t: null,
            form: {},
        }

    },
    mounted() {
	    this.t = moment().format('YYYY-MM-DD HH:mm:ss');
	    // console.log(this.now);
	    // console.log("OVerriding datetimePickerConfig");
        this.datetimePickerConfig = {
                ...this.datetimePickerConfig,
                enableTime: true,
                time_24hr: true,
                enableSeconds: true,
                dateFormat: 'Y-m-d H:i:S',
                altInput: false,
                altFormat: 'd.m.Y H:i:S',
                locale: 'en',
                timezone: 'Africa/Nairobi',
                inline: true
        }
    },
    methods: {
	    moment: moment,
        validateState(ref) {
            if (
                this.fields[ref] &&
                (this.fields[ref].dirty || this.fields[ref].validated)
            ) {
                return !this.errors.has(ref);
            }
            return null;
        },
        getPostData: function getPostData() {
            var _this3 = this;

            if (this.mediaCollections) {
                this.mediaCollections.forEach(function (collection, index, arr) {
                    if (_this3.form[collection]) {
                        console.warn("MediaUploader warning: Media input must have a unique name, '" + collection + "' is already defined in regular inputs.");
                    }

                    if (_this3.$refs[collection + '_uploader']) {
                        _this3.form[collection] = _this3.$refs[collection + '_uploader'].getFiles();
                    }
                });
            }
            this.form['wysiwygMedia'] = this.wysiwygMedia;

            return this.form;
        },
        deleteItem: async function deleteItem(url) {
            var _this7 = this;

            return new Promise(function(resolve,reject) {
                _this7.$modal.show('dialog', {
                    title: 'Warning!',
                    text: 'Do you really want to delete this item?',
                    buttons: [{ title: 'No, cancel.' }, {
                        title: '<span class="btn-dialog btn-danger">Yes, delete.<span>',
                        handler: function handler() {
                            _this7.$modal.hide('dialog');
                            axios.delete(url).then(function (response) {
                                _this7.loadData();
                                _this7.$notify({ type: 'success', title: 'Success!', text: response.data.message ? response.data.message : 'Item successfully deleted.' });
                                resolve(true)
                            }, function (error) {
                                _this7.$notify({ type: 'error', title: 'Error!', text: error.response.data.message ? error.response.data.message : 'An error has occured.' });
                                reject();
                            });
                        }
                    }]
                });
            });
        },
        async ajaxSubmit(url, data,method = 'post') {
            let _this4 = this;
            this.form = {...data};
            return this.$validator.validateAll().then(function (result) {
                if (!result) {
                    _this4.$notify({
                        type: 'error',
                        title: 'Validation',
                        text: 'The form contains invalid fields.'
                    });
                    return false;
                }

                _this4.submiting = true;

                return axios.request({
                    method: method,
                    url: url, data: _this4.getPostData()
                }).then(function (response) {
                    return _this4.onSuccess(response.data);
                }).catch(function (errors) {
                    return _this4.onFail(errors.response.data);
                });
            });
        },
        onSuccess: function onSuccess(data) {
            this.submiting = false;
            if (data.redirect) {
                window.location.replace(data.redirect);
            }
        },
        onFail(data) {
            this.submiting = false;
            if (_typeof(data.errors) !== (typeof undefined === 'undefined' ? 'undefined' : _typeof(undefined))) {
                var bag = this.$validator.errors;
                bag.clear();
                Object.keys(data.errors).map(function (key) {
                    var splitted = key.split('.', 2);
                    // we assume that first dot divides column and locale (TODO maybe refactor this and make it more general)
                    if (splitted.length > 1) {
                        bag.add({
                            field: splitted[0] + '_' + splitted[1],
                            msg: data.errors[key][0]
                        });
                    } else {
                        bag.add({
                            field: key,
                            msg: data.errors[key][0]
                        });
                    }
                });
                if (_typeof(data.message) === (typeof undefined === 'undefined' ? 'undefined' : _typeof(undefined))) {
                    this.$notify({
                        type: 'error',
                        title: 'Error!',
                        text: 'The form contains invalid fields.'
                    });
                }
            }
            if (_typeof(data.message) !== (typeof undefined === 'undefined' ? 'undefined' : _typeof(undefined))) {
                this.$notify({
                    type: 'error',
                    title: 'Error!',
                    text: data.message
                });
            }
        },
    }
};
