const LOGIN_URL = 'login';
const LOGOUT_URL = 'logout';

export default {

    user: null,

    authenticated: false,

    login(context, creds) {

        return new Promise(function (resolve, reject) {
            let error_result = {flag: false, msg: "登陆失败"};
            context.$http.post(LOGIN_URL, creds).then((result) => {
                let data = result.data;
                if (data.flag === true && data.jwt_token) {
                    localStorage.setItem('jwt_token', data.jwt_token);
                    localStorage.setItem('jwt_user', JSON.stringify(data.data));
                    this.authenticated = true;
                    this.user = data.data;
                    resolve(result);
                } else {
                    reject(error_result);
                }

            }, (error) => {
                reject(error_result);
            });

        }.bind(this));

    },

    logout(context) {

        return new Promise(function (resolve, reject) {

            context.$http.post(LOGOUT_URL).then((result)=> {
                let data = result.data;
                if (data.flag === true) {
                    localStorage.removeItem('jwt_token');
                    localStorage.removeItem('jwt_user');
                    this.authenticated = false;
                    this.user = null;
                    resolve();
                } else {
                    reject();
                }
            }, (error)=> {
                reject(error);
            });

        }.bind(this));

    },

    checkAuth() {
        let jwt = localStorage.getItem('jwt_token');
        if (jwt) {
            this.authenticated = true;
        } else {
            this.authenticated = false;
        }
    },

    getToken() {
        return localStorage.getItem('jwt_token');
    }
};
