export default function authConfig(Vue) {
    Vue.http.interceptors.push({
        request: function (request) {
            var token, headers;

            token = localStorage.getItem('jwt_token');
            headers = request.headers || (request.headers = {});

            if (token !== null && token !== 'undefined') {
                headers.Authorization = token;
            }

            return request;
        },
        response: function (response) {
            if (response.status && response.status.code === 401) {
                localStorage.removeItem('jwt_token');
            }
            if (response.headers && response.headers.Authorization) {
                localStorage.setItem('jwt_token', response.headers.Authorization);
            }
            if (response.entity && response.entity.token && response.entity.token.length > 10) {
                localStorage.setItem('jwt_token', 'Bearer ' + response.entity.token);
            }
            return response;
        }
    });
}