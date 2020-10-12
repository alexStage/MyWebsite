<template>
<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">dossiers</div>
        <div id="folder-list" class="list-group list-group-flush sticky">
            <button v-if="précédents.length!=1" class="list-group-item list-group-item-action bg-blue" @click="getPreviousDirectories(previousDir)">Précédent</button>
            <button v-for="directory in list" class="list-group-item list-group-item-action bg-light" @click="getSubDirectories(directory)">{{directory}}</button>
        </div>
    </div>
    <button class="btn btn-primary" id="menu-toggle">dossiers</button>
    <div id="page-content-wrapper">
        <div class="container-fluid text-center">
            <div class="row">
                    <div class="col-md-4" v-for="file in laravelData.data">
                        <div class="card mb-4 box-shadow">
                            <a :href="`${file}`"><img class="card-img-top" :src="`${file}`"/></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    <pagination v-if="laravelData!=null" class="fixed-bottom justify-content-center" :data="laravelData" :limit="1" :show-disabled="true" @pagination-change-page="getResults">
        <span slot="prev-nav">&lt; Précédent</span>
        <span slot="next-nav">Suivant &gt;</span>
    </pagination>
</div>
</template>

<script>
export default {
    props: ['dataDirectories', 'dataFiles'],
    data(){
        return{
            list: [],
            previousDir: '/',
            currentDir: '/',
            précédents:[""],
            path: '',
            laravelData: {},
        }
    },
    mounted(){
        axios.get(`/directories`).then((result) => {
            this.laravelData = result.data.files;
            this.list = result.data.directories;
            var last = result.data.files.last_page_url;
        });

    },
    methods:{
        getSubDirectories(directory){
            this.getDirectories(directory);
            this.précédents.push(this.currentDir);
            this.previousDir = this.précédents[this.précédents.length-2];
        },

        getPreviousDirectories(directory){
            this.getDirectories(directory);
            this.précédents.pop();
            this.previousDir = this.précédents[this.précédents.length-2];
        },

        getDirectories(directory){
            this.path = directory;
            if(typeof(directory) == 'undefined'){
                directory = this.dataDirectories[0];
            }
            axios.get(`directories/${directory}`).then((result) => {
                this.previousDirectory = directory;
                this.laravelData = result.data.files;
                this.list = result.data.directories;
                var last = result.data.files.last_page_url;
            });
            
            if(typeof directory.indexOf("/")!=='undefined'){
                var folders = directory.split("/");
                if(typeof folders[folders.length-1] !== 'undefined'){
                    this.currentDir = folders[folders.length-1];
                }
            }
        },
        getResults(page = 1) {
            var directory = this.path;
            axios.get(`paginations?directory=${directory}&page=${page}`)
                .then(response => {
                    this.laravelData = response.data.files;
                });
        }

    }
}
</script>