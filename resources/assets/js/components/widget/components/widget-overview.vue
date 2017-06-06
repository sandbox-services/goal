<template>
    <div class="w-100">
        <template v-if="widget">
            <div class="input-group input-group-lg">
                <span class="input-group-addon" id="basic-addon1">Widget ID: {{ widget.id }}</span>
                <input v-model="content" type="text" class="form-control" placeholder="">
                <span class="input-group-btn">
                    <button @click="saveWidget" class="btn btn-default"><i class="material-icons">save</i></button>
                    <button @click="deleteWidget" class="btn btn-default"><i class="material-icons">cancel</i></button>
                    <button @click="removeWeight" type="button" class="btn btn-default"><i class="material-icons">arrow_upward</i></button>
                    <button @click="addWeight" type="button" class="btn btn-default"><i class="material-icons">arrow_downward</i></button>

                </span>
            </div>





        </template>
    </div>
</template>
<script>
export default{
    name: 'widget-overview',
    props: ['widget'],

    data(){
        return {
            content : this.widget.content,
            weight : this.widget.weight
        }
    },
    created() {

    },
    mounted() {

    },
    watch: {

    },
    computed: {

    },
    methods: {
        addWeight() {
            let vm = this

            let data = {
                id : this.widget.id,
                weight : this.weight + 1
            };

            axios.post('/api/v1/widget/edit', data)
            .then( response => {
                console.log('widget weight increased');
                Bus.$emit('widgetWasEdited', response);
            });
        },
        removeWeight() {
            let vm = this
            if(this.weight >= 1) {
                let data = {
                    id : this.widget.id,
                    weight : this.weight - 1
                };

                axios.post('/api/v1/widget/edit', data)
                .then( response => {
                    console.log('widget weight decreased');
                    Bus.$emit('widgetWasEdited', response);
                });
            } else {
                console.log('item is already  at minimum allowed weight');
            }
        },
        saveWidget() {
            console.log('Saving widget');
            let vm = this

            let data = {
                id : this.widget.id,
                content : this.content,
                weight : this.weight
            };

            axios.post('/api/v1/widget/edit', data)
            .then( response => {
                console.log('widget saved');
            });
        },
        deleteWidget() {
            console.log('Deleting widget');

            let data = {
                id : this.widget.id
            };

            axios.post('/api/v1/widget/delete', data)
            .then( response => {
                Bus.$emit('widgetWasDeleted', response);
            });
        },
    },
    components:{
    }
}
</script>
