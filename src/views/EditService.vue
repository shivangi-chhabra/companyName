<template>
<div>
<div class="container">
    <h1 class="page-header text-center"></h1>
    <div id="members">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <h2> Description of Services List
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
                    <th>Class</th>
                    <th>Heading</th>
                    <th>Text</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="detail in details"  v-bind:key="detail.id">
                        <td> {{detail.Class}}</td>
                        <td>{{ detail.Heading }}</td>
                        <td>{{ detail.Text }}</td>
                        <td>
                            <button class="btn btn-success" @click="showEditModal = true; selectMember(detail);"><span class="glyphicon glyphicon-edit"></span> Edit</button> <button class="btn btn-danger" @click="showDeleteModal = true; selectMember(detail);"><span class="glyphicon glyphicon-trash"></span> Delete</button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

<!-- Add Modal -->
<div class="myModal" v-if="showAddModal">
    <div class="modalContainer">
        <div class="modaldetail">
            <span class="detailTitle">Add New Service</span>
            <button class="closeBtn pull-right" @click="showAddModal = false">&times;</button>
        </div>
        <div class="modalBody">
            <div class="form-group">
                <label>Class :</label>
                <input type="text" class="form-control" v-model="newMember.Class">
            </div>
            <div class="form-group">
                <label>Heading :</label>
                <input type="text" class="form-control" v-model="newMember.Heading">
            </div>
            <div class="form-group">
                <label>Text :</label>
                <input type="text" class="form-control" v-model="newMember.Text">
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
        <div class="editdetail">
            <span class="detailTitle">Edit Services</span>
            <button class="closeEditBtn pull-right" @click="showEditModal = false">&times;</button>
        </div>
        <div class="modalBody">
            <div class="form-group">
                <label>Class :</label>
                <input type="text" class="form-control" v-model="clickMember.Class">
            </div>
        <div class="modalBody">
            <div class="form-group">
                <label>Heading:</label>
                <input type="text" class="form-control" v-model="clickMember.Heading">
            </div>
            <div class="form-group">
                <label>Text:</label>
                <input type="text" class="form-control" v-model="clickMember.Text">
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
        <div class="deletedetail">
            <span class="detailTitle">Delete Service</span>
            <button class="closeDelBtn pull-right" @click="showDeleteModal = false">&times;</button>
        </div>
        <div class="modalBody">
            <h5 class="text-center">Are you sure you want to Delete</h5>
            <h2 class="text-center">{{clickMember.Heading}} {{clickMember.Text}}</h2>
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
</div>
</template>
<script>

import axios from 'axios'
export default{
    name: 'Editdetail',
    
    data(){
        return{
        showAddModal: false,
        showEditModal: false,
        showDeleteModal: false,
        errorMessage: "",
        successMessage: "",
        details: [],
        newMember: {Class: '', Heading: '', Text: ''},
        clickMember: {}
    }
},

    mounted(){
        this.getAllMembers();
    },

    methods:{
        getAllMembers: function(){
            var self = this;
            axios.get('http://localhost/admin/comp.php')
                .then(function(response){
                    //console.log(response);
                    if(response.data.error){
                        self.errorMessage = response.data;
                    }
                    else{
                        self.details = response.data;
                    }
                });
        },

        saveMember: function(){
            //console.log(app.newMember);
            var self = this;
            //debugger;       
            axios.post('http://localhost/admin/comp.php?crud=create', this.newMember)
                .then(function(response){
                    console.log(response);
                    self.newMember = {Heading: '', Text:''};
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
            axios.post('http://localhost/admin/comp.php?crud=update', memForm)
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
            axios.post('http://localhost/admin/comp.php?crud=delete', memForm)
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

        selectMember(detail){
            var self = this;
            self.clickMember = detail;
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

.modaldetail{
    padding:10px;
    background: #008CBA;
    color: #FFFFFF;
    height:50px;
    font-size:20px;
    padding-left:15px;
}

.editdetail{
    padding:10px;
    background: #4CAF50;
    color: #FFFFFF;
    height:50px;
    font-size:20px;
    padding-left:15px;
}

.deletedetail{
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