<template>
<div>
<div class="container">
    <h1 class="page-header text-center"> </h1>
    <div id="members">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <h2>Services List
                    <button class="btn btn-primary pull-right" @click="showAddModal = true"><span class="glyphicon glyphicon-plus"></span> Member</button>
                    </h2>
                </div>
            </div>

            <div class="alert alert-danger text-center" v-if="errorMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
                <span class="glyphicon glyphicon-alert"></span> {{ errorMessage }}
            </div>
            
            <div class="alert alert-success text-center" v-if="successMessage">
                <button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
                <span class="glyphicon glyphicon-ok"></span> {{ successMessage }}
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <th>Name of The Services</th>
                    <th>Link</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="Service in Services"  v-bind:key="Service.id"> 
                        <td>{{ Service.Name }}</td>
                        <td>{{ Service.Link }}</td>
                        <td>
                            <button class="btn btn-success" @click="showEditModal = true; selectMember(Service);"><span class="glyphicon glyphicon-edit"></span> Edit</button> <button class="btn btn-danger" @click="showDeleteModal = true; selectMember(Service);"><span class="glyphicon glyphicon-trash"></span> Delete</button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

<!-- Add Modal -->
<div class="myModal" v-if="showAddModal">
    <div class="modalContainer">
        <div class="modalHeader">
            <span class="headerTitle">Add New Service</span>
            <button class="closeBtn pull-right" @click="showAddModal = false">&times;</button>
        </div>
        <div class="modalBody">
            <div class="form-group">
                <label>Name of the Service :</label>
                <input type="text" class="form-control" v-model="newMember.Name">
            </div>
            <div class="form-group">
                <label>Link :</label>
                <input type="text" class="form-control" v-model="newMember.Link">
            </div>
        </div>
        <hr>
        <div class="modalFooter">
            <div class="footerBtn pull-right">
                <button class="btn btn-default" @click="showAddModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-primary" @click="showAddModal = false; saveMember();"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="myModal" v-if="showEditModal">
    <div class="modalContainer">
        <div class="editHeader">
            <span class="headerTitle">Edit Services</span>
            <button class="closeEditBtn pull-right" @click="showEditModal = false">&times;</button>
        </div>
        <div class="modalBody">
            <div class="form-group">
                <label>Name of the Service:</label>
                <input type="text" class="form-control" v-model="clickMember.Name">
            </div>
            <div class="form-group">
                <label>Link:</label>
                <input type="text" class="form-control" v-model="clickMember.Link">
            </div>
        </div>
        <hr>
        <div class="modalFooter">
            <div class="footerBtn pull-right">
                <button class="btn btn-default" v-on:click="showEditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-success" v-on:click="showEditModal = false; updateMember();"><span class="glyphicon glyphicon-check"></span> Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="myModal" v-if="showDeleteModal">
    <div class="modalContainer">
        <div class="deleteHeader">
            <span class="headerTitle">Delete Service</span>
            <button class="closeDelBtn pull-right" @click="showDeleteModal = false">&times;</button>
        </div>
        <div class="modalBody">
            <h5 class="text-center">Are you sure you want to Delete</h5>
            <h2 class="text-center">{{clickMember.Name}} {{clickMember.Link}}</h2>
        </div>
        <hr>
        <div class="modalFooter">
            <div class="footerBtn pull-right">
                <button class="btn btn-default" @click="showDeleteModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-danger" @click="showDeleteModal = false; deleteMember(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</template>
<script>

import axios from 'axios'
export default{
    name: 'EditHeader',
    
    data(){
        return{
        showAddModal: false,
        showEditModal: false,
        showDeleteModal: false,
        errorMessage: "",
        successMessage: "",
        Services: [],
        newMember: {Name: '', Link: ''},
        clickMember: {}
    }
},

    mounted(){
        this.getAllMembers();
    },

    methods:{
        getAllMembers: function(){
            var self = this;
            axios.get('http://localhost/admin/services.php')
                .then(function(response){
                    //console.log(response);
                    if(response.data.error){
                        self.errorMessage = response.data;
                    }
                    else{
                        self.Services = response.data;
                    }
                });
        },

        saveMember: function(){
            //console.log(app.newMember);
            var self = this;
            //debugger;       
            axios.post('http://localhost/admin/services.php?crud=create', this.newMember)
                .then(function(response){
                    console.log(response);
                    self.newMember = {Name: '', Link:''};
                    if(response.data.error){
                        self.errorMessage = response.data.message;
                    }
                    else{
                        self.successMessage = response.data;
                        self.getAllMembers();
                    }
                });
        },

        updateMember(){
            var self = this;
            //debugger;
             var memForm = self.toFormData(self.clickMember);
            axios.post('http://localhost/admin/services.php?crud=update', memForm)
                .then(function(response){
                    console.log(response);
                    self.clickMember = {};
                    if(response.data.error){
                        self.errorMessage = response.data.message;
                    }
                    else{
                        self.successMessage = response.data;
                        self.getAllMembers();
                    }
                });
        },

        deleteMember(){
            var self = this;
            var memForm = self.toFormData(self.clickMember);
            axios.post('http://localhost/admin/services.php?crud=delete', memForm)
                .then(function(response){
                    //console.log(response);
                    self.clickMember = {};
                    if(response.data.error){
                        self.errorMessage = response.data;
                    }
                    else{
                        self.successMessage = response.data;
                        self.getAllMembers();
                    }
                });
        },

        selectMember(Service){
            var self = this;
            self.clickMember = Service;
        },

        toFormData: function(obj){
            var form_data = new FormData();
           // debugger;
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            //debugger;
            return form_data;
        },

        clearMessage: function(){
            this.errorMessage = '';
            this.successMessage = '';
        }

    }
}
</script>
<style>


</style>