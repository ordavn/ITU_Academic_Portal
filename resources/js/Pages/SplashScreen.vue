<template>
  <div class="splash-container">
    <div class="splash-content">
      <div class="logo-animation">
        <img src="\images\b2b9bfc0-4f92-491d-a1d0-2eeeacf6ceef.png" alt="In-Tech Logo" class="splash-logo">
        <div class="logo-text">
          <h1 class="univ-name">IN-TECH</h1>
          <p class="univ-tagline">University of Innovation & Technology</p>
        </div>
      </div>
      <div class="loading-bar">
        <div class="loading-progress"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SplashScreen',
  mounted() {
    // Disparaît après 2.5 secondes
    setTimeout(() => {
      this.$emit('splash-finished')
    }, 4500)
  }
}
</script>

<style scoped>
.splash-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('https://i.pinimg.com/originals/36/e4/d0/36e4d0b856694fc471344b644a1dd6e4.gif');
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  animation: fadeOut 0.5s ease-in-out 2s forwards;
}

.splash-content {
  text-align: center;
  animation: zoomIn 0.6s ease-out;
}

.logo-animation {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 5px;
}

.splash-logo {
  width: 300px;
  height: 500px;
  object-fit: contain;
  animation: pulse 1.5s ease-in-out infinite;
}

.logo-text {
  text-align: center;
}

.univ-name {
  font-size: 42px;
  font-weight: 800;
  color: #fff;
  letter-spacing: 4px;
  margin: 0;
  animation: slideInUp 0.5s ease-out;
}

.univ-tagline {
  font-size: 14px;
  color: #f39c12;
  margin-top: 10px;
  letter-spacing: 1px;
  animation: slideInUp 0.5s ease-out 0.1s both;
}

.loading-bar {
  width: 200px;
  height: 3px;
  background: rgba(255,255,255,0.2);
  border-radius: 3px;
  margin-top: 40px;
  overflow: hidden;
}

.loading-progress {
  width: 0%;
  height: 100%;
  background: #f39c12;
  border-radius: 3px;
  animation: loading 2s ease-out forwards;
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.08);
  }
}

@keyframes zoomIn {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes loading {
  0% {
    width: 0%;
  }
  50% {
    width: 70%;
  }
  100% {
    width: 100%;
  }
}

@keyframes fadeOut {
  to {
    opacity: 0;
    visibility: hidden;
  }
}
</style>