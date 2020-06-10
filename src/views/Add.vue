<template>
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
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for:="member in members">
                        <td>{{ member.firstname }}</td>
                        <td>{{ member.lastname }}</td>
                        <td>
                            <button class="btn btn-success" @click="showEditModal = true; selectMember(member);"><span class="glyphicon glyphicon-edit"></span> Edit</button> <button class="btn btn-danger" @click="showDeleteModal = true; selectMember(member);"><span class="glyphicon glyphicon-trash"></span> Delete</button>

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
                <label>Firstname:</label>
                <input type="text" class="form-control" v-model="newMember.firstname">
            </div>
            <div class="form-group">
                <label>Lastname:</label>
                <input type="text" class="form-control" v-model="newMember.lastname">
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
                <label>Firstname:</label>
                <input type="text" class="form-control" v-model="clickMember.firstname">
            </div>
            <div class="form-group">
                <label>Lastname:</label>
                <input type="text" class="form-control" v-model="clickMember.lastname">
            </div>
        </div>
        <hr>
        <div class="modalFooter">
            <div class="footerBtn pull-right">
                <button class="btn btn-default" @click="showEditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-success" @click="showEditModal = false; updateMember();"><span class="glyphicon glyphicon-check"></span> Save</button>
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
            <h2 class="text-center">{{clickMember.firstname}} {{clickMember.lastname}}</h2>
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
</template>
<script>
import axios from 'axios'
export default {
    name: 'add',
    data () {
    return {
        showAddModal: false,
        showEditModal: false,
        showDeleteModal: false,
        errorMessage: "",
        successMessage: "",
        members: [],
        newMember: {firstname: '', lastname: ''},
        clickMember: {}
    }
  },
    mounted: function(){
        this.getAllMembers();
    },

    methods:{
        getAllMembers: function(){
            axios.get('http://localhost/admin/api.php')
                .then(function(response){
                    //console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message;
                    }
                    else{
                        this.members = response.data.members;
                    }
                });
        },

        saveMember: function(){
            //console.log(app.newMember);
            var memForm = this.toFormData(this.newMember);
            axios.post('http://localhost/admin/api.php?crud=create', memForm)
                .then(function(response){
                    //console.log(response);
                    this.newMember = {firstname: '', lastname:''};
                    if(response.data.error){
                        this.errorMessage = response.data.message;
                    }
                    else{
                        this.successMessage = response.data.message
                        this.getAllMembers();
                    }
                });
        },

        updateMember(){
            var memForm = this.toFormData(this.clickMember);
            axios.post('http://localhost/admin/api.php?crud=update', memForm)
                .then(function(response){
                    //console.log(response);
                    this.clickMember = {};
                    if(response.data.error){
                        this.errorMessage = response.data.message;
                    }
                    else{
                        this.successMessage = response.data.message
                        this.getAllMembers();
                    }
                });
        },

        deleteMember(){
            var memForm = this.toFormData(this.clickMember);
            axios.post('http://localhost/admin/api.php?crud=delete', memForm)
                .then(function(response){
                    //console.log(response);
                    this.clickMember = {};
                    if(response.data.error){
                        this.errorMessage = response.data.message;
                    }
                    else{
                        this.successMessage = response.data.message
                        this.getAllMembers();
                    }
                });
        },

        selectMember(member){
           this.clickMember = member;
        },

        toFormData: function(obj){
            var form_data = new FormData();
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            return form_data;
        },

        clearMessage: function(){
            this.errorMessage = '';
            this.successMessage = '';
        }

    }
}
</script>