gsap.registerPlugin(ScrollTrigger);

let tl = gsap.timeline({
  scrollTrigger: {
    trigger: ".hero-section",
    start: "top top",
    end: "+=200%",
    scrub: true,
    pin: true,
  }
});

// اخفاء اللوجو
tl.to(".banner-logo", {
  opacity: 0,
  scale: 0.8,
  duration: 0.4
})

// اظهار الكاروسيل
.to(".carousel-info", {
  opacity: 1,
  scale:1,
  duration: 1
}, "-=0.1");

gsap.fromTo(".home header",
  { opacity: 0 },
  {
    opacity: 1,
    scrollTrigger: {
      trigger: "body",
      start: "top top",
      end: "+=250",   // المسافة اللي يتم فيها الظهور
      scrub: true
    }
  }
);

gsap.fromTo(".projects-h",
  { scale: 0.9 },
  {
    scale: 1,
    ease: "none",
    scrollTrigger: {
      trigger: ".projects-h",
      start: "top 75%",   // لما السكشن يوصل لربع الشاشة تقريبًا
      end: "top 30%",     // يكمل التكبير
      scrub: true
    }
  }
);


