<template>
<div class="modal fade" id="albumForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Créer un nouvel album</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Attention !!! Une fois créé, l'album sera public, choisissez bien les photos que vous publiez.</p>
        <form @submit.prevent="createAlbum()">
            <div class="form-group">
                <label for="title">Intitulé de l'album</label>
                <input v-model="title" type="text" class="form-control" id="title" placeholder="titre">
            </div>
            <div class="form-group">
                <label for="content">Description de l'album</label>
                <textarea v-model="content" class="form-control" id="content" placeholder="descriptif"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer l'album</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
</template>
<script>
export default {
    props: ['DataImg'],
    data(){
        return{
            title: '',
            content: ''
        }
    },
    methods:{
        createAlbum(){
            axios.post('/albums/publish',{
                title: this.title,
                content: this.content,
                img: this.DataImg
            }).then(window.location.href ='http://127.0.0.1:8000/'+'?refresh')
        }              

    }
}
</script>