(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["user-listing"],{

/***/ "./resources/js/web/user/Listing.js":
/*!******************************************!*\
  !*** ./resources/js/web/user/Listing.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _app_components_Listing_AppListing__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../app-components/Listing/AppListing */ "./resources/js/web/app-components/Listing/AppListing.js");

/* harmony default export */ __webpack_exports__["default"] = ({
  mixins: [_app_components_Listing_AppListing__WEBPACK_IMPORTED_MODULE_0__["default"]],
  methods: {
    resendActivation: function resendActivation(url) {
      var _this = this;

      axios.get(url).then(function (response) {
        if (response.data.message) {
          _this.$notify({
            type: 'success',
            title: 'Success',
            text: response.data.message
          });
        } else if (response.data.redirect) {
          window.location.replace(response.data.redirect);
        }
      })["catch"](function (errors) {
        if (errors.response.data.message) {
          _this.$notify({
            type: 'error',
            title: 'Error!',
            text: errors.response.data.message
          });
        }
      });
    }
  },
  props: {
    'activation': {
      type: Boolean,
      required: true
    }
  }
});

/***/ })

}]);