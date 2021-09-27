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
    name: 'VHome',
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

    @import '../../sass/front/_variables.scss';
    @import '../../sass/front/_mixins.scss';

    .home {
        height: 100%;

        .main-top {
            display: flex;
            flex-direction: column;
            padding-bottom: 30px;
            height: 50%;

            .response-code {
                @include flex-center;
                flex-direction: column;
                height: 100%;
            }

            .url-form {
                display: flex;
                padding: 8px;
                background-color: $gray-200;
                border-radius: 8px;
                
                #url-input {
                    flex-grow: 1;
                    margin: 0px 8px;
                }

                #send-btn {
                    color: $white;
                    background-color: $blue;
                }
            }
        }

        .main-bottom {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 15px;
            
            .card {
                padding: 8px;
                border-radius: 8px;
                background-color: $gray-100;
                border: 1px solid $gray-200;

                & > div {
                    position: relative;
                    padding: 8px 8px 8px 8px;
                    margin-bottom: 2px;

                    .label {
                        position: absolute;
                        top: 4px;
                        left: 4px;
                        font-size: 12px;
                    }

                    & > span {
                        display: block;
                    }
                }                

                & > span {
                    display: block;
                    margin-bottom: 16px;
                }

                &.url-info {
                    background-color: $gray-300;

                    & > div {
                        background-color: $gray-400;
                        padding-top: 24px;
                    }
                }
            }

        }

        .request-link {
            margin: 30px 0;
            text-align: center;
        }
    }

    @media screen and (min-width: 576px) {
        .home {
            width: 80%;
            margin: 0 auto;

            .main-bottom {                
                grid-template-columns: repeat(2, 1fr);

            }
        }
    }

    @media screen and (min-width: 768px) {
        .home {
            width: 60%;

            .main-top {
                flex-direction: column-reverse;
            }
        }
    }

    @media screen and (min-width: 992px) {
        .home {
            width: 60%;

            .main-bottom {
                grid-template-columns: repeat(3, 1fr);

            }
        }
    }


</style>