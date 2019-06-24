<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <h2>Author form</h2>
                <div class="card" style="margin:10px;">
                    <div class="card-header">
                        Name: 
                        <input v-model='name' type="text" placeholder="name">
                    </div>

                    

                    <div class="card-footer">
                        <button v-if="formMode == 'new'" class="btn btn-primary" @click='add'>Add</button>
                        <button v-if="formMode == 'edit'" class="btn btn-primary" @click='update'>Update</button>
                         <button class="btn btn-primary" @click='resetForm'>resetForm</button>
                    </div>
                </div>
                <h2>Authors</h2>
                <div v-for="author of authors" class="card" style="margin:10px;">
                    <div class="card-header">{{author.name}}</div>

                    <!-- <div class="card-body">
                        <h5>Name:</h5>
                        {{author.text}}
                        <h5>Author:</h5>
                        {{author.author.name}}
                    </div> -->

                    <div class="card-footer">
                        <button @click="edit(author)" class="btn btn-warning">Edit</button>
                        <button @click="remove(author.id)" class="btn btn-danger">Delete</button>
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
                authors: [],
                authors: [],
                formMode: 'new',
                id: null,
                name: '',
            }
        },
        methods:{
            resetForm(){
                this.formMode= 'new',
                this.id= null,
                this.name = ''
            },
            getFormObj(){
                let obj = {
                    name: this.name,
                }
                if(this.formMode == 'edit'){
                    obj['id'] = this.id
                }
                return obj
            },
            edit(obj){
                this.id = obj.id
                this.name = obj.name
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
                axios.get('http://localhost:8000/api/authors')
                .then((r)=>{
                    this.authors = r.data.data
                })
                .catch((e)=>{console.log(e)})
            },
            add(){
                let obj = this.getFormObj()
                axios.post('http://localhost:8000/api/authors', obj)
                .then((r)=>{
                    this.authors = this.authors.concat([r.data])
                    this.resetForm()
                })
                .catch((e)=>{console.log(e)})
            },
            update(){
                let obj = this.getFormObj()
                axios.put('http://localhost:8000/api/authors/'+this.id,obj)
                .then((r)=>{
                    this.authors = this.authors.filter((author)=>{return author.id != r.data.id})
                    this.authors = this.authors.concat([r.data])
                    this.resetForm()
                })
                .catch((e)=>{console.log(e)})
            },
            remove(id){
                axios.delete('http://localhost:8000/api/authors/'+id)
                .then((r)=>{
                    this.authors = this.authors.filter((author)=>{return author.id != id})
                })
                .catch((e)=>{console.log(e)})
            },
        }
    }
</script>
