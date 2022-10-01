<template>
<div class="modal fade" id="albumForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Partagez les photos prises durant votre voyage au: {{countrieTitle}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Attention !!! Une fois créé, l'album sera public, choisissez bien les photos que vous publiez.</p>
        <form>
            <div class="form-group">
                <label for="title">Intitulé de l'album</label>
                <input v-model="albumTitle" type="text" class="form-control" id="countrieTitle" placeholder="titre">
            </div>
            <div class="form-group">
                <label for="content">Description de l'album</label>
                <textarea v-model="albumDescription" class="form-control" id="content" placeholder="descriptif"></textarea>
            </div>
            <div class="custom-file">
					    <label class="custom-file-label" for="validatedCustomFile">Sélectionner les photos</label>
					    <input type="file" id="files" ref="files" class="custom-file-input" multiple v-on:change="handleFilesUpload( $event )" />
				    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary" @click.prevent="uploadFiles()" data-dismiss="modal">Créer l'album</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
</template>
<script>
export default {
    props: ['id', 'title', 'voyageID'],
    watch:{
      //modifie les variables quand les props changent
        voyageID: function(newValue){
            this.voyageId = newValue
        },
        id: function(newValue){
            this.countrieID = newValue
        },
        title: function(newValue){
          this.countrieTitle = newValue
        },
    },
    data(){
        return{
            countrieID: '',
            countrieTitle: '',
            content: '',
            albumTitle: '',
            albumDescription: '',
            files: '',
            voyageId: '',
            visitedCountries: []
        }
    },
    methods:{
        handleFilesUpload( event ){
          this.files = event.target.files;
        },
        uploadFiles(){
          let formData = new FormData();
          for( var i = 0; i < this.files.length; i++ ){
            let file = this.files[i];
            formData.append('files[' + i + ']', file);
          }
          formData.append('countrieID', this.countrieID);
          formData.append('countrieTitle', this.countrieTitle);
          formData.append('albumTitle', this.albumTitle);
          formData.append('albumDescription', this.albumDescription);
          formData.append('voyageId', this.voyageId);

          axios.post( '/photos/store',
          formData,
          {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
          }
        ).then((result)=>{
          Array.from(result.data).forEach((pays) => {
            console.log(pays)
            this.visitedCountries.push(pays.identifiant)
          })
          this.$emit('visited-countries', {countries: this.visitedCountries})
        })
        }              

    }
}
</script>