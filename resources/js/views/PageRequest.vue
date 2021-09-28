<template>
    <section class="show" v-if="!loading">

        <div class="main-top">

            <!-- URL form -->
            <div class="url-form">
                <span class="btn">{{ this.request.method }}</span>
                <input type="text" size="10" id="url-input" :value="foundRequest.url">                         
            </div>
            <!-- /URL form -->

            <!-- Response code -->
            <div class="response-code">
                <h1>{{ foundRequest.status_code }}</h1>
                <span>{{ foundRequest.status_text }}</span>
            </div>
            <!-- /Response code -->

        </div>

        <div class="main-bottom">
            
            <!-- URL info -->
            <div class="card url-info">
                <span>URL Info</span>
                <div>
                    <span class="label">DOMAIN</span>
                    <span>{{ requestURL.hostname }}</span>
                </div>
                <div>
                    <span class="label">PROTOCOL</span>
                    <span>{{ requestURL.protocol }}</span>  
                </div>
                <div>
                    <span class="label">PATH</span>
                    <span>{{ requestURL.pathname }}</span>
                </div>
            </div>
            <!-- /URL info -->

            <!-- Response info -->
            <div class="card response">
                <span>Response</span>
                <span>
                    <strong>Status:</strong> 
                    {{ `${foundRequest.status_code} ${ foundRequest.status_text}` }}</span>
                <span>
                    <strong>Date:</strong> 
                    {{ truncateDate(response.headers.date) }}</span>
                <span>
                    <strong>Server:</strong> 
                    {{ response.headers.server  == undefined ? 'Unknown' : response.headers.server }}
                    </span>
            </div>
            <!-- /Response info -->
        </div>

        <!-- Link -->
        <div class="request-link">
            <h5>SHARE</h5>
            <a href="">127.0.0.1:8000/{{ foundRequest.request_id }}</a>
        </div>
        <!-- /Link -->

    </section>
</template>

<script>
export default {
    name: 'PageRequest',
    data() {
        return {
            foundRequest: '',
            request: '',
            response: '',
            requestURL: '',
            loading: true
        }
    },
    methods: {
        getFromURL() {
            this.loading = true;

            axios.get(`api/HTTP/get/`, {
                params: {
                    request_id: this.$route.params.request_id
                }
            })
            .then (res => {
                this.foundRequest = res.data;
                this.request = JSON.parse(this.foundRequest.request);
                this.response = JSON.parse(this.foundRequest.response);
                this.requestURL = new URL(`http://${this.foundRequest.url}`);
                this.loading = false;
            })
            .catch(err => {
                console.error(err);
                this.loading = false;
                this.$router.push({ name: 'home'})
            })
        },
        truncateDate(GMTdate) {
            let date = GMTdate;

            if(GMTdate.includes('GMT')) {
                let index = date.search("GMT") + 5;
                date =  date.slice(index)
            }

            return date;
        },
    },
    created() {
        this.getFromURL();       
    }

}
</script>

<style lang="scss">

</style>