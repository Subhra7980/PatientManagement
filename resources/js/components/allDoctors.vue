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
                <router-link to="/add-doctor" class="btn btn-primary btn circle mb-2"><i class="fas fa-plus"></i>&nbsp;Add Doctor</router-link>
                <a href="#" class="btn btn-danger btn danger mb-2 ml-1"><i class="fas fa-download"></i>&nbsp;Export</a>
                <div class="card shadow-lg mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Doctor</h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Doctor ID</th>
                                            <th>Name</th>
                                            <th>Contact Details</th>
                                            <th>Email ID</th>
                                            <th>Specialization</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr  v-for="(doctor,index) in allDoctors" :key="index">
                                            <td>{{index+1}}</td>
                                            <td>{{doctor.doctorGenId}}</td>
                                            <td>{{doctor.doctorName}}</td>
                                            <td>Primary : {{doctor.doctorContactNo}} <br> Alternate: {{doctor.doctorAltContactNo}}</td>
                                            <td>{{doctor.doctorEmailId}}</td>
                                            <td>{{doctor.doctorSpecialization}}</td>
                                            <td class="text-center">
                                                <router-link :to="'/edit-doctor/'+doctor.patientGenId" class="btn btn-success btn-circle"><i class="fas fa-edit"></i></router-link>
                                                <button class="btn btn-danger btn-circle ml-1"  @click="deleteDoctor(doctor.doctorGenId)"><i class="fas fa-trash"></i></button>
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
import navbar from      './layouts/navbar.vue';
import sidebars from    './layouts/sidebars.vue';
import footers from     './layouts/footers.vue';
import Api from         '../src/Api.js';
import Chokidar from    '../src/Chokidar.js';

export default{
        components:{
           "navbar"  : navbar,
           "sidebars": sidebars,
           "footers" : footers  
       },

       data(){
        return{
           allDoctors:{}
        }
       },
       methods:{

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