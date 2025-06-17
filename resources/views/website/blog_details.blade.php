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

    <link rel="stylesheet" href="{{ asset('assets/web_css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web_css/responsive.css') }}">

  </head>
  <body>
    
    @include('common.header')
    <!-- / Header -->
    <section>
      <div class="blog-detail">
        <div class="container">
          <div
            class="blog-banner"
            style="background: url('{{ asset($blog->image ? 'storage/blogs/' . $blog->image : 'web_img/banner1.jpg') }}'); background-size: cover; background-position: center;"
          ></div>

          <!-- Author and Date Row -->
          <div
            class="d-flex justify-content-between align-items-center blog-meta"
          >
            <div class="d-flex align-items-center gap-3">
              <div
                class="author-img-bg rounded-circle d-flex align-items-center justify-content-center"
              >
                <img src="/web_img/favicon.png" alt="Author" />
              </div>
              <span>{{$blog->user_name}}</span>
            </div>
            <div class="text-muted d-flex align-items-center gap-2">
              <img src="web_img/calendar.png" alt="" />{{ \Carbon\Carbon::parse($blog->date)->format('F j, Y') }}
            </div>
          </div>

          <!-- Blog Content -->
          <div class="blog-content mt-5">
            {!! $blog->description !!}
          </div>

          <!-- Social Media Icons -->
        </div>
      </div>
    </section>

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
