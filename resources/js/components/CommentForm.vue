<template>
<div class="border-b pb-4 mb-8">
    <form class="flex flex-col" @submit.prevent="submitComment">
        <textarea class="border rounded p-3 mb-3" v-model="comment"></textarea>
        <button type="submit" class="border rounded py-2">Commenter</button>
    </form>
         <div class="border rounded p-3" v-for="comment in comments">
            {{comment.content}}
        </div>
</div>
</template>

<script>
    export default {

        props:['dataComments'],

        data(){
            return{
                comment: '',
                comments: this.dataComments,
            }
        },
        methods:{
            submitComment(){
                axios.post('/comments',{
                    content: this.comment
                }).then((result)=>{
                    console.log(result)
                    this.comments.push({
                        content: this.comment
                    })
                    this.comment=""
                })
            }
        }
    }
</script>