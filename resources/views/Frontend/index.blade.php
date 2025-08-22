<main class="main">
    <section id="hero" class="hero section light-background">
      <img src="{{asset('homeView/img/hero-bg.jpg')}}" alt="" data-aos="fade-in">
      <div class="container position-relative">
        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
          <h2 style="color: #00A8FF;">WELCOME TO Clinic Management</h2>
          <p>A modern website for managing medical clinic<br>and organizing appointments</p>
        </div>
        <div class="content row gy-4">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200" style="background-color:#00A8FF; ">
              <h3>Why Choose Clinics Management System?</h3>
              <p>
                Our platform makes it easy for patients to book appointments with top clinic and the most skilled doctors.
                It ensures fast access to quality healthcare, saving time and effort for every patient.
              </p>
              <div class="text-center">
                <a href="#about" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="d-flex flex-column justify-content-center">
              <div class="row gy-4">

                <!-- Box 1 -->
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                    <i class="bi bi-clipboard-data" style="color: #00A8FF"></i>
                    <h4 style="color: #00A8FF">Accurate Reports & Statistics</h4>
                    <p>Our system provides comprehensive reports and precise statistics to help management and doctors monitor performance and analyze patient data efficiently.</p>
                  </div>
                </div>

                <!-- Box 2 -->
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                    <i class="bi bi-gem" style="color: #00A8FF"></i>
                    <h4 style="color: #00A8FF">High-Quality Services</h4>
                    <p>We deliver a unique experience in clinic management with an intuitive interface, integrated electronic services, and high accuracy in handling medical records.</p>
                  </div>
                </div>

                <!-- Box 3 -->
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                    <i class="bi bi-inboxes" style="color: #00A8FF"></i>
                    <h4 style="color: #00A8FF">Secure Digital Archiving</h4>
                    <p>Every medical file is stored and archived securely, with quick access and full integration across all clinic departments to ensure accurate patient follow-up.</p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container">
        <div class="row gy-4 gx-5">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
            <img src="{{asset('homeView/img/about.jpg')}}" class="img-fluid" alt="">
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
          </div>
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <h3>About Us</h3>
            <p>
              We provide advanced clinic management solutions that simplify operations and enhance patient care.
            </p>
            <ul>
              <li>
                <i class="fa-solid fa-vial-circle-check"></i>
                <div>
                  <h5>Smart Appointment System</h5>
                  <p>Efficient scheduling with minimal waiting time.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-pump-medical"></i>
                <div>
                  <h5>Integrated Medical Records</h5>
                  <p>Secure and accessible patient history anytime.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-heart-circle-xmark"></i>
                <div>
                  <h5>Advanced Reporting Tools</h5>
                  <p>Track performance and improve decision-making.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fas fa-stethoscope"></i>
            <div class="stats-item">
              <span>{{ $department_count }}</span>
              <p>Departments</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-solid fa-user"></i>
            <div class="stats-item">
              <span>{{ $employee_count }}</span>
              <p>Employees</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-solid fa-user-doctor"></i>
            <div class="stats-item">
              <span>{{ $doctor_count }}</span>
              <p>Doctors</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fas fa-user-injured"></i>
            <div class="stats-item">
              <span>{{ $patient_count }}</span>
              <p>Patients</p>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Services Section -->
    <section id="services" class="services section">
        <div class="container section-title" data-aos="fade-up">
          <h2 style="color: #00A8FF">Services</h2>
          <p>Modern tools to run your clinic smoothly—secure, organized, and patient-focused.</p>
        </div>

        <div class="container">
          <div class="row gy-4">

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="service-item position-relative">
                <div class="icon" style="background-color: #00A8FF">
                  <i class="fas fa-heartbeat"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3 style="color: #00A8FF">Appointments & Vitals</h3>
                </a>
                <p>Book visits, manage queues, and record key vitals (BP, heart rate, temperature) right at check-in.</p>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
              <div class="service-item position-relative">
                <div class="icon" style="background-color: #00A8FF">
                  <i class="fas fa-pills"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3 style="color: #00A8FF">Medication & Pharmacy</h3>
                </a>
                <p>E-prescriptions, stock tracking, dosage checks, and refill reminders—integrated with your pharmacy.</p>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="service-item position-relative">
                <div class="icon" style="background-color: #00A8FF">
                  <i class="fas fa-hospital-user"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3 style="color: #00A8FF">Patient Profiles</h3>
                </a>
                <p>Secure registration with demographics, allergies, and visit history—everything in one smart chart.</p>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
              <div class="service-item position-relative">
                <div class="icon" style="background-color: #00A8FF">
                  <i class="fas fa-dna"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3 style="color: #00A8FF">Lab & Diagnostics</h3>
                </a>
                <p>Order tests, receive verified results, and attach imaging reports—auto-synced to the patient record.</p>
                <a href="#" class="stretched-link"></a>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
              <div class="service-item position-relative">
                <div class="icon" style="background-color: #00A8FF">
                  <i class="fas fa-wheelchair"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3 style="color: #00A8FF">Rehabilitation & Accessibility</h3>
                </a>
                <p>Schedule physio sessions, track progress notes, and streamline wheelchair-friendly workflows.</p>
                <a href="#" class="stretched-link"></a>
              </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
              <div class="service-item position-relative">
                <div class="icon" style="background-color: #00A8FF">
                  <i class="fas fa-notes-medical"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3 style="color: #00A8FF">EMR & Clinical Notes</h3>
                </a>
                <p>Structured SOAP notes, templates, and exportable reports with secure sharing when authorized.</p>
                <a href="#" class="stretched-link"></a>
              </div>
            </div><!-- End Service Item -->

          </div>
        </div>
      </section>


    <!-- Departments Section -->
    <section id="departments" class="Departments section">
      <div class="container section-title" data-aos="fade-up">
        <h2 style="color: #00A8FF">Departments</h2>
        <p>A Wide Range Of Medical Departments To Meet All Your Healthcare Needs</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-3" style="max-height: 500px; overflow-y: auto;">
                <ul class="nav nav-tabs flex-column">
                  @foreach ($departments as $index => $department)
                    <li class="nav-item">
                      <a class="nav-link {{ $index === 0 ? 'active show' : '' }}"
                         data-bs-toggle="tab"
                         href="#department-{{ $department->id }}">
                        {{ $department->name }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
              <div class="mt-4 col-lg-9 mt-lg-0">
                <div class="tab-content">
                  @foreach ($departments as $index => $department)
                    <div class="tab-pane fade {{ $index === 0 ? 'active show' : '' }}" id="department-{{ $department->id }}">
                      <div class="row">
                        <div class="order-2 col-lg-8 details order-lg-1">
                          <h3>{{ $department->name }}</h3>
                          <p>{{ $department->description }}</p>
                        </div>
                        <div class="order-1 text-center col-lg-4 order-lg-2">
                          {{-- <img src="{{ asset('uploads/departments/' . $department->image) }}" alt="" class="img-fluid"> --}}
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
        </div>
    </section>


    <section id="doctors" class="doctors section">
      <div class="container section-title" data-aos="fade-up">
        <h2 style="color: #00A8FF">Doctors</h2>
        <p>Meet our expert doctors ready to care for your health</p>
      </div>

      <div class="container">
        <div class="row gy-4">
            @foreach ($doctors as $doctor)
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member d-flex align-items-start">
                    <div class="pic"><img src="{{ asset($doctor->employee->user->image) }}" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>{{ $doctor->employee->user->name }}</h4>
                        <span>{{ $doctor->employee->department->name }}</span>
                        <p>{{ $doctor->employee->short_biography }}</p>
                        <div class="social">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""> <i class="bi bi-linkedin"></i> </a>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>

      </div>

    </section>

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">
        <div class="container section-title" data-aos="fade-up">
          <h2 style="color: #00A8FF;">Frequently Asked Questions</h2>
          <p>Find quick answers about booking, payments, and patient services at our clinic management system.</p>
        </div>

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
              <div class="faq-container">

                <div class="faq-item faq-active" style="background-color: #00A8FF;">
                  <h3>How can I book an appointment with a doctor?</h3>
                  <div class="faq-content">
                    <p>You can book an appointment directly through the online system by selecting the doctor, date, and time that suits you best. A confirmation message will be sent after booking.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div>

                <div class="faq-item">
                  <h3>Can I reschedule or cancel my appointment?</h3>
                  <div class="faq-content">
                    <p>Yes, appointments can be rescheduled or canceled from your patient dashboard up to 24 hours before the scheduled time.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div>

                <div class="faq-item">
                  <h3>Do you accept health insurance?</h3>
                  <div class="faq-content">
                    <p>Our clinic management system supports multiple insurance companies. You can check the list of supported insurances during registration or at the billing section.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div>

                <div class="faq-item">
                  <h3>How can I access my medical records?</h3>
                  <div class="faq-content">
                    <p>Patients can securely access their medical history, prescriptions, and lab results anytime through the patient portal after logging in.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div>

                <div class="faq-item">
                  <h3>What payment methods are available?</h3>
                  <div class="faq-content">
                    <p>We support cash, credit/debit cards, and online payments. Insurance billing is also automatically processed through the system if applicable.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><

                <div class="faq-item">
                  <h3>Is my data safe in the system?</h3>
                  <div class="faq-content">
                    <p>Yes, your personal and medical information is protected with advanced encryption and secure authentication methods according to healthcare privacy standards.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>



    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
            <h3>Patient Testimonials</h3>
            <p>
              This section showcases some of the feedback and experiences shared by patients who have used our platform to book appointments with doctors and subscribe to clinic.
              Their words reflect the quality of service and the ease of accessing medical care through our system.
            </p>
          </div>

          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

            <div class="swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>
              <div class="swiper-wrapper">

                {{-- @foreach ($patientsTestimonials as $patientsTestimonial)
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                        <div class="d-flex">
                            <img src="{{ asset($patientsTestimonial->patient->user->image) }}" class="flex-shrink-0 testimonial-img" alt="">
                            <div>
                            <h3>{{ $patientsTestimonial->patient->user->name }}</h3>
                            <span>{{ $patientsTestimonial->patient->user->address }}</span>

                            <div class="stars">
                                @php
                                    $rating = $patientsTestimonial->rating;
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                            </div>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ $patientsTestimonial->content }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                        </div>
                    </div>
                @endforeach --}}

              </div>
              <div class="swiper-pagination"></div>
            </div>

          </div>

        </div>

      </div>

    </section>


    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p>Explore our photo gallery to get a glimpse of our clinic, modern equipment</p>
      </div>
      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-0">
          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('homeView/img/gallery/gallery-1.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('homeView/img/gallery/gallery-1.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('homeView/img/gallery/gallery-2.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('homeView/img/gallery/gallery-2.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('homeView/img/gallery/gallery-3.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('homeView/img/gallery/gallery-3.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('homeView/img/gallery/gallery-4.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('homeView/img/gallery/gallery-4.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('homeView/img/gallery/gallery-5.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('homeView/img/gallery/gallery-5.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('homeView/img/gallery/gallery-6.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('homeView/img/gallery/gallery-6.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('homeView/img/gallery/gallery-7.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('homeView/img/gallery/gallery-7.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('homeView/img/gallery/gallery-8.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('homeView/img/gallery/gallery-8.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>

      </div>

    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Have a question or need assistance? We’re here to help — get in touch with us anytime</p>
      </div>
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="flex-shrink-0 bi bi-geo-alt"></i>
              <div>
                <h3>Address</h3>
                <p>{{ $admin->address }}</p>
              </div>
            </div>

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="flex-shrink-0 bi bi-telephone"></i>
              <div>
                <h3>Call Us</h3>
                <p>{{ $admin->phone }}</p>
              </div>
            </div>

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="flex-shrink-0 bi bi-envelope"></i>
              <div>
                <h3>Email Us</h3>
                <p>{{ $admin->email }}</p>
              </div>
            </div>

          </div>

          <div class="col-lg-8">
            <form action="{{ route('contact_send') }}" method="POST">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" id="name" name="name" class="form-control" placeholder="Your Name">
                </div>

                <div class="col-md-6 ">
                  <input type="email" id="email" class="form-control" name="email" placeholder="Your Email">
                </div>

                <div class="col-md-12">
                  <input type="text" id="subject" class="form-control" name="subject" placeholder="Subject">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" id="message" name="message" rows="6" placeholder="Message"></textarea>
                </div>

                <div class="text-center col-md-12">
                  <button type="submit" class="btn btn-primary submit-btn addBtn" style="background-color: #00A8FF;">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
</main>

@section('js')

<script>
    $('.addBtn').click(function (e) {
        e.preventDefault();

        let name = $('#name').val().trim();
        let email = $('#email').val().trim();
        let subject = $('#subject').val().trim();
        let message = $('#message').val();



        // إنشاء formData
        let formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('subject', subject);
        formData.append('message', message);

        if(name === '' || email === '' || subject === '' || message === ''){
            Swal.fire({
                title: 'Error!',
                text: 'Please Enter All Required Fields',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }else{
            $.ajax({
                method: 'POST',
                url: "{{ route('contact_send') }}",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.data == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: 'The Message Has Been Sent Successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/clinic-management/home';
                        });
                    }
                }
            });
        }
    });
</script>
@endsection
