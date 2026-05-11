<template>
  <div>
    <SplashScreen v-if="showSplash" @splash-finished="showSplash = false" />
    <div v-else>

      <header>
        <div class="header-top-area">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              </div>
            </div>
          </div>
        </div>
        
        <div class="header-mid-area">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="logo-area">
                  <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="/images/b2b9bfc0-4f92-491d-a1d0-2eeeacf6ceef.png" alt="In-Tech Logo" style="height: 100px; width: auto;">
                    <h1>
                      <span class="univ-name">IN-TECH</span>
                      <span class="univ-sub">UNIVERSITY</span>
                      <span class="univ-admission">ADMISSION</span>
                    </h1>
                  </div>
                </div>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-12">

              </div>
            </div>
          </div>
        </div>
        
        <div class="main-menu-area">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <nav>
                  <ul>
                    <li><router-link to="/">HOME</router-link></li>
                    <li><router-link to="/events">EVENTS</router-link></li>
                    <li><a href="#">LIBRARY</a></li>
                    <li><a href="#">FACILITIES</a></li>
                    <li><div class="login-bar">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-right">
                <router-link to="/admin" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Admin Login
                </router-link>
          </div>
        </div>
      </div>
    </div></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </header>


      <main>
        <router-view />
      </main>


      <footer>
        <div class="footer-area-top">
          <div class="container">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer-box">
                  <h3>IN-TECH UNIVERSITY</h3>
                  <p>Admission Office<br>In-Tech University Campus<br>Jl. Teknologi No. 123<br>Kota Malang, Jawa Timur 65145</p>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer-box">
                  <h3>Featured Links</h3>
                  <ul>
                    <li><a href="#">University</a></li>
                    <li><a href="#">Admissions</a></li>
                    <li><a href="#">International Office</a></li>
                    <li><a href="#">Admission Info</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer-box">
                  <h3>Contact</h3>
                  <ul class="contact-list">
                    <li><i class="fab fa-whatsapp"></i> WA: +62 823-1363-8795</li>
                    <li><i class="fas fa-envelope"></i> admission@in-tech.ac.id</li>
                    <li><i class="fas fa-envelope"></i> dgs@in-tech.ac.id</li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer-box">
                  <h3>Information</h3>
                  <p>In-Tech International Office<br>Teknologi Building 1st floor<br>Jl. Teknologi No. 123, Malang<br>East Java, Indonesia 65145</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-area-bottom">
          <div class="container">
            <p>© 2025 In-Tech University All Rights Reserved.</p>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
import SplashScreen from './components/SplashScreen.vue'

export default {
  name: 'App',
  components: {
    SplashScreen
  },
  data() {
    return {
      showSplash: true
    }
  }
}
</script>

<style>
* {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background-color: #f5f7fa;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

.row {
  display: flex;
  flex-wrap: wrap;
}

.col-lg-3 { width: 25%; }
.col-lg-4 { width: 33.333%; }
.col-lg-6 { width: 50%; }
.col-lg-8 { width: 66.666%; }
.col-lg-12 { width: 100%; }

[class*="col-"] {
  padding: 0 15px;
}

/* Header Top Area */
.header-top-area {
  background: #002147;
  padding: 8px 0;
}

.header-top-left ul, .header-top-right ul {
  list-style: none;
  display: flex;
  gap: 20px;
  margin: 0;
  padding: 0;
}

.header-top-left ul li {
  color: #fff;
  font-size: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.header-top-left ul li i {
  color: #f39c12;
}

/* Header Mid Area */
.header-mid-area {
  background: #002147;
  padding: 5px;
  border-bottom: 1px solid #002147;
}

.logo-area h1 {
  margin: 0;
  line-height: 1.2;
}

.univ-name {
  display: block;
  font-size: 28px;
  font-weight: 700;
  color: #ffffff;
  letter-spacing: 2px;
}

.univ-sub {
  display: block;
  font-size: 14px;
  font-weight: 400;
  color: #ffffff;
  letter-spacing: 1px;
}

.univ-admission {
  display: block;
  font-size: 12px;
  font-weight: 500;
  color: #f39c12;
  letter-spacing: 1px;
  margin-top: 3px;
}

/* Main Menu Area */
.main-menu-area {
  background: #002147;
  border-top: 1px solid #002147;
  border-bottom: 1px solid #002147;
}

.main-menu-area nav ul {
  list-style: none;
  display: flex;
  gap: 35px;
  margin: 0;
  padding: 0;
}

.main-menu-area nav ul li a {
  text-decoration: none;
  color: #ffffff;
  font-weight: 600;
  font-size: 14px;
  text-transform: uppercase;
  display: inline-block;
  padding: 15px;
  transition: 0.3s;
}

.main-menu-area nav ul li a:hover {
  color: #f39c12;
}

.main-menu-area nav ul li.apply-btn a {
  background: #002147;
  color: #fff;
  padding: 8px 20px;
  border-radius: 5px;
  margin-top: 5px;
}

.main-menu-area nav ul li.apply-btn a:hover {
  background: #f39c12;
}

/* Footer */
footer {
  margin-top: 60px;
}

.footer-area-top {
  background: #002147;
  padding: 50px 0 30px;
}

.footer-box h3 {
  color: #fff;
  font-size: 18px;
  margin-bottom: 20px;
  position: relative;
  padding-bottom: 10px;
}

.footer-box h3:after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 40px;
  height: 2px;
  background: #f39c12;
}

.footer-box p, .footer-box ul li {
  color: #ccc;
  font-size: 13px;
  line-height: 1.8;
}

.footer-box ul {
  list-style: none;
  padding: 0;
}

.footer-box ul li a {
  color: #ccc;
  text-decoration: none;
  transition: 0.3s;
}

.footer-box ul li a:hover {
  color: #f39c12;
  padding-left: 5px;
}

.footer-box .contact-list li {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 10px;
}

.footer-box .contact-list li i {
  color: #f39c12;
  width: 20px;
}

.footer-area-bottom {
  background: #001a33;
  padding: 15px 0;
  text-align: center;
}

.footer-area-bottom p {
  color: #fff;
  margin: 0;
  font-size: 12px;
}

/* Responsive */
@media (max-width: 768px) {
  .col-lg-3, .col-lg-4, .col-lg-6, .col-lg-8 {
    width: 100%;
    margin-bottom: 20px;
  }
  
  .header-top-left ul {
    justify-content: center;
  }
  
  .main-menu-area nav ul {
    flex-direction: column;
    gap: 0;
    text-align: center;
  }
  
  .main-menu-area nav ul li a {
    padding: 10px 0;
  }
}


.login-bar {
  background: #002147;
  padding: 12px 0;
}

.text-right {
  text-align: right;
}

.btn-login {
  background: #f39c12;
  color: #002147;
  padding: 8px 25px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 500;
  font-size: 14px;
  transition: 0.3s;
  display: inline-block;
}

.btn-login:hover {
  background: #000000;
  color: #ffffff;
}

</style>