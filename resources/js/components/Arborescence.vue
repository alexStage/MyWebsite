<template>
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">dossiers</div>
            <div id="folder-list" class="list-group list-group-flush sticky" v-for="directory in directories">
                <button class="list-group-item list-group-item-action bg-light" @click="getSubDirectories(directory)">{{directory}}</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            directories: []
        }
    },
    created(){
        axios.get('/directories')
        .then(response => this.directories = response.data);
    },
    methods:{
        getSubDirectories(directory){
            axios.get(`/subDirectories/${directory}`)
            .then(console.log(response => this.directories = response.data));
        }
    }
}
</script>