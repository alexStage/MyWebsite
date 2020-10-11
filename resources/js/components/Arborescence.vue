<template>
<div class="d-flex" id="wrapper">
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">dossiers</div>
        <div id="folder-list" class="list-group list-group-flush sticky">
            <button v-if="précédents.length!=1" class="list-group-item list-group-item-action bg-blue" @click="getPreviousDirectories(previousDir)">Précédent</button>
            <button v-for="directory in list" class="list-group-item list-group-item-action bg-light" @click="getSubDirectories(directory)">{{directory}}</button>
        </div>
    </div>
    
    <div id="page-content-wrapper">
        <div class="container-fluid text-center">
            <div class="row">
                    <div class="col-md-4" v-for="file in files">
                        <div class="card mb-4 box-shadow">
                            <a :href="`${file}`"><img class="card-img-top" :src="`${file}`"/></a>
                        </div>
                    </div>
            </div>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center fixed-bottom">
                <button class="btn btn-primary mr-100" id="menu-toggle">dossiers</button>
                <li class="page-item" v-if="currentPage != 1"><a class="page-link" @click.prevent="getPreviousPage()">Précédent</a></li>
                <li class="page-item disabled"><a class="page-link">{{currentPage}}/{{lastPage}}</a></li>
                <li class="page-item" v-if="currentPage != lastPage"><a class="page-link" @click.prevent="getNextPage()">Suivant</a></li>
            </ul>
        </nav>
    </div>
</div>
</template>

<script>
export default {
    props: ['dataDirectories', 'dataFiles'],
    data(){
        return{
            files: [],
            list: [],
            previousDir: '/',
            currentDir: '/',
            précédents:[""],
            nextPage: "2",
            lastPage:null,
            currentPage: 1,
        }
    },
    created(){
        axios.get(`/directories`).then((result) => {
            this.files = result.data.files.data;
            this.list = result.data.directories;
            var last = result.data.files.last_page_url;
            this.lastPage = last.charAt(last.length-1);
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
            if(typeof(directory) == 'undefined'){
                directory = this.dataDirectories[0];
            }
            axios.get(`directories/${directory}`).then((result) => {
                this.previousDirectory = directory;
                this.files = result.data.files.data;
                this.list = result.data.directories;
                var last = result.data.files.last_page_url;
                this.lastPage = last.charAt(last.length-1);
            });
            
            if(typeof directory.indexOf("/")!=='undefined'){
                var folders = directory.split("/");
                if(typeof folders[folders.length-1] !== 'undefined'){
                    this.currentDir = folders[folders.length-1];
                }
            }

            this.currentPage = 1;
        },

        getNextPage(){
            this.files = [];
            var directory = this.currentDir;
            var page = this.currentPage+1;
            console.log(page);
            axios.get(`paginations/${directory}/${page}`).then((result) => {
                this.previousDirectory = directory;
                this.files = result.data.files.data;
                this.list = result.data.directories;
                this.nextPage = result.data.files.next_page_url;
            });
            this.currentPage++;
        },

        getPreviousPage(){
            this.files = [];
            var directory = this.currentDir;
            var page = this.currentPage-1;
            axios.get(`paginations/${directory}/${page}`).then((result) => {
                this.previousDirectory = directory;
                this.files = result.data.files.data;
                this.list = result.data.directories;
                this.nextPage = result.data.files.next_page_url;
            });
            this.currentPage--;
        },

    }
}
</script>