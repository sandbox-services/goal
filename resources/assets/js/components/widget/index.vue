<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <button @click="addWidget"> Add widget</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <widget-list></widget-list>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: [],
        data(){
            return{
            }
        },
        mounted() {
        },
        watch: {

        },
        computed: {

        },
        methods:{
            addWidget(){
                let vm = this

                let data = {

                }

                axios.post('/api/v1/widget/add', data)
                .then( response => {
                    Bus.$emit('widgetWasAdded', response);
                })
                .catch( error => {

                })
            }
        },
        components:{
            'widget-list':                             require('./components/widget-list.vue'),
        }
    }
</script>
