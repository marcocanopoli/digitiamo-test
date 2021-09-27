<template>
    <section class="app">
        <router-view
            @makeRequest="makeRequest"
            :results="results"
            :requestID="requestID">
        </router-view>
    </section>
</template>

<script>

export default {
    name: 'App',
    data() {
        return {
            fullURL : '',
            results: {},
            requestID: ''
        }
    },
    methods: {
        async makeRequest(parameters) {
            this.results = {
                statusCode: '',
                statusText: '',
                errors: '',
                url: {
                    domain: '',
                    protocol: '',
                    path: ''
                },
                request: {},
                response: {},
            }

            const currentURL = new URL(`http://${parameters.inputURL}`);
            let results = this.results;
            this.fullURL = parameters.inputURL;
            const response  = await axios({
                method: parameters.method,
                url: parameters.inputURL
            })                
            .then(res => {
                // console.log(res);
                // console.log(res.headers);
                results.response = res;
                results.request = res.config;
                results.statusCode = res.status;
                results.statusText = res.statusText;                  
            })
            .catch(err => {
                // console.error(err.response);
                // console.log(err.response.headers);
                results.errors = err.response.data.message;
                results.response = err.response;
                results.request = err.response.config;
                results.statusCode = err.response.status;
                results.statusText = err.response.statusText;
            })

            results.url.domain = currentURL.hostname;
            results.url.protocol = currentURL.protocol;
            results.url.path = currentURL.pathname;
            this.saveRequest();

            let newDate = results.response.headers.date;
            results.response.headers.date = this.truncateDate(newDate);
        },
        truncateDate(GMTdate) {
            let date = GMTdate;

            if(GMTdate.includes('GMT')) {
                let index = date.search("GMT") + 5;
                date =  date.slice(index)
            }

            return date;
        },
        saveRequest() {
            axios.post('/api/HTTP/post', {
                statusCode: this.results.statusCode,
                statusText: this.results.statusText,
                errors: this.results.errors,
                url: this.fullURL,
                response: JSON.stringify(this.results.response),
                request: JSON.stringify(this.results.request),
                
            })
            .then(res => {
                this.requestID = res.data.request_id;
            })
            .catch(err => {
                console.log(err);
            })
        }
    }
}
</script>

<style lang="scss">

    .app {
        height: 100%;
        padding: 16px 16px 60px 16px;
    }

</style>