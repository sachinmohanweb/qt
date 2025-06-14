<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <title>Qot Interiors</title>
      <link
         href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
         rel="stylesheet"
         integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
         crossorigin="anonymous"
         />
      <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
         />
      <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
         />
      <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
         />
      <link
         rel="stylesheet"
         href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"
         />
     <link rel="stylesheet" href="{{ asset('assets/web_css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/web_css/responsive.css') }}">

  </head>
  <body>
    
    @include('common.header')
      <!-- / Header -->
      <section>
         <div
            class="banner inner-banner"
            style="background: url(web_img/h3.jpg)"
            >
            <h1>Interior</h1>
         </div>
      </section>
      <section>
      <div class="design-sec">
         <div class="container">
            <div class="design-content">
               <p>QOT Constructions offers professional interior design and décor services tailored to transform any space into a reflection of style, comfort, and functionality. Whether it's a home, office, retail outlet, or hospitality venue, our design approach blends creativity with practicality to bring your vision to life.

We specialize in designing and executing interiors for a wide range of spaces, including residences, villas, apartments, corporate offices, showrooms, boutiques, hotels, resorts, institutions, and recreational facilities.

Our team works closely with clients to understand their needs, preferences, and lifestyle, ensuring that every design is personalized and purposeful. From concept development to final execution, we manage every detail with precision.

Combining aesthetic appeal with smart use of space, QOT Constructions delivers interiors that are not only visually stunning but also efficient and enduring.</p>
            </div>
         </div>
      </div>
      <section>
         <div class="project-idea-sec">
            <div class="container">
               <div class="project-idea d-flex align-items-center flex-wrap">
                  <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                     <h3>Let’s turn your idea <br />into reality</h3>
                     <div class="info d-flex align-items-center mb-2">
                        <div class="info-img text-right">
                           <img src="web_img/call.webp" alt="" style="max-width: 35px" />
                        </div>
                        <a href="tel:+91 963 368 0408" target="_blank"
                           >+91 963 368 0408</a
                           >
                     </div>
                     <div
                        class="info d-flex align-items-center aos-init"
                        data-aos="fade-up-left"
                        >
                        <div class="info-img">
                           <img src="web_img/email.webp" alt="" />
                        </div>
                        <a href="mailto:consultant@qot.co.in" target="_blank"
                           >consultant@qot.co.in</a
                           >
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                     <div
                        class="get-a-enquiry mt-2 aos-init aos-animate"
                        data-aos="fade-up-right"
                        >
                        <a
                           href="https://api.whatsapp.com/send?phone=9633680408&text=Hello%20QOT%20Engineering!%20I%20am%20interested%20in%20your%20services."
                           class="btn"
                           target="_blank"
                           >
                           <span class="btn__circle"></span>
                           <span class="btn__white-circle">
                              <svg
                                 xmlns="http://www.w3.org/2000/svg"
                                 id="icon-arrow-right"
                                 viewBox="0 0 21 12"
                                 >
                                 <path
                                    d="M17.104 5.072l-4.138-4.014L14.056 0l6 5.82-6 5.82-1.09-1.057 4.138-4.014H0V5.072h17.104z"
                                    ></path>
                              </svg>
                           </span>
                           <span class="btn__text">Connect for us to support you</span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
@include('common.footer')
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
      <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
      <script>
         window.onload = function () {
           new Masonry(".grid", {
             itemSelector: ".grid-item",
             columnWidth: ".grid-sizer",
             percentPosition: true,
           });
         };
      </script>
      <script>
         const buttons = document.querySelectorAll(".filter-btn");
         const items = document.querySelectorAll(".project-item");
         
         buttons.forEach((button) => {
           button.addEventListener("click", () => {
             const category = button.getAttribute("data-filter");
         
             buttons.forEach((btn) => btn.classList.remove("active"));
             button.classList.add("active");
         
             items.forEach((item) => {
               item.classList.remove("show");
               if (item.classList.contains(category)) {
                 item.classList.add("show");
               }
             });
           });
         });
         
         // Initialize with default filter
         document.querySelector('[data-filter="residential"]').click();
      </script>
      <script>
         $(document).ready(function () {
           const $menuToggle = $(".hamburger-menu");
           const $navMenu = $(".navbar ul");
         
           $menuToggle.on("click", function () {
             $(this).toggleClass("open");
             $navMenu.toggleClass("show");
         
             // Optional: accessibility toggle (if you use ARIA)
             const isExpanded = $(this).attr("aria-expanded") === "true";
             $(this).attr("aria-expanded", !isExpanded);
           });
         });
      </script>
   </body>
</html>