import { createRouter, createWebHistory } from 'vue-router'
import Home from '../components/Home.vue'
import AdminDashboard from '../components/AdminDashboard.vue'
import EventListUser from '../components/EventListUser.vue'  
import EventList from '../components/EventList.vue'          
import EventDetail from '../components/EventDetail.vue'
import EventCreate from '../components/EventCreate.vue'
import EventEdit from '../components/EventEdit.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/admin',
    name: 'admin',
    component: AdminDashboard
  },
  {
    path: '/events',
    name: 'events-list-user',
    component: EventListUser   
  },
  {
    path: '/admin/events',
    name: 'events-list-admin',
    component: EventList        
  },
  {
    path: '/events/:id',
    name: 'event-detail',
    component: EventDetail
  },
  {
    path: '/events/create',
    name: 'event-create',
    component: EventCreate
  },
  {
    path: '/events/:id/edit',
    name: 'event-edit',
    component: EventEdit
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router