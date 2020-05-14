(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["role-form"],{

/***/ "./resources/js/web/role/Form.js":
/*!***************************************!*\
  !*** ./resources/js/web/role/Form.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _app_components_Form_AppForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../app-components/Form/AppForm */ "./resources/js/web/app-components/Form/AppForm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }


/* harmony default export */ __webpack_exports__["default"] = ({
  mixins: [_app_components_Form_AppForm__WEBPACK_IMPORTED_MODULE_0__["default"]],
  props: [],
  data: function data() {
    return {
      form: {
        name: '',
        guard_name: '',
        permissions_matrix: []
      },
      assign_all: false,
      toggling: false
    };
  },
  mounted: function mounted() {
    this.fetchRole();
  },
  methods: {
    fetchRole: function fetchRole() {
      var vm = this;
      var ld = vm.$loading.show();
      axios.get("/api/roles/".concat(vm.form.id)).then(function (res) {
        vm.form = _objectSpread({}, res.data.payload);
      })["catch"](function (err) {
        var _err$response, _err$response$data;

        vm.$notify({
          type: "error",
          title: "API ERROR",
          text: (err === null || err === void 0 ? void 0 : (_err$response = err.response) === null || _err$response === void 0 ? void 0 : (_err$response$data = _err$response.data) === null || _err$response$data === void 0 ? void 0 : _err$response$data.message) || (err === null || err === void 0 ? void 0 : err.message) || err || "Error while fetching the role"
        });
      })["finally"](function () {
        ld.hide();
      });
    },
    togglePermission: function togglePermission(e, perm) {
      var group = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
      var idx = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
      var vm = this;
      vm.toggling = true; // let ld = vm.$loading.show();

      axios.post("/api/roles/".concat(vm.form.id, "/permissions/toggle"), {
        permission: perm.name,
        checked: perm.checked
      }).then(function (res) {})["catch"](function (err) {
        var _err$response2, _err$response2$data;

        perm.checked = !perm.checked;
        vm.$notify({
          type: "error",
          text: (err === null || err === void 0 ? void 0 : (_err$response2 = err.response) === null || _err$response2 === void 0 ? void 0 : (_err$response2$data = _err$response2.data) === null || _err$response2$data === void 0 ? void 0 : _err$response2$data.message) || (err === null || err === void 0 ? void 0 : err.message) || err || "Update error"
        });
      })["finally"](function (err) {
        // vm.fetchRole();
        vm.toggling = false;
      });
    },
    toggleAllPermissions: function toggleAllPermissions(e) {
      var _this = this;

      var status = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      // let ld = this.$loading.show();
      this.toggling = true;
      var vm = this;
      axios.post("/api/roles/".concat(vm.form.id, "/permissions/toggle-all"), {
        checked: status
      }).then(function (res) {
        vm.$notify({
          title: "SUCCESS",
          type: "success",
          text: res.data.message
        });
      })["catch"](function (err) {
        var _err$response3, _err$response3$data;

        vm.$notify({
          title: "ERROR",
          type: "error",
          text: (err === null || err === void 0 ? void 0 : (_err$response3 = err.response) === null || _err$response3 === void 0 ? void 0 : (_err$response3$data = _err$response3.data) === null || _err$response3$data === void 0 ? void 0 : _err$response3$data.message) || (err === null || err === void 0 ? void 0 : err.message) || err || "Server Error"
        });
        return false;
      })["finally"](function () {
        vm.fetchRole();
        _this.toggling = false; // ld.hide();
      });
    }
  }
});

/***/ })

}]);