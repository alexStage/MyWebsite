<template>
    <div>Bonjour {{name}}!
    
    <p>
        <input type="text" v-model="name">
        <input type="checkbox" v-model="checkbox">
    </p>

    </div>
    
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

    data(){
        return{
            'name': 'balek',
            'checkbox': true,
        }
    }
    }
</script>
