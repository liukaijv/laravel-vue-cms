export default function interceptorsConfig(Vue) {
    Vue.http.interceptors.push({
        request: function (request) {
            

            return request;
        },
        response: function (response) {
           
            return response;
        }
    });
}