<template>
    <section class="home">

        <div class="main-top">

            <!-- URL form -->
            <div class="url-form">
                <select id="method-btn" class="btn" v-model="method">
                    <option value="get">GET</option>
                    <option value="post">POST</option>
                    <option value="put">PUT</option>
                    <option value="delete">DELETE</option>
                </select>
                <input type="text" size="10" id="url-input" v-model="inputURL">
                <button id="send-btn" class="btn" @click="$emit('makeRequest', { inputURL: inputURL, method: method })">SEND</button>                
            </div>
            <!-- /URL form -->

            <!-- Response code -->
            <div class="response-code">
                <h1>{{ results.statusCode}}</h1>
                <span>{{ results.statusText }}</span>
            </div>
            <!-- /Response code -->

        </div>

        <div class="main-bottom" v-if="results.statusCode">
            
            <!-- URL info -->
            <div class="card url-info">
                <span>URL Info</span>
                <div>
                    <span class="label">DOMAIN</span>
                    <span>{{ results.url.domain }}</span>
                </div>
                <div>
                    <span class="label">PROTOCOL</span>
                    <span>{{ results.url.protocol }}</span>  
                </div>
                <div>
                    <span class="label">PATH</span>
                    <span>{{ results.url.path }}</span>
                </div>
            </div>
            <!-- /URL info -->

            <!-- Response info -->
            <div class="card response">
                <span>Response</span>
                <span>
                    <strong>Status:</strong> 
                    {{ `${results.statusCode} ${ results.statusText}` }}</span>
                <span>
                    <strong>Date:</strong> 
                    {{ results.response.headers.date }}</span>
                <span>
                    <strong>Server:</strong> 
                    {{ results.response.headers.server  == undefined ? 'Unknown' : results.response.headers.server }}
                    </span>
            </div>
            <!-- /Response info -->
        </div>

        <!-- Link -->
        <div class="request-link" v-if="results.statusCode">
            <h5>SHARE</h5>
            <a :href="requestID">127.0.0.1:8000/{{ requestID }}</a>
        </div>
        <!-- /Link -->

    </section>
</template>

<script>
export default {
    name: 'PageHome',
    data() {
        return {
            method: 'get',
            inputURL: 'www.google.com'
        }
    },
    props: {
        results: Object,
        requestID: String
    }

}
</script>

<style lang="scss">

</style>