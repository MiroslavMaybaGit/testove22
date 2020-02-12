<template>
    <div>
        <form @submit.prevent="create" method="post">
        <div class="form-group">
            <label for="caseName">Case</label>
            <input type="text" class="form-control" id="caseName" v-model="FormInput.title" @change="setFormDate()" required>
            <span class="help-block alert-danger " v-if="error && errors.title">
                     <li v-for="title_error in errors.title">
                    {{ title_error }}
                     </li>
                </span>
        </div>
        <div class="form-group">
            <label for="makerSelect">Select maker</label>
            <select class="form-control" id="makerSelect" v-model="FormInput.makes_id" @change="setMaker()" required>
                <option v-for="maker in makers" :value="maker.id">{{maker.name}}</option>
            </select>
            <span class="help-block alert-danger" v-if="error && errors.makes_id">
                     <li v-for="makes_id_error in errors.makes_id">
                    {{ makes_id_error }}
                     </li>
                </span>
        </div>
        <div class="form-group">
            <label for="modelSelect">Select model</label>
            <select class="form-control" id="modelSelect" v-model="FormInput.model_id" @change="setFormDate()" required>
                <option v-for="model in models" :value="model.id">{{model.name}}</option>
            </select>
            <span class="help-block alert-danger" v-if="error && errors.model_id">
                     <li v-for="model_id_error in errors.model_id">
                    {{ model_id_error }}
                     </li>
                </span>
        </div>
        <div class="form-group">
            <label for="mileage">Mileage</label>
            <input type="number" class="form-control" id="mileage"  v-model="FormInput.mileage" @change="setFormDate()" required>
            <span class="help-block alert-danger" v-if="error && errors.mileage">
                     <li v-for="mileage_error in errors.mileage">
                    {{ mileage_error }}
                     </li>
                </span>
        </div>
        <div class="form-group row">
            <label for="mileage">Buying Date</label>
            <div class="col-sm-2">
                <date-picker color="red" is-dark  v-model='FormInput.buying_date' @input="setFormDate" />
                <span class="help-block alert-danger" v-if="error && errors.buying_date">
                     <li v-for="buying_date_error in errors.buying_date">
                    {{ buying_date_error }}
                     </li>
                </span>
            </div>
        </div>
            <button type="submit" class="btn btn-success">Next Page</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        props: {
            makes: {
                type: Array,
                required: true
            },
            user: {
                required: true
            },
            current_case:{
                required: true
            }
        },
        data(){
            return {
                makers: this.makes,
                models:[],
                errors:[],
                error:false,
                attrs: [
                    {
                        key: 'today',
                        highlight: 'red',
                        date: new Date()
                    },
                ],
                FormInput:{
                    user: this.user,
                    title:this.current_case.title,
                    makes_id:this.current_case.makes_id,
                    model_id:this.current_case.model_id,
                    mileage:this.current_case.mileage,
                    buying_date: new Date(),
                },
                successMessage:''
            }
        },
        methods: {
            async setMaker (){
                this.models = [];
                this.FormInput.model_id = '';
                axios.get('/models_for_maker/' + this.FormInput.makes_id).then((response) => {
                    this.models = response.data;
                    this.setFormDate();
                }).catch((error) => {
                    if (error.status == 422){
                        this.error = true;
                        this.errors = error.response.data.errors;
                        console.log( this.errors)
                    }
                });
            },
            async setFormDate (){
                console.log(this.FormInput)
                const data = this.FormInput;
                axios.post('/home/create/page_1/' + this.current_case.id, data)
                    .then((response) => {
                        this.error = false;
                        this.success = true;
                        this.successMessage = response.data.message;
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
                console.log(this.FormInput)
                const data = this.FormInput;
                axios.post('/home/create/page_1/' + this.current_case.id + '?full_form=true', data)
                    .then((response) => {
                        this.error = false;
                        document.location.href = '/home/create/page_2/'+ this.current_case.id
                }).catch((error) => {
                        if (error.status == 422){
                            this.error = true;
                            this.success = false;
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        },
        mounted() {
            if(this.current_case.makes_id){
                this.setMaker();
                console.log(this.current_case)
                this.FormInput.model_id = this.current_case.model_id
            }
            if(this.current_case.buying_date){
               this.FormInput.buying_date =  new Date(this.current_case.buying_date);
            }
        }
    }
</script>
<style scoped>
    .row{
        margin: 5px;
    }
</style>
