<template>
  <div>

    <div class="admin-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2 style="color: #fff; margin: 0;">Admin Dashboard</h2>
            <p style="color: #ccc; margin: 5px 0 0;">Welcome back, Administrator</p>
          </div>
          <div class="col-lg-6 text-right">
            <button @click="logout" class="btn-logout">
              <i class="fas fa-sign-out-alt"></i> Logout
            </button>
          </div>
        </div>
      </div>
    </div>


    <div class="container" style="margin-top: 60px; margin-bottom: 60px;">
      <div class="row">
 
        <div class="col-lg-4 col-md-6">
          <div class="admin-card">
            <div class="admin-icon">
              <i class="fas fa-calendar-alt"></i>
            </div>
            <h3>Events Management</h3>
            <p>Manage all events: create, edit, delete, and view event details.</p>
                <router-link to="/admin/events" class="admin-btn">
                <i class="fas fa-arrow-right"></i> Manage Events
                </router-link>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="admin-card">
            <div class="admin-icon">
              <i class="fas fa-book"></i>
            </div>
            <h3>Library Management</h3>
            <p>Manage books, journals, and library resources. (Coming Soon)</p>
            <a href="#" class="admin-btn-disabled">
              <i class="fas fa-clock"></i> Coming Soon
            </a>
          </div>
        </div>

  
        <div class="col-lg-4 col-md-6">
          <div class="admin-card">
            <div class="admin-icon">
              <i class="fas fa-building"></i>
            </div>
            <h3>Facilities Management</h3>
            <p>Manage campus facilities, labs, and classrooms. (Coming Soon)</p>
            <a href="#" class="admin-btn-disabled">
              <i class="fas fa-clock"></i> Coming Soon
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminDashboard',
  methods: {
    logout() {

      this.$router.push('/')
    }
  }
}
</script>

<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

.row {
  display: flex;
  flex-wrap: wrap;
}

.col-lg-4 {
  width: 33.333%;
  padding: 0 15px;
  box-sizing: border-box;
}

.col-lg-6 {
  width: 50%;
}

.text-right {
  text-align: right;
}


.admin-header {
  background: linear-gradient(135deg, #002147 0%, #004080 100%);
  padding: 30px 0;
}


.btn-logout {
  background: #dc3545;
  color: #fff;
  padding: 10px 25px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  transition: 0.3s;
}

.btn-logout:hover {
  background: #c82333;
  transform: translateY(-2px);
}

.admin-card {
  background: #fff;
  border-radius: 15px;
  padding: 40px 25px;
  text-align: center;
  box-shadow: 0 5px 20px rgba(0,0,0,0.08);
  margin-bottom: 30px;
  height: 100%;
  transition: all 0.3s ease;
}

.admin-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}

.admin-icon {
  width: 80px;
  height: 80px;
  background: #002147;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  transition: 0.3s;
}

.admin-card:hover .admin-icon {
  background: #f39c12;
}

.admin-icon i {
  font-size: 35px;
  color: #fff;
}

.admin-card h3 {
  color: #002147;
  font-size: 1.4rem;
  margin-bottom: 15px;
}

.admin-card p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 25px;
}

.admin-btn {
  display: inline-block;
  background: #28a745;
  color: #fff;
  padding: 12px 25px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s;
}

.admin-btn:hover {
  background: #218838;
  transform: translateY(-2px);
}

.admin-btn-disabled {
  display: inline-block;
  background: #6c757d;
  color: #fff;
  padding: 12px 25px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 500;
  cursor: not-allowed;
  opacity: 0.7;
}


@media (max-width: 768px) {
  .col-lg-4, .col-lg-6 {
    width: 100%;
  }
  
  .text-right {
    text-align: center;
    margin-top: 15px;
  }
  
  .admin-header h2 {
    text-align: center;
  }
  
  .admin-header p {
    text-align: center;
  }
}
</style>