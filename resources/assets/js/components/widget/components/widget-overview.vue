<template>
    <div class="w-100">
        <template v-if="widget">
        I'm widget {{ widget.id }} <input v-model="content" type="text"></input> <button @click="saveWidget">Save</button> <button @click="deleteWidget">Delete</button>  <button @click="removeWeight"> Up </button> <button @click="addWeight"> Down </button>
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

            let data = {
                id : this.widget.id,
                weight : this.weight - 1
            };

            axios.post('/api/v1/widget/edit', data)
            .then( response => {
                console.log('widget weight decreased');
                Bus.$emit('widgetWasEdited', response);
            });
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
