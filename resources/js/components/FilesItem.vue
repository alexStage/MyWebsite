<template>
    <div>
        <div v-if="dataFiles.data.length!=0" id="fileButtons" class="btn-group sticky">
            <button class="btn btn-primary" id="menu-toggle">dossiers</button>
            <button class="btn btn-primary" @click="creation = !creation; listImg=[]">Créer un album</button>
            <button class="btn btn-success" data-toggle="modal" data-target="#albumForm" v-if="creation && listImg.length!=0">Publier</button>
        </div>

        <div v-if="creation" id="albumBand" class="bg-blue">
            <div v-for="file in listImg">
                <img class ="imgBand" @click="unSelectImg(file)" height="100" width="100" :src="`${file}`"/>
            </div>
        </div>

        <album-form :data-img="listImg"></album-form>

        <div id="page-content-wrapper" v-if="dataFiles!=null">
            <div class="container-fluid text-center">
                <div class="row">
                        <div class="col-md-4" v-for="file in dataFiles.data">
                            <div class="card mb-4 box-shadow" v-if="creation">
                                <img @click="selectImg(file)" class="card-img-top" :src="`${file}`"/>
                            </div>
                            <div class="card mb-4 box-shadow" v-else>
                                <a :href="`${file}`"><img class="card-img-top" :src="`${file}`"/></a>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <pagination v-if="dataFiles!=null" class="fixed-bottom justify-content-center" :data="dataFiles" :limit="1" :show-disabled="true" @pagination-change-page="getResults">
            <span slot="prev-nav">&lt; Précédent</span>
            <span slot="next-nav">Suivant &gt;</span>
        </pagination>
    </div>
</template>

<script>
import AlbumForm from './AlbumForm.vue'
export default {
    components: {AlbumForm},
    props: ['dataFiles', 'dataPath'],
    data(){
        return{
            creation: false,
            listImg: [],
        }
    },
    methods: {
        getResults(page = 1) {
            var directory = this.dataPath;
            axios.get(`paginations?directory=${directory}&page=${page}`)
                .then(response => {
                    this.$emit('listFiles', response.data.files)
                });
                jQuery('html, body').animate({scrollTop: 0}, 500);
        },
        selectImg(img){
            this.listImg.push(img)
        },
        unSelectImg(img){
            this.listImg.splice(this.listImg.indexOf(img),1)
        }
    }
    
}
</script>