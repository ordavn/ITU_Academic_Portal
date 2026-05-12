<template>
  <div>

    <div class="inner-page-banner-area" style="background: url('https://media.giphy.com/headers/washugifs/XImgIthF6Yf9.gif'); background-size: cover; background-position: center; padding: 120px 0; text-align: center; position: relative;">
      <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,33,71,0.6);"></div>
      <div class="container" style="position: relative; z-index: 2;">
        <div class="pagination-area">
          <h1 style="color: #fff; margin: 0; font-size: 48px;">Welcome to In-Tech University</h1>
          <p style="color: #fff; margin-top: 15px; font-size: 20px;">Your Gateway to Academic Excellence</p>
        </div>
      </div>
    </div>



    <div class="stats-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="stat-box">
              <i class="fas fa-users"></i>
              <h3>15,000+</h3>
              <p>Students</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-box">
              <i class="fas fa-chalkboard-user"></i>
              <h3>800+</h3>
              <p>Faculty Members</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-box">
              <i class="fas fa-handshake"></i>
              <h3>30+</h3>
              <p>Partners</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-box">
              <i class="fas fa-graduation-cap"></i>
              <h3>5,000+</h3>
              <p>Alumni</p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="container" style="margin-top: 60px;">
      <h2 style="color: #002147; text-align: center; margin-bottom: 40px;">Campus Gallery</h2>
      <div class="slideshow-container">
        <div v-for="(image, index) in galleryImages" :key="index" class="slide" :style="{ display: currentSlide === index ? 'block' : 'none' }">
          <img :src="image.url" :alt="image.caption">
          <div class="caption">{{ image.caption }}</div>
        </div>
        <button class="prev" @click="prevSlide">❮</button>
        <button class="next" @click="nextSlide">❯</button>
      </div>
      <div class="dots">
        <span v-for="(image, index) in galleryImages" :key="index" class="dot" :class="{ active: currentSlide === index }" @click="currentSlide = index"></span>
      </div>
    </div>


    <div class="news-area">
      <div class="container">
        <h2 style="color: #002147; text-align: center; margin-bottom: 40px;">Latest News & Collaborations</h2>
        <div class="row">
          <div v-for="news in newsList" :key="news.id" class="col-lg-4 col-md-6">
            <div class="news-card">
              <div class="news-image">
                <img :src="news.image" :alt="news.title">
                <div class="news-date-badge">{{ news.date }}</div>
              </div>
              <div class="news-content">
                <h3>{{ news.title }}</h3>
                <p>{{ news.description }}</p>
                <span class="news-type" :class="news.typeClass">{{ news.type }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="container" style="margin-top: 60px; margin-bottom: 60px;">
      <h2 style="color: #002147; text-align: center; margin-bottom: 40px;">Academic Portal</h2>
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-calendar-alt"></i></div>
            <h3>Events</h3>
            <p>Discover upcoming events, summer courses, and academic gatherings at In-Tech University.</p>
          <Link href="/events" class="service-btn-readonly">View Events →</Link>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-book"></i></div>
            <h3>Library</h3>
            <p>Access our digital library, books, journals, and research materials online.</p>
            <Link href="/library" class="service-btn-readonly">View Library →</Link>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-building"></i></div>
            <h3>Facilities</h3>
            <p>Explore our campus facilities, labs, classrooms, and amenities.</p>
          <Link href="/facilities" class="service-btn-readonly">View Facilities →</Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
  name: 'Home',
  components: {
    Link
  },
  data() {
    return {
      currentSlide: 0,
      galleryImages: [
        { url: 'https://images.unsplash.com/photo-1641160616553-a9d21a846e49?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y29sbGVnZSUyMGJ1aWxkaW5nfGVufDB8fDB8fHww', caption: 'Main Campus Building' },
        { url: 'https://www.retail-officespace.com/wp-content/uploads/2025/09/40-Rector-St-2-1170x785.jpg', caption: 'Rector Building' },
        { url: 'https://www.stthomas.edu/_media-library/_images/admissions-aid/1200x800/international-student-flags.jpg', caption: 'International Student Gathering' }
      ],
      newsList: [
        {
          id: 1,
          date: 'April 20, 2026',
          title: 'Collaboration Agreement with UTM Malaysia',
          description: 'In-Tech University signed a MoU with Universiti Teknologi Malaysia for student exchange and joint research programs.',
          type: 'Collaboration',
          typeClass: 'type-collab',
          image: 'https://img.freepik.com/free-photo/group-collaboration-around-laptop-creative-workspace_24972-2944.jpg?semt=ais_hybrid&w=740&q=80'
        },
        {
          id: 2,
          date: 'April 15, 2026',
          title: 'International Summit on Digital Innovation',
          description: 'The university hosted a global summit bringing together 200+ participants from 15 countries.',
          type: 'Event',
          typeClass: 'type-event',
          image: 'https://digitransformationsummit.com/indonesia/wp-content/uploads/2023/06/maximized-roi-649a8453a62c5.webp'
        },
        {
          id: 3,
          date: 'April 10, 2026',
          title: 'Partnership with National University of Singapore',
          description: 'New collaboration agreement focuses on AI research and faculty development programs.',
          type: 'Agreement',
          typeClass: 'type-agree',
          image: 'https://www.hku.hk/f/news/18215/900p600/DSC_1653.JPG'
        },
        {
          id: 4,
          date: 'April 5, 2026',
          title: 'Research Grant from Ministry of Education',
          description: 'In-Tech University awarded $2M research grant for renewable energy project.',
          type: 'Achievement',
          typeClass: 'type-achievement',
          image: 'https://koreajoongangdaily.joins.com/data/photo/2024/12/19/0df48522-9d58-4b23-aef8-a029d03d8d09.jpg'
        }
      ]
    }
  },
  mounted() {
    this.startAutoSlide()
  },
  methods: {
    startAutoSlide() {
      setInterval(() => {
        this.nextSlide()
      }, 4000)
    },
    nextSlide() {
      this.currentSlide = (this.currentSlide + 1) % this.galleryImages.length
    },
    prevSlide() {
      this.currentSlide = (this.currentSlide - 1 + this.galleryImages.length) % this.galleryImages.length
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

.col-lg-3 { width: 25%; }
.col-lg-4 { width: 33.333%; }
.col-md-6 { width: 50%; }
.col-sm-12 { width: 100%; }


/* Stats Area */
.stats-area {
  background: #002147;
  padding: 50px 0;
  margin-top: -5px;
}

.stat-box {
  text-align: center;
  color: #fff;
}

.stat-box i {
  font-size: 40px;
  color: #f39c12;
  margin-bottom: 15px;
}

.stat-box h3 {
  font-size: 32px;
  margin-bottom: 5px;
}

.stat-box p {
  font-size: 14px;
  opacity: 0.8;
}

/* Slideshow */
.slideshow-container {
  position: relative;
  max-width: 1000px;
  margin: auto;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 5px 25px rgba(0,0,0,0.1);
}

.slide img {
  width: 100%;
  height: 450px;
  object-fit: cover;
}

.caption {
  position: absolute;
  bottom: 20px;
  left: 20px;
  background: rgba(0,0,0,0.7);
  color: #fff;
  padding: 8px 20px;
  border-radius: 5px;
  font-size: 14px;
}

.prev, .next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0,0,0,0.5);
  color: white;
  border: none;
  padding: 15px 20px;
  cursor: pointer;
  font-size: 18px;
  transition: 0.3s;
}

.prev:hover, .next:hover {
  background: #f39c12;
}

.prev { left: 10px; }
.next { right: 10px; }

.dots {
  text-align: center;
  margin-top: 20px;
}

.dot {
  display: inline-block;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: #ccc;
  margin: 0 5px;
  cursor: pointer;
  transition: 0.3s;
}

.dot.active {
  background: #002147;
  width: 30px;
  border-radius: 10px;
}

/* News Area */
.news-area {
  background: #f8f9fa;
  padding: 60px 0;
  margin-top: 60px;
}

.news-card {
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 30px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
  transition: 0.3s;
  height: 100%;
}

.news-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.news-image {
  position: relative;
  height: 200px;
  overflow: hidden;
}

.news-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: 0.3s;
}

.news-card:hover .news-image img {
  transform: scale(1.05);
}

.news-date-badge {
  position: absolute;
  top: 15px;
  right: 15px;
  background: #f39c12;
  color: #002147;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: bold;
}

.news-content {
  padding: 20px;
}

.news-content h3 {
  color: #002147;
  font-size: 1.2rem;
  margin-bottom: 12px;
}

.news-content p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 15px;
}

.news-type {
  display: inline-block;
  padding: 5px 15px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 600;
}

.type-collab {
  background: #002147;
  color: #fff;
}

.type-event {
  background: #f39c12;
  color: #002147;
}

.type-agree {
  background: #17a2b8;
  color: #fff;
}

.type-achievement {
  background: #28a745;
  color: #fff;
}

/* Service Cards (Read Only Version) */
.service-card {
  background: #fff;
  border-radius: 10px;
  padding: 40px 25px;
  text-align: center;
  transition: all 0.3s ease;
  box-shadow: 0 5px 20px rgba(0,0,0,0.08);
  margin-bottom: 30px;
  height: 100%;
}

.service-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}

.service-icon {
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

.service-card:hover .service-icon {
  background: #f39c12;
}

.service-icon i {
  font-size: 35px;
  color: #fff;
}

.service-card h3 {
  font-size: 1.5rem;
  font-weight: 600;
  color: #002147;
  margin-bottom: 15px;
}

.service-card p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 25px;
}

.service-btn-readonly {
  display: inline-block;
  background: #6c757d;
  color: #fff;
  padding: 10px 25px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s;
}

.service-btn-readonly:hover {
  background: #5a6268;
  color: #fff;
}

@media (max-width: 768px) {
  .col-lg-3, .col-lg-4, .col-md-6 {
    width: 100%;
  }
  
  .text-right {
    text-align: center;
    margin-bottom: 15px;
  }
  
  .slide img {
    height: 250px;
  }
  
  .service-card {
    margin-bottom: 30px;
  }
  
  .news-image {
    height: 180px;
  }
}
</style>