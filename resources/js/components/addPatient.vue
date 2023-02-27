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
                   <form @submit.prevent="savePat()">
                       <div class="card shadow mb-4">
                           <div class="card-header py-3">
                               <h6 class="m-0 font-weight-bold text-dark" v-if="this.patForm.patientGenId == null">Add Patient</h6>
                               <h6 class="m-0 font-weight-bold text-dark" v-else>Edit Patient</h6>
                           </div>
                           <div class="card-body">
                               <div class="row">

                           
                               <div class="col-xl-4" v-if="this.patForm.patientGenId != null">
                                   <div class="form-group">
                                       <label for="">Patient ID</label>
                                       <input type="text" class="form-control form-control-sm" disabled  v-model="patForm.patientGenId" >
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">First Name&nbsp;<span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-sm" v-model="patForm.patientFName" >
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">Middle name</label>
                                       <input type="text" class="form-control form-control-sm"  v-model="patForm.patientMName" >
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">Last name</label>
                                       <input type="text" class="form-control form-control-sm" v-model="patForm.patientLName">
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">Email Address&nbsp;<span class="text-danger">*</span></label>
                                       <input type="email" class="form-control form-control-sm"  v-model="patForm.patientEmailId">
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">Contact Number&nbsp;<span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-sm" maxlength="10" v-model="patForm.patientContactNo">
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">Alternate Contact Number</label>
                                       <input type="text" class="form-control form-control-sm" maxlength="10" v-model="patForm.patientAltContactNo">
                                   </div>
                           </div>

                       
                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">Address Line 1&nbsp;<span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-sm" v-model="patForm.addressLine1" >
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">Address Line 2</label>
                                       <input type="text" class="form-control form-control-sm" v-model="patForm.addressLine2" >
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">City</label>
                                       <input type="text" class="form-control form-control-sm" v-model="patForm.addressCity" >
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">District</label>
                                       <input type="text" class="form-control form-control-sm" v-model="patForm.addressDistrict">
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">State&nbsp;<span class="text-danger">*</span></label>
                                       <select class="form-control form-control-sm"  v-model="patForm.addressState">
                                           <option value="" selected="">--Select--</option>
                                           <option value="AN">Andaman and Nicobar Islands</option>
                                           <option value="AP">Andhra Pradesh</option>
                                           <option value="AR">Arunachal Pradesh</option>
                                           <option value="AS">Assam</option>
                                           <option value="BR">Bihar</option>
                                           <option value="CH">Chandigarh</option>
                                           <option value="CT">Chhattisgarh</option>
                                           <option value="DN">Dadra and Nagar Haveli</option>
                                           <option value="DD">Daman and Diu</option>
                                           <option value="DL">Delhi</option>
                                           <option value="GA">Goa</option>
                                           <option value="GJ">Gujarat</option>
                                           <option value="HR">Haryana</option>
                                           <option value="HP">Himachal Pradesh</option>
                                           <option value="JK">Jammu and Kashmir</option>
                                           <option value="JH">Jharkhand</option>
                                           <option value="KA">Karnataka</option>
                                           <option value="KL">Kerala</option>
                                           <option value="LA">Ladakh</option>
                                           <option value="LD">Lakshadweep</option>
                                           <option value="MP">Madhya Pradesh</option>
                                           <option value="MH">Maharashtra</option>
                                           <option value="MN">Manipur</option>
                                           <option value="ML">Meghalaya</option>
                                           <option value="MZ">Mizoram</option>
                                           <option value="NL">Nagaland</option>
                                           <option value="OR">Odisha</option>
                                           <option value="PY">Puducherry</option>
                                           <option value="PB">Punjab</option>
                                           <option value="RJ">Rajasthan</option>
                                           <option value="SK">Sikkim</option>
                                           <option value="TN">Tamil Nadu</option>
                                           <option value="TG">Telangana</option>
                                           <option value="TR">Tripura</option>
                                           <option value="UP">Uttar Pradesh</option>
                                           <option value="UT">Uttarakhand</option>
                                           <option value="WB">West Bengal</option>
                                       </select>
                                   </div>
                               </div>

                               <div class="col-xl-4">
                                   <div class="form-group">
                                       <label for="">Pin Code&nbsp;<span class="text-danger">*</span></label>
                                       <input type="text" class="form-control form-control-sm"  maxlength="6" v-model="patForm.addressPinCode">
                                   </div>
                               </div>
                               </div>
                               <hr>
                               <div class="row">
                               <div class="col-xl-3">
                                <button class="btn btn-success" type="submit"     v-if="this.patForm.patientGenId == null">Save</button>
                                    <button class="btn btn-warning" type="submit" v-if="this.patForm.patientGenId != null">Update</button>
                                    <button class="btn btn-danger ml-1"  type="reset" v-if="this.patForm.patientGenId == null">Reset</button>
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
               patForm:{
                    id                  :'',
                    patientGenId        :'',
                    patientFName        :'',
                    patientMName        :'',
                    patientLName        :'',
                    patientEmailId      :'',
                    patientContactNo    :'',
                    patientAltContactNo :'',

                    addressLine1         :'',
                    addressLine2         :'',
                    addressCity          :'',
                    addressDistrict      :'',
                    addressState         :'',
                    addressPinCode       :''
                
               }
           }
       },

       methods:{
            savePat()
            {
                if(this.patForm.patientGenId != null)
                {
                    Api().post('/update-patient-data/'+this.patForm.patientGenId,this.patForm)
                     .then((response) => {
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
                            this.$router.push('/all-patients');
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
                    Api().post('/save-patient-data/',this.patForm)
                         .then((response) => {
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
                            this.$router.push('/all-patients');
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
                const patId = window.location.pathname.split('/').reverse()[0];

                Api().get('/get-patient-by-id/'+patId)
                     .then((response) => {
                        if(response.data != null)
                        {
                           this.patForm = {
                                id                    : response.data.id,
                                patientGenId          : response.data.patientGenId,
                                patientFName          : response.data.patientFName,
                                patientMName          : response.data.patientMName,
                                patientLName          : response.data.patientLName,
                                patientEmailId        : response.data.patientEmailId,
                                patientContactNo      : response.data.patientContactNo,
                                patientAltContactNo   : response.data.patientAltContactNo,

                                addressLine1          :  response.data.get_address == null ?'': response.data.get_address.addressLine1,
                                addressLine2          :  response.data.get_address == null ?'': response.data.get_address.addressLine2,
                                addressCity           :  response.data.get_address == null ?'': response.data.get_address.addressCity,
                                addressDistrict       :  response.data.get_address == null ?'': response.data.get_address.addressDistrict,
                                addressState          :  response.data.get_address == null ?'': response.data.get_address.addressState,
                                addressPinCode        :  response.data.get_address == null ?'': response.data.get_address.addressPinCode
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
       

   }

</script>