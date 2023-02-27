<template>
    <div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    
                      <div class="col-lg-6 m-auto">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">OTP Verification</h1>
                            </div>
                            <form class="user" @submit.prevent="verify()">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter OTP..." v-model="verifyForm.emailOtp">
                                </div>
                              
                                <button type="submit" class="btn btn-success btn-user btn-block">
                                    Verify
                                </button>
                                
                               
                            </form>
                            <hr>
                            
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
import axios from 'axios';

export default{
    data(){
        return{
            verifyForm:{
                emailOtp  : '',
                email     : localStorage.getItem('email'),
                password  : localStorage.getItem('password')
            }
        }
    },
     methods:{
            verify()
            {
                axios.post('/api/otp-verify/',this.verifyForm)
                     .then((response) =>{
                        if(response.data['success'] == true)
                        {
                           localStorage.setItem('token',response.data['token']);
                           localStorage.setItem('guard',response.data['guard']);
                           localStorage.setItem('name' ,response.data['name']);  
                           this.$router.push({name: 'dashboard'});
                        }

                        if(response.data['success'] == false)
                        {
                            this.$swal({
                                icon: 'error',
                                title: ' '+response.data['message'],
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        }
                    });
            }
        }


}

</script>