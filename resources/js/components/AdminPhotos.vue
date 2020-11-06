<template>
    <div class="container-fluid text-center">
        <div class="bg-blue band">
            <div v-for="photo in photos">
                <img class ="imgBand" @click="selectImg(photo)" height="100" width="100" :src="`${photo.slug}`"/>
            </div>
        </div>
            <div class="row">
                <div class="col border-right justify-content-center">
                    <div v-if="selected!=null" class="card" style="width: 25rem;">
                        <img class="card-img-top" :src="`${selected.slug}`" :alt="`${selected.name}`">
                        <div class="card-body">
                        <p class="card-text">
                            <a href="" @click.prevent="supprEtiquette(etiquette)" v-for="etiquette in selected.etiquettes" class="badge badge-pill badge-info">{{etiquette.name}}</a>
                            <a href="" @click.prevent="supprEtiquette(etiquette)" v-if="listEtiquettes!=[]" v-for="etiquette in listEtiquettes" class="badge badge-pill badge-success">{{etiquette.name}}</a>
                        </p>
                        <a href="#" @click.prevent="etiquetter()" class="btn btn-primary">Étiquetter</a>
                        </div>
                    </div>
                </div>
                <div class="col border-left">
                    <div class="container">
                        <a href="" @click.prevent="addEtiquette(etiquette)" v-for="etiquette in allEtiquettes" :key="etiquette.id" class="badge badge-pill badge-info">{{etiquette.name}}</a>
                    </div>
                    </br>
                    <form class="border-top" @submit.prevent="createEtiquette">
                        <div class="form-group">
                        <label for="newEtiquette">Ajouter une étiquette</label>
                        <input id="newEtiquette" class="form-control" v-model="newEtiquette"></input>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter une etiquette</button>
                    </form>
                </div>
            </div>
            
        </div>
</template>
<script>
export default {
    props: ['DataPhotos', 'DataEtiquettes'],
    data(){
        return{
            photos: this.DataPhotos,
            allEtiquettes: this.DataEtiquettes,
            selected: null,
            listEtiquettes: [],
            newEtiquette: '',
        }
    },
    methods:{
        selectImg(photo){
            this.selected = photo
            this.allEtiquettes = this.DataEtiquettes
            this.listEtiquettes = []
        },
        addEtiquette(etiquette){
            if(this.listEtiquettes.indexOf(etiquette)==-1){
                this.listEtiquettes.push(etiquette)
            }
        },
        supprEtiquette(etiquette){
            this.listEtiquettes.splice(this.listEtiquettes.indexOf(etiquette),1)
        },
        etiquetter(){
            axios.post('/admin/photos/etiquettes',{
                photo: this.selected,
                etiquettes: this.listEtiquettes,
            }).then(
                this.photos.splice(this.photos.indexOf(this.selected),1),
                this.selected = null,
                this.listEtiquettes = []
            )
        },
        createEtiquette(){
            axios.post('/admin/etiquettes',{
                etiquette: this.newEtiquette
            }).then((result)=>{
                this.allEtiquettes.push(result.data)
                this.newEtiquette = ''
            })
        }
    },
}
</script>