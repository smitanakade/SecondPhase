'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var StaffLogin = function () {
    function StaffLogin(params) {
        _classCallCheck(this, StaffLogin);

        this.url = '/webapi/info.php/';
        if (params["url"]) {
            this.url = params.url;
        }

        this.localStorageItem = 'userData';
        if (params["localStorage"]) {
            this.localStorageItem = params.localStorageItem;
        }
        this.isLocalStorage = false;

        this.init();
    }

    _createClass(StaffLogin, [{
        key: 'init',
        value: function init() {

            this.isLocalStorageAvailable();
        }
    }, {
        key: 'checkIfLoggedIn',
        value: function checkIfLoggedIn(callback) {

            var data = this.getLocalStorage();
            if (data) {
                this.login(data.code, callback);
            } else {
                return callback(false);
            }
        }
    }, {
        key: 'login',
        value: function login(code, callback) {

            this.checkCode(code, function (err, data) {
                if (err) {
                    callback(false, err);
                } else {
                    callback(true);
                }
            });
        }
    }, {
        key: 'logout',
        value: function logout() {
            localStorage.removeItem(this.localStorageItem);
        }
    }, {
        key: 'getUserID',
        value: function getUserID() {
            var data = this.getLocalStorage();
            return data.code;
        }
    }, {
        key: 'getLocalStorage',
        value: function getLocalStorage() {
            if (this.isLocalStorage) {
                var data = localStorage.getItem(this.localStorageItem);
                return JSON.parse(data);
            }
            return null;
        }
    }, {
        key: 'setLocalStorage',
        value: function setLocalStorage(data) {

            if (this.isLocalStorage) {
                return localStorage.setItem(this.localStorageItem, data);
            }
            return null;
        }
    }, {
        key: 'checkCode',
        value: function checkCode(code, callback) {
            var _this = this;

            var params = {
                "staffDetails": {
                    "code": code
                }
            };

            this.makeJsonRequest(this.url, params, function (err, object) {

                if (err) return callback(err);

                if (object.data.hasOwnProperty('code')) {
                    _this.setLocalStorage(JSON.stringify(object.data));
                    callback(null, true);
                } else {
                    callback(object.data.errorMessage);
                }
            });
        }
    }, {
        key: 'makeJsonRequest',
        value: function makeJsonRequest(url, params, callback) {

            axios.post(url, params).then(function (response) {
                if (response.data) {
                    callback(null, response);
                } else {
                    callback("No data was recieved");
                }
            }).catch(function (error) {
                callback(error);
            });
        }
    }, {
        key: 'isLocalStorageAvailable',
        value: function isLocalStorageAvailable() {
            if (window.localStorage) {
                this.isLocalStorage = true;
                return true;
            }
            return false;
        }
    }]);

    return StaffLogin;
}();