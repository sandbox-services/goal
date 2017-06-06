<template>
    <div>
        <div v-if="widgets.length > 0" class="list-group">
            <div v-for="widget in widgets" class="list-group-item list-group-item-action flex-column align-items-start p-0">
                <widget-overview v-if="widgets" :widget="widget"></widget-overview>
            </div>
        </div>
        <div v-else class="list-group">
            <div class="list-group-item list-group-item-action flex-column align-items-start p-0">
                No widgets found. Please add a widget to continue.
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: [],
        data(){
            return{
                widgets: []
            }
        },
        created() {
            let vm = this;

            Bus.$on('widgetWasAdded', function (widget) {
                console.log('A new widget was added:');
                vm.fetchWidgets();
            })

            Bus.$on('widgetWasEdited', function (widget) {
                console.log('A widget was edited');
                vm.fetchWidgets();
            })

           Bus.$on('widgetWasDeleted', function (widget) {
                console.log('A widget was deleted');
                vm.fetchWidgets();
            })
        },
        mounted() {
            this.fetchWidgets();
        },
        watch: {

        },
        computed: {

        },
        methods:{
            fetchWidgets() {
                console.log('fetching widgets');
                let vm = this

                let data = {};

                axios.post('/api/v1/widgets', data)
                .then( response => {
                    if(response.data.widgets.length > 0)
                    {
                        this.widgets = []
                        this.$nextTick(function () {
                            this.widgets.push.apply(this.widgets, response.data.widgets)
                        })

                        console.log('fetch completed')
                    }
                    else
                    {
                        this.widgets = []
                        console.log('fetch completed but empty results.')
                    }
                });
            },
        },
        components:{
            'widget-overview':                             require('./widget-overview.vue'),
        }
    }
</script>
