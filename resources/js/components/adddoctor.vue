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
                   <form @submit.prevent="saveDoctor">
                       <div class="card shadow mb-4">
                           <div class="card-header py-3">
                               <h6 class="m-0 font-weight-bold text-dark" v-if="this.doctorForm.doctorGenId == null">Add Doctor</h6>
                               <h6 class="m-0 font-weight-bold text-dark" v-else>Edit Doctor</h6>
                           </div>
                           <div class="card-body">
                               <div class="row">

                           
                               <div class="col-xl-6" v-if="this.doctorForm.doctorGenId != null">
                                   <div class="form-group">
                                       <label for="">Doctor ID</label>
                                       <input type="text" class="form-control form-control-sm" disabled  >
                                   </div>
                               </div>

                               <div class="col-xl-6">
                                   <div class="form-group">
                                       <label for="">Name&nbsp;<span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-sm" v-model="doctorForm.doctorName">
                                   </div>
                               </div>
                               <div class="col-xl-6">
                                   <div class="form-group">
                                       <label for="">Email ID&nbsp;<span class="text-danger">*</span></label>
                                       <input type="email" class="form-control form-control-sm"  v-model="doctorForm.doctorEmailId">
                                   </div>
                               </div>
                               <div class="col-xl-6">
                                   <div class="form-group">
                                       <label for="">Contact number&nbsp;<span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-sm"  v-model="doctorForm.doctorContactNo">
                                   </div>
                               </div>
                               <div class="col-xl-6">
                                   <div class="form-group">
                                       <label for="">Alternate Contact Number&nbsp;<span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-sm"  v-model="doctorForm.doctorAltContactNo">
                                   </div>
                               </div>

                               <div class="col-xl-6">
                                   <div class="form-group">
                                       <label for="">Specialization&nbsp;<span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-sm"  v-model="doctorForm.doctorSpecialization">
                                   </div>
                               </div>

                               </div>
                               <hr>
                               <div class="row">
                               <div class="col-xl-3">
                                    <button class="btn btn-success" type="submit"     v-if="this.doctorForm.doctorGenId == null">Save</button>
                                    <button class="btn btn-warning" type="submit"     v-if="this.doctorForm.doctorGenId != null">Update</button>
                                    <button class="btn btn-danger ml-1" type="reset"  v-if="this.doctorForm.doctorGenId == null">Reset</button>
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
import Navbar    from      './layouts/navbar.vue';
import Sidebars  from      './layouts/sidebars.vue';
import Footers   from      './layouts/footers.vue';
import Api       from      '../src/Api.js';
import Chokidar  from      '../src/Chokidar.js';

export default{
        components:{
           "navbar"  : Navbar,
           "sidebars": Sidebars,
           "footers" : Footers
       },

       data(){
            return{
                doctorForm:{
                    doctorGenId          :'',
                    doctorName           :'',
                    doctorContactNo      :'',
                    doctorAltContactNo   :'',
                    doctorEmailId        :'',
                    doctorSpecialization :''
                }
            }
        },

        methods:
        {
            saveDoctor()
            {
                Api().post('/doctor-data/',this.doctorForm)
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
        created()
        {
            if(Chokidar() == 'web')
            {
                
            }else{
                this.$router.push('/login');
            }
        }

    }
</script>