<template>
    <div>
        <div class="row">
            <div class="col-md-12">


            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <button @click="addWidget"> Add widget</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: [],
        data(){
            return{
                overview: {},
                subscription: {},
                account: {},
                user: {}
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
                    contactId: this.contact.id
                }

                this.axios.post('/api/v1/widget/add', data)
                .then( response => {

                })
                .catch( error => {

                })
            }
        },
        components:{

        }
    }
</script>
