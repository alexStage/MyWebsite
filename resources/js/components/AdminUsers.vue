<template>
<div class="container">
        
        <p>bite bite bite</p>
</div>
</template>
<script>
export default {
    props: ['dataUsers'],
    data(){
        return{
            users: [],
            name: '',
            email: '',
            family: false,
            admin: false,
            id: null
        }
    },
    mounted(){
        this.users = this.dataUsers
    },
    methods:{
        selectUser(id){
            axios.get(`/admin/getUser/${id}`)
            .then((result)=>{
                this.id = result.data.id
                this.name = result.data.name
                this.email = result.data.email
                this.family = result.data.family   
                this.admin = result.data.admin 
            });
        },
        submitUser(){
            axios.get(`/admin/updateUser/${this.id}/${this.name}/${this.email}/${this.family}/${this.admin}`)
            .then(
                window.location.href ='http://seatheworld.fr/'+'?refresh'
            )

            
        }
    }
}
</script>