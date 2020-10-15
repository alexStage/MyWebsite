<template>
    <div>
        <div class="btn-group justify-content-center sticky display-inline">
            <button class="btn btn-primary" id="menu-toggle">dossiers</button>
            <button class="btn btn-primary" @click="creation = !creation">créer un album</button>
        </div>
        
        <div id="page-content-wrapper" v-if="dataFiles!=null">
            <div class="container-fluid text-center">
                <div class="row">
                        <div class="col-md-4" v-for="file in dataFiles.data">
                            <div v-if="creation" class="card mb-4 box-shadow">
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
import draggable from 'vuedraggable'
export default {
    components: {
            draggable,
        },
    props: ['dataFiles', 'dataPath'],
    data(){
        return{
            creation: false,
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
        }
    },
}
</script>