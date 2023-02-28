import {createRouter,createWebHistory} from 'vue-router';
import Login         from './components/auth/login.vue';
import Verify        from './components/auth/verify.vue';
import Dashboard     from './components/dashboard.vue';
import AllPatients   from './components/allPatients.vue';
import AddPatient    from './components/addPatient.vue';
import AddUser       from './components/auth/addUser.vue';
import ViewUsers     from './components/auth/viewUsers.vue';
import AddDoctor     from './components/addDoctor.vue';
import AllDoctors    from './components/allDoctors.vue';

const routes = [
    {
        path     : '/login',
        component: Login,
        name     : "login"
    },
    {
        path     : '/verify',
        component: Verify,
        name     : "verify"
    },
    {
        path     : '/',
        component: Dashboard,
        name     : "dashboard"
    },
    {
        path     : '/all-patients',
        component: AllPatients,
        name     : "all-patients"
    },
    {
        path     : '/add-patient',
        component: AddPatient,
        name     : "add-patient"
    },
    {
        path     : '/edit-patient/:patientId',
        component: AddPatient,
        name     : "edit-patient"
    },

    {
        path     : '/add-user',
        component: AddUser,
        name     : "add-user"
    },

    {
        path     : '/edit-user/:userId',
        component: AddUser,
        name     : "edit-user"
    },

    {
        path     : '/view-user',
        component: ViewUsers,
        name     : "view-user"
    },

    {
        path     : '/add-doctor',
        component: AddDoctor,
        name     : "add-doctor"
    },
    {
        path     : '/all-doctors',
        component: AllDoctors,
        name     : "all-doctors"
    },

    {
        path     : '/edit-doctor/:doctorId',
        component: AddDoctor,
        name     : "edit-doctor"
    },

];

export default createRouter({
    history: createWebHistory(),
    routes
});