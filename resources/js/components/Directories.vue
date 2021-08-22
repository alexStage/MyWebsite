<template>
<div class="d-flex" id="wrapper">
    <div class="bg-light border-right text-center" id="sidebar-wrapper">
        <div class="sidebar-heading">dossiers</div>
        <div id="folder-list" class="list-group list-group-flush sticky">
            <button v-if="précédents.length!=1" class="btn bg-blue" @click="getPreviousDirectories(previousDir)">Précédent</button>
            <button v-for="directory in list" class="list-group-item list-group-item-action bg-light" @click="getSubDirectories(directory)">{{directory}}</button>
            
            </br>

            <a target="_blank" class="btn sticky" rel="noreferrer" href="http://owncloud.seatheworld.fr/"
                style="padding:10px;background-color:#1B223D;color:#fff;border-radius:3px;padding-left:4px;">
                    <img src="http://owncloud.seatheworld.fr/core/img/logo-icon.svg" style="width:50px;position:relative;">
                    Ajouter des photos
            </a>

        </div>
        
        
    </div>
    <div id="michel">
        <button class="btn btn-info sticky float" id="menu-toggle"><span class="navbar-toggler-icon">   
            <i  id="btnIcon" class="fas fa-angle-double-left"></i>
            </span>
        </button>
    </div>
    
    <files-item v-bind:data-files="laravelData" v-bind:data-path="path" @listFiles="laravelData = $event"></files-item>
</div>
</template>

<script>
import FilesItem from './FilesItem.vue'
export default {
    components:{ FilesItem },
    props: ['dataDirectories'],
    data(){
        return{
            list: [],
            previousDir: '/',
            currentDir: '/',
            précédents:[""],
            path: '/',
            laravelData: null,
        }
    },
    mounted(){
        axios.get(`/directories`).then((result) => {
            this.laravelData = result.data.files;
            this.list = result.data.directories;
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
            });
            
            if(typeof directory.indexOf("/")!=='undefined'){
                var folders = directory.split("/");
                if(typeof folders[folders.length-1] !== 'undefined'){
                    this.currentDir = folders[folders.length-1];
                }
            }
        }

    }
}

</script>
