<template>
    <div id="wrapper">
       <!-- Sidebar -->
          <sidebars/>
       <!-- End of Sidebar -->
       <div id="content-wrapper" class="d-flex flex-column">
           <!-- Main Content -->
           <div id="content">
               <!-- Topbar -->
                   <navbar/>
               <!-- End of Topbar -->
               <div class="container-fluid">
                <router-link to="/add-user" class="btn btn-primary btn circle mb-2"><i class="fas fa-plus"></i>&nbsp;Add User</router-link>
                <a href="#" class="btn btn-info mb-2 ml-1"><i class="fas fa-download"></i>&nbsp;Export</a>
                <button class="btn btn-danger mb-2 ml-1" @click="deleteAll()"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button>
                <div class="card shadow-lg mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All User</h6>
                        </div>

                       
                       
                        <div class="card-body">
                            <div class="mt-2 mb-2 custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" @click="toggleSelect" :checked="selectAll" id="customCheck">
                                <label class="custom-control-label" for="customCheck">
                                   <b>Select All</b> 
                                </label>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>&nbsp;&nbsp;#</th>
                                            <th>Sl.No</th>
                                            <th>User Gen ID</th>
                                            <th>Name</th>
                                            <th>Email ID</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr  v-for="(usr,index) in allUser" :key="index">
                                            <td>
                                                <!-- <input class="form-check-input ml-1" type="checkbox" v-model="usr.checked" :value="usr.userGenId"  v-if="usr.userGenId !='USR-00001'"> -->

                                                <div class="custom-control custom-checkbox"  v-if="usr.userGenId !='USR-00001'">
                                                    <input class="custom-control-input" type="checkbox"  v-model="usr.checked" :value="usr.userGenId" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck"></label>
                                                </div>
                                            </td>
                                            <td>{{index+1}}</td>
                                            <td>{{usr.userGenId }}</td>

                                            <td> 
                                                <div class="editable-field" v-if="editedFieldId === usr.id">
                                                    <input type="text" class="form-control form-control-sm" v-model="userForm.name" :ref="`usr${usr.id}`" v-if="editedFieldId === usr.id">
                                                    
                                                </div>

                                                <div v-else>
                                                    <span class="editable-text">{{usr.name}}</span>
                                                    
                                                </div>                                                
                                            </td>

                                            <td> 
                                                <div class="editable-field" v-if="editedFieldId === usr.id">
                                                    <input type="text" class="form-control form-control-sm" v-model="userForm.email" :ref="`usr${usr.id}`" v-if="editedFieldId === usr.id">
                                                </div>

                                                <div v-else>
                                                    <span class="editable-text">{{usr.email}}</span>
                                                </div>                                                
                                            </td>
                                            
                                            <!-- <td class="text-center"> -->       
                                                <!-- <router-link :to="'/edit-user/'+usr.userGenId" class="btn btn-success btn-circle" v-if="usr.userGenId !='USR-00001'"><i class="fas fa-edit"></i></router-link> -->
                                                <!-- <button class="btn btn-danger btn-circle ml-1"  @click="deleteUser(usr.userGenId)"><i class="fas fa-trash"></i></button> -->
                                                <!-- <button class="btn btn-success btn-circle ml-1" v-if="usr.userGenId != 'USR-00001'"   @click="getPatById(usr.userGenId,index)"><i class="fas fa-edit"></i></button> -->
                                            <!-- </td> -->

                                            <td class="text-center"> 
                                                <div class="editable-field" v-if="editedFieldId === usr.id">
                                                    <button class="btn btn-warning btn-circle ml-1" @click.prevent="saveUser(usr.userGenId)" v-if="usr.userGenId != 'USR-00001'"><i class="fas fa-check"></i></button>  
                                                </div>

                                                <div v-else>
                                                    <button class="btn btn-success btn-circle ml-1" v-if="usr.userGenId != 'USR-00001'" @click.prevent="toggleEdit(usr.id,usr.userGenId)"><i class="fas fa-edit"></i></button>   
                                                </div>                                                
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
               <!-- Footer -->
               <footers/>
               <!-- End of Footer -->
       </div>
    </div>
</template>


<script>
   import Navbar     from '../layouts/navbar.vue';
   import Sidebars   from '../layouts/sidebars.vue';
   import Footers    from '../layouts/footers.vue';
   import Api        from '../../src/Api.js';
   import Chokidar   from '../../src/Chokidar.js';

   export default {
       components:{
           "navbar"  : Navbar,
           "sidebars": Sidebars,
           "footers" : Footers
       },

       data(){
           return{
            allUser  :[],
            selectAll:'',
            userForm:{
                userGenId   :'',
                name        :'',
                email       :''  
              },
              editedFieldId: null
           }
       },

       methods:{
        getUserData()
        {
            Api().get('/view-all-user-data')
                 .then((response) => {
                  this.allUser = response.data;
            });
        },

        deleteUser(usrId)
        {
            Api().post('/delete-user/'+usrId)
                 .then((response) => {
                    if(response.data['success'] == true)
                    {
                        this.$swal({
                            icon: 'success',
                            title: ' '+response.data['msg'][0],
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        this.getUserData();
                    }

                    if(response.data['success'] == false)
                    {
                        this.$swal({
                            icon: 'error',
                            title: ' '+response.data['msg'][0],
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000
                        });
                    }
            });
        },

        toggleSelect() 
        {
            var select = this.selectAll;
            this.allUser.forEach(function(usr){
                usr.checked = !select;
            });
            this.selectAll = !select;
        },

        deleteAll()
        {
            Api().post('/delete-all/',this.allUser)
                 .then((response) =>{
                    if(response.data['success'] == true)
                    {
                        this.$swal({
                            icon: 'success',
                            title: ' '+response.data['msg'],
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        this.getUserData();
                    } 
                });
         },

         toggleEdit(id,userGenId) 
         {
            if(id) 
            {
                this.editedFieldId = id;
                this.$nextTick(() => {
                if (this.$refs["field" + id]) {
                    this.$refs["field" + id][0].focus();
                  }
                });
                Api().get('/get-user-by-id/'+userGenId)
                     .then((response) => {
                        if(response.data != null)
                        {
                            this.userForm = {
                                userGenId           : response.data.userGenId,
                                name                : response.data.name,
                                email               : response.data.email,
                            };
                        }
                    });

            } else {
                this.editedFieldId = null;
              }
         },

            saveUser(userGenId)
            {
                    Api().post('/update-user-data/'+userGenId,this.userForm)
                         .then((response) =>{
                        if(response.data['success'] == true)
                        {
                            this.$swal({
                                icon: 'success',
                                title: ' '+response.data['msg'],
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            this.editedFieldId = null;
                            this.getUserData();
                        } 
                    
                        if(response.data['success'] == false)
                        {
                            this.$swal({
                                icon: 'error',
                                title: ' '+response.data['msg'],
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            this.editedFieldId = null;
                            this.getUserData();
                        }    
                    });
            },
    },

       created()
       {
           if(Chokidar() == 'web')
           {
              this.selectAll = false;
              this.getUserData();
             
           }else{
               this.$router.push('/login');
           }
       }
   }
</script>