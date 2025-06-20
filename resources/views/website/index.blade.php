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

    <link rel="stylesheet" href="{{ asset('assets/web_css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web_css/responsive.css') }}">

  </head>
  <body>
    
    @include('common.header')
    <!-- / Header -->

    <!-- banner -->
    <div class="owl-carousel owl-theme vertical-carousel">
      <div class="item">
        <div class="bg" style="background-image: url('web_img/banner1.jpg')">
          <div class="banner-content">
            <div class="container">
              <div class="banner-text">
                <h1>We Design for Living</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="bg" style="background-image: url('web_img/banner2.jpg')">
          <div class="banner-content">
            <div class="container">
              <div class="banner-text">
                <h1>We Build with Heart</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="bg" style="background-image: url('web_img/banner3.jpg')">
          <div class="banner-content">
            <div class="container">
              <div class="banner-text">
                <h1>We Care Beyond Walls</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- More slides -->
    </div>

    <!-- / banner -->
    <!-- about -->
    <section>
      <div class="about-qot d-flex justify-content-between flex-wrap">
        <div class="col-lg-6 col-12">
          <div class="about-left">
                       <div class="col-sm-6 col-12">
              <div class="box" style="background-color: #333">
                <div
                  class="image"
                  style="background-image: url('img/diamond.png')"
                >
                  <img src="img/icons/1.png" alt="" />
                </div>

                <h2>Design</h2>
                <p>Tomorrow’s Thinking</p>
                <div class="qot-btn">
                  <a href="design">
                    <span>Learn More</span>
                    <img src="img/right-arrow.png" alt="" />
                  </a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-12">
              <div class="box" style="background-color: #444">
                <div
                  class="image"
                  style="background-image: url('img/diamond.png')"
                >
                  <img src="img/icons/2.png" alt="" />
                </div>

                <h2>Construction</h2>
                <p>Masterminds of Space</p>
                <div class="qot-btn">
                  <a href="construction">
                    <span>Learn More</span>
                    <img src="img/right-arrow.png" alt="" />
                  </a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-12">
              <div class="box" style="background-color: #555">
                <div
                  class="image"
                  style="background-image: url('img/diamond.png')"
                >
                  <img src="img/icons/3.png" alt="" />
                </div>

                <h2>Interior</h2>
                <p>Crafted Spaces</p>
                <div class="qot-btn">
                  <a href="interior">
                    <span>Learn More</span>
                    <img src="img/right-arrow.png" alt="" />
                  </a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-12">
              <div class="box" style="background-color: #666">
                <div
                  class="image"
                  style="background-image: url('img/diamond.png')"
                >
                  <img src="img/icons/4.png" alt="" />
                </div>

                <h2>Maintenance</h2>
                <p>Complete Solutions</p>
                <div class="qot-btn">
                  <a href="maintenance">
                    <span>Learn More</span>
                    <img src="img/right-arrow.png" alt="" />
                  </a>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="experience">
            <img src="web_img/anniversary.png" alt="" />
            <p>Transforming Spaces with Style and Precision</p>
          </div>
        </div>
      </div>
    </section>
    <!-- / about -->

    <!-- process -->
    <section>
      <div class="process">
        <h2>From Vision to Reality</h2>
        <div class="container">
          <div class="progress-container">
            <div class="circle step-1">
              <img src="web_img/icons/5.png" alt="Design" />
              <div class="step-text">Connect</div>
            </div>
            <div class="circle step-2">
              <img src="web_img/icons/6.png" alt="Car" />
              <div class="step-text">Design</div>
            </div>
            <div class="circle step-3">
              <img src="web_img/icons/7.png" alt="Payment" />
              <div class="step-text">Build</div>
            </div>
            <div class="circle step-4">
              <img src="web_img/icons/8.png" alt="Done" />
              <div class="step-text">Live</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- portfolio -->

    <section>
      <div class="portfolio home-portfolio">
        <h2>Where Ideas Become Creations</h2>
        <div class="container">

          {{-- Tab buttons --}}
          <div class="project-filter-nav">
              @foreach($group_services as $index => $type)
                  <button class="filter-btn {{ $index === 0 ? 'active' : '' }}" data-filter="{{ Str::slug($type['tab_name']) }}">
                      {{ $type['tab_name'] }}
                  </button>
              @endforeach
          </div>

          {{-- Grid items --}}
          <div class="project-grid">
              @foreach($group_services as $key => $type)
                  @foreach($type['services'] as $item)
                       @if($type['type'] == 1)
                        <div class="project-item {{ Str::slug($type['tab_name']) }} {{ $key === 0 ? 'show' : '' }}"
                           style="background-image: url('{{ asset($item->image ? 'storage/projects/' . $item->image : 'web_img/banner1.jpg') }}')">
                           <?php
                              $slug = Str::slug($item->name);
                            ?>

                            <div class="project-hover-content">
                                <h3>{{ $item->name }}</h3>
                                <!-- <p>{{ $item->subtitle ?? 'Description' }}</p> -->
                              <a href="/project_details/{{$item->id}}/{{$slug}}">
                                <span>View Project</span>
                                <img src="web_img/right-arrow.png" alt="" />
                              </a>
                            </div>
                        </div>
                      @else
                        <div class="project-item {{ Str::slug($type['tab_name']) }} {{ $key === 0 ? 'show' : '' }}"
                           style="background-image: url('{{ asset($item->thumb ? 'storage/video_items/' . $item->thumb : 'web_img/banner1.jpg') }}')"
                           href="{{$item->link_path}}"
                            data-fancybox
                           >
                            <div class="project-hover-content">
                                <h3>Video </h3>
                            </div>
                              <div class="play-button">
                                  <img src="{{ asset('web_img/play.png') }}" alt="Play Video">
                              </div>
                        </div>
                      @endif
                  @endforeach
              @endforeach
          </div>
          <div
            class="qot-btn d-flex justify-content-center align-items-center mt-5"
          >
            <a href="/projects">
              <span>View All Projects</span>
              <img src="web_img/right-arrow.png" alt="" />
            </a>
          </div>
        </div>
        <div class="client-tele mt-5">
          <h2>You're with the best . . .</h2>
          <div class="marquee-wrapper">
            <div class="marquee-track" id="marqueeContent">
              <!-- Client Logos 1 to 11 -->
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/1.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/2.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/3.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/4.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/5.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/6.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/7.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/8.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/9.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/10.png" /></div>
              </div>
              <div class="client-block">
                <div class="ic-logo"><img src="web_img/clients/11.png" /></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- testimoial -->
    <section>
      <div class="testimonial">
        <div class="container">
          <h2>Real Stories. Real Results.</h2>
        </div>
        <div class="owl-carousel owl-theme slider3">
          @foreach($testimonials as $key=>$value)

          <div class="carousel">
            <div class="review">
              <div class="img">
                <img src="{{ $value->image ? asset('storage/testimonials/' . $value->image) : asset('web_img/icons/1.png') }}" alt="Icon" />
              </div>
              <h4>{{$value->name}}</h4>

              <p>
               {{$value->description}}
              </p>
            </div>
          </div>
          @endforeach
      </div>
    </section>
    <!-- / testimoial -->

    <!-- blog -->

    <section>
      <div class="home-blog">
        <div class="container">
          <h2>Blank walls. Brave ideas. Blog it.</h2>
          <div class="row">
            <div class="blog-sec d-flex flex-wrap">
            @foreach($blogs as $key=>$value)
              <div class="col-lg-4 col-12">
               <div class="block" style="background: url('{{ asset($value->image ? 'storage/blogs/' . $value->image : 'web_img/banner1.jpg') }}'); background-size: cover; background-position: center;">


                  <div class="content">
                    <span>{{ \Carbon\Carbon::parse($value->date)->format('F j, Y') }}</span>
                    <h3>
                     {{$value->heading}}
                    </h3>
                    <div class="blog-view d-flex justify-content-between align-items-center">
                      <div class="by-admin"> {{$value->user_name}}</div>
                      <div class="qot-btn">
                        <a href="blog_details/{{$value->slug}}">
                          <span>Learn More</span>
                          <img src="web_img/right-arrow.png" alt="" />
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
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
<div class="whatsapp">
         <div class="wave"></div>
         <a href="https://api.whatsapp.com/send?phone=919633680408" target="_blank"><img src="web_img/whatsapp.png">
         </a>
      </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
      const owl = $(".vertical-carousel");

      owl.owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        nav: false,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: false,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1000,
        onInitialized: function () {
          // Manually trigger for the first slide
          setTimeout(() => {
            $(".owl-item.active .banner-content").addClass("animate");
          }, 100);
        },
      });

      // Trigger on every slide change
      owl.on("changed.owl.carousel", function () {
        $(".banner-content").removeClass("animate");

        setTimeout(() => {
          $(".owl-item.active .banner-content").addClass("animate");
        }, 400); // Delay to allow DOM update
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const steps = document.querySelectorAll(".circle");

        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                steps.forEach((step) => {
                  step.classList.remove("animate"); // Reset
                  void step.offsetWidth; // Force reflow
                  step.classList.add("animate");
                });
              }
            });
          },
          {
            threshold: 0.6,
          }
        );

        const section = document.querySelector(".process");
        if (section) observer.observe(section);
      });
    </script>

    <!-- JS Filtering -->
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
        $(".slider3").owlCarousel({
          margin: 50,
          loop: true,
          center: true,
          autoplay: true,
          stagePadding: 300,
          autoplaySpeed: 2000,
          autoplayTimeout: 7000,
          autoplayHoverPause: false,
          items: 1,
          nav: false,
          dots: false,
          responsive: {
            0: {
              items: 1,
              stagePadding: 0,
            },
            600: {
              items: 1,
              stagePadding: 100,
            },
            1000: {
              items: 1,
              stagePadding: 150,
            },
            1400: {
              items: 1,
              stagePadding: 300,
            },
          },
        });
      });
    </script>

    <!-- menu -->
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
