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
                <a href="/emp-export" class="btn btn-danger btn danger mb-2 ml-1"><i class="fas fa-download"></i>&nbsp;Export</a>
                <div class="card shadow-lg mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All User</h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>User Gen ID</th>
                                            <th>Name</th>
                                            <th>Email ID</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr  v-for="(usr,index) in allUser" :key="index">
                                            <td>{{index+1}}</td>
                                            <td>{{usr.userGenId }}</td>
                                            <td>{{usr.name}}</td>
                                            <td>{{usr.email}}</td>
                                            <td>
                                                <router-link :to="'/edit-user/'+usr.userGenId" class="btn btn-success btn-circle"><i class="fas fa-edit"></i></router-link>
                                                <button class="btn btn-danger btn-circle ml-1"  @click="deleteUser(usr.userGenId)"><i class="fas fa-trash"></i></button>
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
            allUser:[],
            
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

      

       },

       created()
       {
           if(Chokidar() == 'web')
           {
              this.getUserData();
             
           }else{
               this.$router.push('/login');
           }
       }
   }
</script>