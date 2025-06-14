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
      <div
        class="banner inner-banner"
        style="background: url(web_img/green-house/11.jpg)"
      >
        <h1>About Us</h1>
      </div>
    </section>

    <section>
      <div class="about-page">
        <div class="container">
          <div class="content">
            <h2>Our Story</h2>
            <p>
              At QOT Construction and Interiors, we are committed to delivering
              exceptional construction and interior solutions that blend
              innovation, functionality, and elegance. Based in Kochi, we have
              established a reputation for excellence in transforming both
              residential and commercial spaces across Kerala and Tamil Nadu.
              With a team of over 75 skilled professionals, we specialize in
              providing comprehensive services that include robust construction,
              innovative interior design, and seamless project execution
              tailored to each client’s vision. From crafting sturdy foundations
              to designing captivating interiors, our expertise spans corporate
              offices, retail outlets, premium homes, and more. Our advanced
              15,000 sq. ft. factory, equipped with automated carpentry
              machinery, ensures precision and quality in every project,
              offering competitive pricing without compromise. By integrating
              sustainable practices, superior craftsmanship, and
              forward-thinking designs, QOT Construction and Interiors is
              redefining industry standards and creating lasting spaces that
              inspire. We take pride in turning visions into reality, one
              project at a time.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="explore">
        <div class="container">
          <h2>EXPLORING</h2>
          <div class="ex-logo">
            <img src="web_img/logo.png" alt="" style="max-width: 150px" />
</div>
          </h1>
        </div>
        <div class="explore-block">
          <div class="container">
            <div class="explore-items d-flex flex-wrap">
              <div class="col-lg-3 col-6">
                <h3>10+</h3>
                <p>Team Engineers</p>
              </div>
              <div class="col-lg-3 col-6">
                <h3>100+</h3>
                <p>Satisfied Clients</p>
              </div>
              <div class="col-lg-3 col-6">
                <h3>100+</h3>
                <p>Project Completed</p>
              </div>
              <div class="col-lg-3 col-6">
                <h3>10+</h3>
                <p>Years of Experience</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="vision">
        <div class="container">
          <div class="info d-flex flex-wrap">
            <div class="col-lg-6">
              <div class="block a-top" style="background-color: #f1f1f1">
                <img src="web_img/vision.png" alt="" />
                <h2>Vision</h2>
                <p>
                  At QOT Engineering, collaboration and commitment are at the
                  core of everything we do. Our mission is to deliver
                  exceptional engineering and construction solutions that not
                  only reflect our clients' unique visions but also enhance the
                  functionality, durability, and harmony of the spaces we
                  create. We are dedicated to combining innovation, creativity,
                  and practicality to craft robust structures and thoughtful
                  designs. By making high-quality engineering accessible and
                  reliable, we aspire to positively impact the well-being and
                  satisfaction of the communities we serve.
                </p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="block" style="background-color: #f1f1f1">
                <img src="web_img/mision.png" alt="" />
                <h2 style="color: #333; text-shadow: none !important">
                  Mission
                </h2>
                <p style="color: #222; text-shadow: none !important">
                  QOT Engineering envisions crafting spaces that not only meet
                  but exceed client expectations, setting new benchmarks in
                  engineering and construction. With a team of 75+ skilled
                  professionals, we leverage emerging technologies, sustainable
                  practices, and innovative techniques to deliver robust,
                  functional, and enduring structures. Our 15,000 sq. ft.
                  factory, equipped with advanced machinery, ensures precision,
                  quality, and cost-effective solutions for every project. We
                  strive to stay ahead of industry trends, positioning ourselves
                  as leaders in shaping the future of engineering and
                  construction. At QOT Engineering, we are dedicated to creating
                  spaces that inspire and stand the test of time.
                </p>
              </div>
            </div>
          </div>
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

    <!-- JS Filtering -->
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
