<template>
    <div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                      <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login to start session</h1>
                            </div>
                            <form class="user" @submit.prevent="otpSend()">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address..." v-model="authForm.email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" v-model="authForm.password">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
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
            authForm:{
                email       : '',
                password    : ''
            }
        }
    },
     methods:{

            otpSend()
            {
                axios.post('/api/otp-send/',this.authForm)
                     .then((response) =>{
                        if(response.data['success'] == true)
                        {
                            localStorage.setItem('email'    ,this.authForm.email);   
                            localStorage.setItem('password' ,this.authForm.password); 
                            this.$swal({
                                icon: 'success',
                                title: ' '+response.data['message'],
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000
                            });
                            this.$router.push({name: 'verify'});

                            
                            // localStorage.setItem('token',response.data['token']);
                            // localStorage.setItem('guard',response.data['guard']);
                           
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
                    })

                
            }

     }


}

</script>