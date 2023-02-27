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
                   <div class="col-lg-10 m-auto" >
                   <!-- Basic Card Example -->
                   <form @submit.prevent="saveUser">
                       <div class="card shadow mb-4">
                           <div class="card-header py-3">
                               <h6 class="m-0 font-weight-bold text-dark" v-if="this.userForm.userGenId == null">Add user</h6>
                               <h6 class="m-0 font-weight-bold text-dark" v-else>Edit User</h6>
                           </div>
                           <div class="card-body">
                               <div class="row">

                           
                               <div class="col-xl-6" v-if="this.userForm.userGenId != null">
                                   <div class="form-group">
                                       <label for="">User ID</label>
                                       <input type="text" class="form-control form-control-sm" disabled  v-model="userForm.userGenId">
                                   </div>
                               </div>

                               <div class="col-xl-6">
                                   <div class="form-group">
                                       <label for="">Name&nbsp;<span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-sm" v-model="userForm.name" >
                                   </div>
                               </div>
                               <div class="col-xl-6">
                                   <div class="form-group">
                                       <label for="">Email Address&nbsp;<span class="text-danger">*</span></label>
                                       <input type="email" class="form-control form-control-sm"  v-model="userForm.email">
                                   </div>
                               </div>
                               <!-- <div class="col-xl-6">
                                   <div class="form-group">
                                       <label for="">Password&nbsp;<span class="text-danger">*</span></label>
                                       <input type="password" class="form-control form-control-sm"  v-model="userForm.password">
                                   </div>
                               </div>
                               <div class="col-xl-6">
                                   <div class="form-group">
                                       <label for="">Confirm Password&nbsp;<span class="text-danger">*</span></label>
                                       <input type="password" class="form-control form-control-sm"  v-model="userForm.cPassword">
                                   </div>
                               </div> -->
                               </div>
                               <hr>
                               <div class="row">
                               <div class="col-xl-3">
                                <button class="btn btn-success" type="submit"     v-if="this.userForm.userGenId == null">Save</button>
                                    <button class="btn btn-warning" type="submit" v-if="this.userForm.userGenId != null">Update</button>
                                    <button class="btn btn-danger ml-1"  type="reset" v-if="this.userForm.userGenId == null">Reset</button>
                               </div>
                           </div>
                           </div>
                       </div>
                   </form>

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

    export default{
        components:{
           "navbar"  : Navbar,
           "sidebars": Sidebars,
           "footers" : Footers
       },

        data(){
            return{
                userForm:{
                    userGenId   :'',
                    name        :'',
                    email       :'',   
                }
            }
        },

        methods:
        {      
            saveUser()
            {
                if(this.userForm.userGenId != null)
                {
                    Api().post('/update-user-data/'+this.userForm.userGenId,this.userForm)
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
                    }    
                });
                }else{
                    Api().post('/save-user-data/',this.userForm)
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
                    }    
                });
                }
              
            },

            async getPatById()
            {
                const userGenId = window.location.pathname.split('/').reverse()[0];

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
            },
        },
        created()
        {
            if(Chokidar() == 'web')
            {
                this.getPatById();
            }else{
                this.$router.push('/login');
            }
        }
    };

</script>