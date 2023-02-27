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
                <router-link to="/add-patient" class="btn btn-primary btn circle mb-2"><i class="fas fa-plus"></i>&nbsp;Add Patient</router-link>
                <a href="/emp-export" class="btn btn-danger btn danger mb-2 ml-1"><i class="fas fa-download"></i>&nbsp;Export</a>
                <div class="card shadow-lg mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Patients</h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Patients ID</th>
                                            <th>Name</th>
                                            <th>Contact Details</th>
                                            <th>Email ID</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr  v-for="(pat,index) in allPatient" :key="index">
                                            <td>{{index+1}}</td>
                                            <td>{{pat.patientGenId}}</td>
                                            <td>{{pat.patientFName}}</td>
                                            <td>Primary : {{pat.patientContactNo}} <br> Alternate: {{pat.patientAltContactNo}}</td>
                                            <td>{{pat.patientEmailId}}</td>
                                            <td>
                                                {{ pat.get_address.addressLine1+',' }}  {{ pat.get_address.addressLine2 == null ? '':pat.get_address.addressLine2+',' }} <br>
                                                City     : {{ pat.get_address.addressCity == null ?'':pat.get_address.addressCity+',' }} <br>
                                                District : {{ pat.get_address.addressDistrict == null ?'':pat.get_address.addressDistrict+',' }} <br>
                                                {{ pat.get_address.addressState+' ,PIN-'   }} {{ pat.get_address.addressPinCode }}
                                            </td>
                                            <td>
                                                <router-link :to="'/edit-patient/'+pat.patientGenId" class="btn btn-success btn-circle"><i class="fas fa-edit"></i></router-link>
                                                <button class="btn btn-danger btn-circle ml-1"  @click="deletePat(pat.patientGenId)"><i class="fas fa-trash"></i></button>
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
   import Navbar     from './layouts/navbar.vue';
   import Sidebars   from './layouts/sidebars.vue';
   import Footers    from './layouts/footers.vue';
   import Api        from '../src/Api.js';
   import Chokidar   from '../src/Chokidar.js';

   export default {
       components:{
           "navbar"  : Navbar,
           "sidebars": Sidebars,
           "footers" : Footers
       },

       data(){
           return{
            allPatient:[],
            
           }
       },

       methods:{
        getPatData()
        {
            Api().get('/get-patients-list')
                 .then((response) => {
                  this.allPatient = response.data;
            });
        },

        deletePat(patId)
        {
            Api().post('/delete-patients/'+patId)
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
                        this.getPatData();
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
              this.getPatData();
             
           }else{
               this.$router.push('/login');
           }
       }
   }
</script>