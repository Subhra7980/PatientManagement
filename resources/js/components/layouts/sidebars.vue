<template>
    <!-- Sidebar -->
      <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #73a662;">

  <!-- Sidebar - Brand -->
  <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/">
      <div class="sidebar-brand-icon">
          <i class="fas fa-users"></i>
      </div>
      <div class="sidebar-brand-text mx-3">PMS</div>
  </router-link>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
      <router-link class="nav-link" to="/">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
      </router-link>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      Employees
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Patient Details</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <router-link to="/all-patients" class="collapse-item">View all patient</router-link>
          </div>
          
      </div>
  </li>

  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>User Details</span>
      </a>
      <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <router-link to="/view-user" class="collapse-item">View All User</router-link>
        </div>
      </div>
  </li>

  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
          aria-expanded="true" aria-controls="collapseFour">
          <i class="fas fa-fw fa-cog"></i>
          <span>Doctor Details</span>
      </a>
      <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <router-link to="/all-doctors" class="collapse-item">View all Doctor</router-link>
          </div>
          
      </div>
  </li>

</ul>


    <!-- End of Sidebar -->
</template>

<script>

import Chokidar   from '../../src/Chokidar.js';

export default {
    data(){
        return{
            
        }
    },
    methods:{

    },
  created()
  {
      if(Chokidar() == 'web')
      {
          //
      }else{
          this.$router.push('/login');
      }
  }
}
</script>