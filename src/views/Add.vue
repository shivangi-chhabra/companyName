<template>
<div>
    
    
<div class="container">
    <h1 class="page-header text-center">Vue.js CRUD Operation with PHP/MySQLi</h1>
    <div id="members">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <h2>Member List
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
                    <th>Address</th>
                    <th>Telephone</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="u in us"  v-bind:key="u.id"> 
                        <td>{{ u.ad }}</td>
                        <td>{{ u.tel }}</td>
                        <td>
                            <button class="btn btn-success" @click="showEditModal = true; selectMember(u);"><span class="glyphicon glyphicon-edit"></span> Edit</button> <button class="btn btn-danger" @click="showDeleteModal = true; selectMember(u);"><span class="glyphicon glyphicon-trash"></span> Delete</button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

<!-- Add Modal -->
<div class="myModal" v-if="showAddModal">
    <div class="modalContainer">
        <div class="modalHeader">
            <span class="headerTitle">Add New Member</span>
            <button class="closeBtn pull-right" @click="showAddModal = false">&times;</button>
        </div>
        <div class="modalBody">
            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" v-model="newMember.ad">
            </div>
            <div class="form-group">
                <label>Telephone:</label>
                <input type="text" class="form-control" v-model="newMember.tel">
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
            <span class="headerTitle">Edit Member</span>
            <button class="closeEditBtn pull-right" @click="showEditModal = false">&times;</button>
        </div>
        <div class="modalBody">
            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" v-model="clickMember.ad">
            </div>
            <div class="form-group">
                <label>Telephone:</label>
                <input type="text" class="form-control" v-model="clickMember.tel">
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
            <span class="headerTitle">Delete Member</span>
            <button class="closeDelBtn pull-right" @click="showDeleteModal = false">&times;</button>
        </div>
        <div class="modalBody">
            <h5 class="text-center">Are you sure you want to Delete</h5>
            <h2 class="text-center">{{clickMember.ad}} {{clickMember.tel}}</h2>
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
    name: 'Admin',
    
    data(){
        return{
        showAddModal: false,
        showEditModal: false,
        showDeleteModal: false,
        errorMessage: "",
        successMessage: "",
        us: [],
        newMember: {ad: '', tel: ''},
        clickMember: {}
    }
},

    mounted(){
        this.getAllMembers();
    },

    methods:{
        getAllMembers: function(){
            var self = this;
            axios.get('http://localhost/admin/api.php')
                .then(function(response){
                    //console.log(response);
                    if(response.data.error){
                        self.errorMessage = response.data;
                    }
                    else{
                        self.us = response.data;
                    }
                });
        },

        saveMember: function(){
            //console.log(app.newMember);
            var self = this;
            //debugger;       
            axios.post('http://localhost/admin/api.php?crud=create', this.newMember)
                .then(function(response){
                    console.log(response);
                    self.newMember = {ad: '', tel:''};
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
            axios.post('http://localhost/admin/api.php?crud=update', memForm)
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
            axios.post('http://localhost/admin/api.php?crud=delete', memForm)
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

        selectMember(u){
            var self = this;
            self.clickMember = u;
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
.myModal{
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background: rgba(0, 0, 0, 0.4);
}

.modalContainer{
    width: 555px;
    background: #FFFFFF;
    margin:auto;
    margin-top:50px;
}

.modalHeader{
    padding:10px;
    background: #008CBA;
    color: #FFFFFF;
    height:50px;
    font-size:20px;
    padding-left:15px;
}

.editHeader{
    padding:10px;
    background: #4CAF50;
    color: #FFFFFF;
    height:50px;
    font-size:20px;
    padding-left:15px;
}

.deleteHeader{
    padding:10px;
    background: #f44336;
    color: #FFFFFF;
    height:50px;
    font-size:20px;
    padding-left:15px;
}

.modalBody{
    padding:40px;
}

.modalFooter{
    height:36px;
}

.footerBtn{
    margin-right:10px;
    margin-top:-9px;
}

.closeBtn{
    background: #008CBA;
    color: #FFFFFF;
    border:none;
}

.closeEditBtn{
    background: #4CAF50;
    color: #FFFFFF;
    border:none;
}

.closeDelBtn{
    background: #f44336;
    color: #FFFFFF;
    border:none;
}


</style>