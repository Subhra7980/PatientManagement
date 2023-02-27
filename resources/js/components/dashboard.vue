<template>
    <!-- Page Wrapper -->
    <div id="wrapper">

<!-- Sidebar -->
    <sidebars/>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

   <!-- Main Content -->
   <div id="content">

       <!-- Topbar -->
           <navbar/>
       <!-- End of Topbar -->

       <!-- Begin Page Content -->
           <div class="container-fluid">

               <!-- Page Heading -->
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                   <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
               </div>

               <!-- Content Row -->
               <div class="row">

                   <!-- Earnings (Monthly) Card Example -->
                   <div class="col-xl-3 col-md-6 mb-4">
                       <div class="card border-left-dark shadow h-100 py-2">
                           <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                   <div class="col mr-2">
                                       <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                         Total Patient</div>
                                       <div class="h5 mb-0 font-weight-bold text-dark">{{ countPatient }}</div>
                                   </div>
                                   <div class="col-auto">
                                       <i class="fas fa-users fa-2x text-gray-300"></i>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                 
               </div>
           </div>
       <!-- /.container-fluid -->

   </div>
   <!-- End of Main Content -->

   <!-- Footer -->
       <footers/>
   <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->


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
            countPatient:'',
           }
       },

       methods:{

        getPatCount()
        {
            Api().get('/get-patients-count')
                 .then((response) => {
                  this.countPatient = response.data;
            });
        },
          
       },

       created()
       {
           if(Chokidar() == 'web')
           {
            this.getPatCount();
           }else{
               this.$router.push('/login');
           }
       }
       

   }

</script>