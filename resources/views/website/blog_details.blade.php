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
            style="background: url(web_img/banner2.jpg)"
          ></div>

          <!-- Author and Date Row -->
          <div
            class="d-flex justify-content-between align-items-center blog-meta"
          >
            <div class="d-flex align-items-center gap-3">
              <div
                class="author-img-bg rounded-circle d-flex align-items-center justify-content-center"
              >
                <img src="web_img/favicon.png" alt="Author" />
              </div>
              <span>Admin</span>
            </div>
            <div class="text-muted d-flex align-items-center gap-2">
              <img src="web_img/calendar.png" alt="" />07 June 2025
            </div>
          </div>

          <!-- Blog Content -->
          <div class="blog-content mt-5">
            <h1>Understanding Aluminum Composite Panels (ACP)</h1>

            <h2>What Are Aluminum Composite Panels?</h2>
            <p>
              Aluminum Composite Panels (ACP) have transformed modern building
              design. These versatile materials combine visual appeal with
              practical performance advantages, making them increasingly popular
              for both new construction and renovation projects.
            </p>

            <h2>What Makes Up an ACP?</h2>
            <p>
              ACPs consist of two aluminum sheets bonded to a central core,
              typically measuring 3mm to 6mm thick. The aluminum sheets are
              thin—between 0.2mm to 0.5mm.
            </p>
            <ul>
              <li>
                Much lighter than solid aluminum while maintaining strength
              </li>
              <li>Available in many colors and finishes</li>
              <li>Resistant to weather damage and corrosion</li>
              <li>Can be cut, shaped, and installed using standard tools</li>
            </ul>

            <h2>Types of ACP Cores</h2>
            <ul class="mt-3">
              <li>
                <strong>Standard Polyethylene (PE):</strong> Cost-effective for
                interior or signage use; limited fire safety.
              </li>
              <li>
                <strong>Fire-Resistant (FR):</strong> Includes minerals for
                better fire performance; good for commercial buildings.
              </li>
              <li>
                <strong>A2 Non-Combustible:</strong> Premium mineral core
                offering top fire safety; ideal for hospitals, high-rises.
              </li>
              <li>
                <strong>Specialized Options:</strong> Includes honeycomb or
                sound-reducing cores for specific uses.
              </li>
            </ul>
            <div class="row g-3 my-4">
              <div class="col-md-6">
                <img
                  src="web_img/banner2.jpg"
                  alt="Extra Image 1"
                  class="img-fluid rounded"
                />
              </div>
              <div class="col-md-6">
                <img
                  src="web_img/banner2.jpg"
                  alt="Extra Image 2"
                  class="img-fluid rounded"
                />
              </div>
            </div>

            <h2>The ACP Manufacturing Process</h2>

            <h3 class="mt-3">1. Material Preparation</h3>
            <ul>
              <li>High-grade aluminum alloys in coils</li>
              <li>Polyethylene or mineral core preparation</li>
              <li>Specialized paints and coatings for finish</li>
            </ul>

            <h3>2. Aluminum Surface Treatment</h3>
            <ul>
              <li>Surface cleaning and chemical pre-treatment</li>
              <li>Primer coating for adhesion</li>
            </ul>

            <h3>3. Coating Application</h3>
            <ul>
              <li>High-performance weatherproof coatings</li>
              <li>
                Custom finishes: solid, metallic, wood grain, stone textures
              </li>
              <li>Thermal bonding and protective film application</li>
            </ul>

            <h3>4. Core Preparation</h3>
            <ul>
              <li>Extrusion or mixing with minerals</li>
              <li>Consistent thickness and quality monitoring</li>
            </ul>

            <h3>5. Panel Assembly</h3>
            <ul>
              <li>Automated bonding of aluminum to core</li>
              <li>Heat, pressure, and controlled cooling</li>
            </ul>

            <h3>6. Final Processing</h3>
            <ul>
              <li>Cutting to size, edge finishing</li>
              <li>Quality inspection and packaging</li>
            </ul>

            <h2>Quality Control Measures</h2>
            <ul class="mt-3">
              <li>Raw material testing</li>
              <li>In-process monitoring</li>
              <li>
                Bond strength, coating, weather, and fire resistance testing
              </li>
            </ul>

            <h2>ALFORCE Manufacturing</h2>
            <p>
              ALFORCE produces ACPs in an 80,000 sq. ft. facility with a
              capacity of 20 million sq. ft. annually. Their product lines
              include:
            </p>
            <ul>
              <li>Metallic Series</li>
              <li>Solid Series</li>
              <li>Glossy Series</li>
              <li>Brush Series</li>
              <li>Sparkle Series</li>
              <li>Mirror Series</li>
              <li>Marble Series</li>
              <li>Wooden Series</li>
            </ul>

            <h2>Future ACP Developments</h2>
            <ul class="mt-3">
              <li>Improved fire resistance with safer cores</li>
              <li>Energy-efficient, closed-loop manufacturing</li>
              <li>Advanced bonding to prevent delamination</li>
              <li>Automated defect detection for consistent quality</li>
            </ul>

            <h2>Selecting the Right ACP</h2>
            <ul class="mt-3">
              <li>
                <strong>Application Requirements:</strong> Choose based on
                interior/exterior use and traffic exposure.
              </li>
              <li>
                <strong>Local Environment:</strong> Use weather-appropriate
                panels for harsh conditions.
              </li>
              <li>
                <strong>Building Regulations:</strong> Confirm fire ratings and
                code compliance.
              </li>
              <li>
                <strong>Installation Methods:</strong> Match panel types to
                mounting systems.
              </li>
            </ul>

            <h2>Final Thoughts</h2>
            <p>
              ACPs represent a smart fusion of materials, design, and
              engineering. From raw material selection to rigorous quality
              checks, every step matters for longevity, safety, and visual
              appeal. As the industry evolves, expect more sustainable and
              high-performance ACPs shaping tomorrow's architecture.
            </p>
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
