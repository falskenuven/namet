<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Avatar</div>
    
                    <div class="card-body">
                        <div v-if="success != ''" class="alert alert-success" role="alert">
                          {{success}}
                          {{error}}
                        </div>
                        <form @submit="formSubmit" enctype="multipart/form-data">
                        <input type="file" class="form-control" v-on:change="onFileChange">
    
                        <button class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
   
<script>
    export default {
        data() {
            return {
              file: '',
              success: ''
            };
        },
        methods: {
            onFileChange(e){
                //console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
   
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
    
                let formData = new FormData();
                formData.append('file', this.file);
   
                axios.post('/formSubmit', formData, config)
                .then(function (response) {
                    let file =  response.data.fileName;
                    currentObj.success = response.data.success;

                })
                .catch(function (error) {
                    currentObj.output = error;
                    currentObj.$noty.warning('Payload Too Large');
                });
            }
        }
    }
</script>