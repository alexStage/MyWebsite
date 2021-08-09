<template>
<div class="container">
        
        <form id="userForm" @submit.prevent="submitUser()"/>
        <table class="table text-center">
        <thead><tr><th>nom</th><th>email</th><th>admin</th><th>membre de la famille</th></tr></thead>
        <tbody>
            <tr>
            <td><input type="text" id="name" v-model="name"></td>
            <td><input type="text" id="email" v-model="email"></td>
            <td><input type="checkbox" id="admin" name="admin" form="userForm" v-model="admin"></td>
            <td><input type="checkbox" id="family" name="family" form="userForm" v-model="family"></td>
            <td><button type="submit" class="btn btn-primary" form="userForm">Modifier</button></td>
            <td><button class="btn btn-primary" @click.prevent="deleteUser()">Supprimer</button></td>
            </tr>
        </tbody>
        </table>
        <h1>liste des utilisateurs</h1>
        <input class="form-control" id="myInput" type="text" placeholder="Rechercher...">
    <table class="table table-hover text-center">
        <thead><tr><th>nom</th><th>email</th><th>admin</th><th>membre de la famille</th></tr></thead>
        <tbody id="myTable">
            <tr class="table-row" v-for="user in users" :key=user.id @click.prevent="selectUser(user.id)">
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td v-if="user.admin==1"><input disabled="disabled" type="checkbox" id="admin" name="admin" checked ></td>
                <td v-if="user.admin!=1"><input disabled="disabled" type="checkbox" id="admin" name="admin"></td>
                <td v-if="user.family==1"><input disabled="disabled" type="checkbox" id="family" name="family"  checked></td>
                <td v-if="user.family!=1"><input disabled="disabled" type="checkbox" id="family" name="family"></td>
            </tr>
        </tbody>
    </table>
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
            .catch(error => {
                console.log('Error: ', error)
            }).then(
                window.location.href ='http://seatheworld.fr/admin/users/'+'?refresh'
            )

            
        },
        deleteUser(){
            axios.get(`/admin/deleteUser/${this.id}`)
            .catch(error => {
                console.log('Error: ', error)
            }).then(
                window.location.href ='http://seatheworld.fr/admin/users/'+'?refresh'
            )

            
        }
    }
}
</script>