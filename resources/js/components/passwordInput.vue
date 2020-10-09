<template>
    <div>
        <input :type="show ? 'text' : 'password'">
        <input type="checkbox" v-model="show">
    </div>
</template>

<script>
export default {
    data(){
        return{
            show: false,
        }
    }
}
</script>