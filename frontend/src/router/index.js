import { createRouter, createWebHistory } from 'vue-router'
import Home from '../components/Home.vue'
import AdminDashboard from '../components/AdminDashboard.vue'
import EventListUser from '../components/EventListUser.vue'  
import EventList from '../components/EventList.vue'          
import EventDetail from '../components/EventDetail.vue'
import EventCreate from '../components/EventCreate.vue'
import EventEdit from '../components/EventEdit.vue'
import AuthPage from '../components/AuthPage.vue' 

// Library imports
import Library from '../components/Library.vue'
import AdminLibrary from '../components/AdminLibrary.vue'

// Facilities imports
import FacilitiesList from '../components/FacilitiesList.vue'
import AdminFacilities from '../components/AdminFacilities.vue'
import FacilityCreate from '../components/FacilityCreate.vue'
import FacilityEdit from '../components/FacilityEdit.vue'

const routes = [
  // ==========================================
  // PUBLIC ROUTES (Anyone can see these)
  // ==========================================
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/events',
    name: 'events-list-user',
    component: EventListUser   
  },
  {
    path: '/events/:id',
    name: 'event-detail',
    component: EventDetail
  },
  {
    path: '/library',
    name: 'library',
    component: Library
  },
  {
    path: '/facilities',
    name: 'facilities-list',
    component: FacilitiesList
  },
  {
    path: '/admin', 
    name: 'admin-login',
    component: AuthPage
  },

  // ==========================================
  // PROTECTED ADMIN ROUTES (Needs Login Token)
  // ==========================================
  {
    path: '/admin/dashboard', 
    name: 'admin-dashboard',
    component: AdminDashboard,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/events',
    name: 'events-list-admin',
    component: EventList,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/events/create', 
    name: 'event-create',
    component: EventCreate,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/events/:id/edit',
    name: 'event-edit',
    component: EventEdit,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/library',
    name: 'admin-library',
    component: AdminLibrary,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/facilities',
    name: 'admin-facilities',
    component: AdminFacilities,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/facilities/create',
    name: 'facility-create',
    component: FacilityCreate,
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/facilities/:id/edit',
    name: 'facility-edit',
    component: FacilityEdit,
    meta: { requiresAuth: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// ==========================================
// THE BOUNCER (Navigation Guard)
// ==========================================
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    const token = localStorage.getItem('adminToken');

    if (!token) {
      next({ path: '/admin' }); 
    } else {
      next(); 
    }
  } else {
    next();
  }
})

export default router