<template>
<div class="container">
        <h1>liste des utilisateurs</h1>
        <input class="form-control" id="myInput" type="text" placeholder="Rechercher...">
    <table class="table table-hover">
        <thead><tr><th>nom</th><th>email</th><th>admin</th><th>membre de la famille</th></tr></thead>
        <tbody id="myTable">
            <tr v-for="user in users" :key=user.id>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>{{user.admin}}</td>
                <td>{{user.family}}</td>
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
        }
    },
    mounted(){
        this.users = this.dataUsers
        console.log('ca marche !!!madafaka')
    }
}
</script>