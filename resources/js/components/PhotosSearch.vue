<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-lg-2 sticky">
                <div class="col-sm">
                    <p>Catégories:</p>
                    <a href="" @click.prevent="addEtiquette(etiquette)" v-for="etiquette in etiquettes" class="badge badge-pill badge-info">{{etiquette.name}}</a>
                </div>
                <div class="col-sm">
                    <p>Catégories sélectionnées:</p>
                    <a href="" @click.prevent="supprEtiquette(etiquette)" v-for="etiquette in selectedEtiquettes" class="badge badge-pill badge-info">{{etiquette.name}}</a>
                </div>
            </div>
            <div class="col">
                <div class="container gallery-container">
                    <div class="tz-gallery">
                        <div class="row">
                            <div v-for="photo in photos" class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                <a class="lightbox" :href="`${photo.slug}`">
                                    <img :src="`${photo.slug}`">
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</template>
<script>
export default {
    props: ['DataEtiquettes'],
    data(){
        return{
            photos: [],
            etiquettes: this.DataEtiquettes,
            //contient les "id" des étiquettes sélectionnées, sert pour les requettes
            listEtiquettes: [],
            //contient les objets "Etiquette" pour l'affichage des etiquettes selectionées
            selectedEtiquettes: [],
        }
    },
    methods:{
        addEtiquette(etiquette){
            if(this.listEtiquettes.indexOf(etiquette)==-1){
                this.listEtiquettes.push(etiquette.id)
                this.selectedEtiquettes.push(etiquette)
            }
            axios.post('/search/photos',{
                etiquettes: this.listEtiquettes,
            }).then((result)=>{
                this.photos = result.data
            })
        },
        supprEtiquette(etiquette){
            this.listEtiquettes.splice(this.listEtiquettes.indexOf(etiquette.id),1)
            this.selectedEtiquettes.splice(this.selectedEtiquettes.indexOf(etiquette),1)
            axios.post('/search/photos',{
                etiquettes: this.listEtiquettes,
            }).then((result)=>{
                this.photos = result.data
            })
        },
    },
}

</script>