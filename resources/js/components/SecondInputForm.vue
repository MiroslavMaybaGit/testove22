<template>
    <div>
        <form @submit.prevent="create" method="post">
            <div class="form-group">
                <label for="colorSelect">Select color</label>
                <select class="form-control" id="colorSelect" v-model="FormInput.color_id" @change="setFormDate()" required>
                    <option v-for="color in colors" :value="color.id">{{color.name}}</option>
                </select>
                <span class="help-block alert-danger" v-if="error && errors.color_id">
                     <li v-for="color_id_error in errors.color_id">
                    {{ color_id_error }}
                     </li>
                </span>
            </div>
            <div class="form-group">
                <label for="driveOptionsSelect">Select drive options</label>
                <select class="form-control" id="driveOptionsSelect" v-model="FormInput.drive_options" @change="setFormDate()" required>
                    <option v-for="drive_option in drive_options" :value="drive_option">{{drive_option}}</option>
                </select>
                <span class="help-block alert-danger" v-if="error && errors.drive_options">
                     <li v-for="drive_options_error in errors.drive_options">
                    {{ drive_options_error }}
                     </li>
                </span>
            </div>
            <div class="form-group">
                <label for="file">Example file input</label>
                <input type="file" id="file" ref="file" name="fileToUpload" class="form-control-file"  @change="onFileChange">
                <span class="help-block alert-danger" v-if="error && errors.fileToUpload">
                     <li v-for="fileToUpload_error in errors.fileToUpload">
                    {{ fileToUpload_error }}
                     </li>
                </span>
            </div>
            <div v-if="(FormInput.mileage > 100000)" class="alert alert-warning" role="alert">
                We can insure your car!
            </div>
            <button type="submit" :disabled="FormInput.mileage > 100000" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-warning"  @click="GoHome">Get Quote</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        props: {
            color: {
                type: Array,
                required: true
            },
            user: {
                required: true
            },
            current_case:{
                required: true
            },
            drive_options:{
                required: false
            }
        },
        data(){
            return {
                errors:[],
                colors:this.color,
                error:false,
                file:'',
                FormInput:{
                    user: this.user,
                    title:this.current_case.title,
                    makes_id:this.current_case.makes_id,
                    model_id:this.current_case.model_id,
                    mileage:this.current_case.mileage,
                    buying_date: this.current_case.buying_date,
                    color_id: this.current_case.color_id,
                    drive_options: '',
                },


            }
        },
        methods: {
            GoHome(){
                document.location.href = '/home'
            },
            onFileChange(){
                console.log(this.$refs.file.files[0]);
                this.file = this.$refs.file.files[0];
            },
            async setFormDate (){
                console.log(this.FormInput)

                const data = this.FormInput;
                axios.post('/home/create/page_1/' + this.current_case.id, data)
                    .then((response) => {
                    })
                    .catch((error) => {
                        if (error.response.status == 422){
                            this.error = true;
                            this.success = false;
                            this.errors = error.response.data.errors;
                        }
                    });
            },
            async create (){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };
//                const data = this.FormInput;
                let formData = new FormData();
                formData.append('fileToUpload', this.file);
                formData.set('data',JSON.stringify(this.FormInput));
                axios.post('/home/create/page_2/' + this.current_case.id, formData,config)
                    .then((response) => {
                        this.error = false;
                        if(response.status === 200){
                            document.location.href = '/home'
                        }
                    })
                    .catch((error) => {
                        if (error.response.status == 422){
                            this.error = true;
                            this.success = false;
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        },
        mounted() {
            console.log(this.drive_options)
        }
    }
</script>
<style scoped>
    .row{
        margin: 5px;
    }
</style>
