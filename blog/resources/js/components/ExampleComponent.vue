<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <h2>Article form</h2>
                <div class="card" style="margin:10px;">
                    <div class="card-header">
                        Title: 
                        <input v-model='title' type="text" placeholder="title">
                    </div>

                    <div class="card-body" style='padding:10px;'>
                        Text: <input v-model='text' type="text" placeholder="text">
                        <br>
                        Author:
                        <select name="" id="" v-model="author_id">
                            <option v-for="author of authors" :value="author.id">{{author.name}}</option>
                        </select>
                    </div>

                    <div class="card-footer">
                        <button v-if="formMode == 'new'" class="btn btn-primary" @click='add'>Add</button>
                        <button v-if="formMode == 'edit'" class="btn btn-primary" @click='update'>Update</button>
                         <button class="btn btn-primary" @click='resetForm'>resetForm</button>
                    </div>
                </div>
                <h2>Articles</h2>
                <div v-for="article of articles" class="card" style="margin:10px;">
                    <div class="card-header">{{article.title}}</div>

                    <div class="card-body">
                        <h5>Text:</h5>
                        {{article.text}}
                        <h5>Author:</h5>
                        {{article.author.name}}
                    </div>

                    <div class="card-footer">
                        <button @click="edit(article)" class="btn btn-warning">Edit</button>
                        <button @click="remove(article.id)" class="btn btn-danger">Delete</button>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        mounted() {
            // console.log('Component mounted.')
            this.retrieve()
            this.retrieveAuthors()
        },
        data(){
            return {
                articles: [],
                authors: [],
                formMode: 'new',
                id: null,
                author_id: null,
                title: '',
                text: '',
            }
        },
        methods:{
            resetForm(){
                this.formMode= 'new',
                this.id= null,
                this.author_id = null
                this.title= ''
                this.text = '' 
            },
            getFormObj(){
                let obj = {
                    author_id: this.author_id,
                    title: this.title,
                    text: this.text,
                }
                if(this.formMode == 'edit'){
                    obj['id'] = this.id
                }
                return obj
            },
            edit(obj){
                this.id = obj.id
                this.author_id = obj.author_id
                this.title= obj.title
                this.text = obj.text
                this.formMode = 'edit'
            },
            retrieveAuthors(){
                axios.get('http://localhost:8000/api/authors')
                .then((r)=>{
                    this.authors = r.data.data
                })
                .catch((e)=>{console.log(e)})
            },
            retrieve(){
                axios.get('http://localhost:8000/api/articles')
                .then((r)=>{
                    this.articles = r.data.data
                })
                .catch((e)=>{console.log(e)})
            },
            add(){
                let obj = this.getFormObj()
                axios.post('http://localhost:8000/api/articles', obj)
                .then((r)=>{
                    this.articles = this.articles.concat([r.data])
                    this.resetForm()
                })
                .catch((e)=>{console.log(e)})
            },
            update(){
                let obj = this.getFormObj()
                axios.put('http://localhost:8000/api/articles/'+this.id,obj)
                .then((r)=>{
                    this.articles = this.articles.filter((article)=>{return article.id != r.data.id})
                    this.articles = this.articles.concat([r.data])
                    this.resetForm()
                })
                .catch((e)=>{console.log(e)})
            },
            remove(id){
                axios.delete('http://localhost:8000/api/articles/'+id)
                .then((r)=>{
                    this.articles = this.articles.filter((article)=>{return article.id != id})
                })
                .catch((e)=>{console.log(e)})
            },
        }
    }
</script>
