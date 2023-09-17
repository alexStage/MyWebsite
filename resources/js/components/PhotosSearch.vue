<template>
<div class="d-flex" id="wrapper"> 
    <div class="bg-light border-right text-center col-md-2" id="sidebar-wrapper">        
            <div class="sidebar-heading">sélectionner catégories</div>
            <a href="" v-for="etiquette in etiquettes" v-if="selectedEtiquettes.includes(etiquette)" @click.prevent="supprEtiquette(etiquette)" class="badge badge-pill badge-success">{{etiquette.name}}</a>
            <a href="" v-else @click.prevent="addEtiquette(etiquette)" class="badge badge-pill badge-info">{{etiquette.name}}</a>
    </div>
    <div id="michel">
        <button class="btn btn-info sticky float" id="menu-toggle"><span class="navbar-toggler-icon">   
            <i  id="btnIcon" class="fas fa-angle-double-left"></i>
            </span>
        </button>
    </div>
            <div id="page-content-wrapper">
                <div class="container-fluid text-center">
                    <div class="row">
                            <div v-for="photo in photos" class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                <a :href="`${photo.slug}`"><img class="card-img-top" :src="`${photo.slug}`"/></a>
                                <a class="btn btn-sm btn-outline-secondary" target="_self" href="" @click.prevent="supprPhoto(photo)">Supprimer</a>
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
            if(this.selectedEtiquettes.length != 0){
                axios.post('/search/photos',{
                etiquettes: this.listEtiquettes,
            }).then((result)=>{
                this.photos = result.data
            })
            }else{
                this.photos = []
            }
            
        },

        supprPhoto(photo){
            axios.post('/suppr/photos',{
                photos: photo.slug,
            })
        }
    },
}

</script>