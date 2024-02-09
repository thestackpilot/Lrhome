@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp 

@extends('frontend.'.$active_theme -> theme_abrv.'.layouts.app')
@section('title','Our Purpose')
@section('content')
<div class="site-wrapper-reveal our-story">

    @include('frontend.'.$active_theme -> theme_abrv.'.components.header')

    <div class=" section-space--ptb_40">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-justify">
            <div class="section-title text-center" style="margin-bottom:10px">
              <h2 class="section-title--one section-title--center" style="position:relative; z-index:99;  margin-top: 20px;"> Vasudhaiva Kutumbakam</h2>
              <h3 style="font-size: 16px;margin-top: 12px;"> The World is a Family</h3>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-justify">
            <p> At LR Home, our core beliefs centre around the idea that serving society is not just our responsibility but our duty. As believers of Vasudhaiva Kutumbakam philosophy - The World is a Family, we strive to leave better communities than the ones we were born into and provide  a  brighter tomorrow for the generations to come. Giving back is deeply ingrained in all that we do. </p>
            <p>Our current philanthropic initiatives include academic scholarships, tutoring, accessible healthcare for low-income individuals, running a library, and other contributions to support our communities. As we grow, we vow to continue giving back locally and internationally.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="product-details-tab">
              <ul role="tablist" class="nav inner-tab-li">
                <li class="active" role="presentation"> <a data-toggle="tab" role="tab" href="#academy" class="active" aria-selected="true">Laddha Academy </a> </li>
                <li role="presentation"> <a data-toggle="tab" role="tab" href="#library" class="" aria-selected="false">Mirzapur Library </a> </li>
                <li role="presentation"> <a data-toggle="tab" role="tab" href="#hospital" class="" aria-selected="false">Hospital</a> </li>
                <!-- <li role="presentation"> <a data-toggle="tab" role="tab" href="#csr" class="" aria-selected="false">CSR </a> </li>-->
              </ul>
            </div>
          </div>
          <div class="col-12">
            <div class="product_details_tab_content tab-content mt-10 four-tab-main">
              <div class="product_tab_content tab-pane active" id="academy" role="tabpanel">
                <div class="product_description_wrap">
                  <div class="product-details-wrap">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="section-title text-center">
                          <h2 class="section-title--one section-title--center">Creating a Wiser Tomorrow &amp;<br>
                            Breaking the Cycle of Poverty Through Education </h2>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="owl-carousel owl-theme">
                          
                          <div class="item"><img src="https://lrhome.us/media/images/Laddha-Academ-1.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Laddha-Academ-2.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Laddha-Academ-3.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Laddha-Academ-4.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Laddha-Academ-5.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Laddha-Academ-6.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Laddha-Academ-7.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Laddha-Academ-8.jpg" class="img-fluid" alt=""></div>
                        </div>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col-lg-12">
                        <div class="details mt-30 text-justify">
                          <p>With a mission to develop and inspire change in the next generation, The Laddha Academy was founded in Mirzapur, Uttar Pradesh, India. VinamraLaddha’s goal was to break the cycle of poverty through continued education and create the next generation of leaders. The academy provides extracurricular educational through tutoring, leadership development, scholarships, and counselling. </p>
                          <p>Starting with 4 students, the program has grown to support & mentor more than 50 students today. We believe in gender equality & hence have ensured that girls, who are traditionally left out of many programs, have an equal opportunity to learn and grow alongside boys. Through leadership training, the students act as mentors to the next generation of students and create mutually beneficial relationships. This connection between leadership and education is a core function of the program in its entirety. </p>
                          <p>Working closely with the parents, students, teachers, and community members, The Laddha Academy supports and provides a solution for the challenges that arise with education gaps, community development, and financial needs. From education to extra-curricular activities, this organization is a support structure for students from pre-K to middle school with plans of expansion to continue mentoring the first generation of participants. </p>
                          <p>The Laddha Academy currently supports 50+ students, but the goal is to continue growing and creating an organization that supports over 100 students with expansions into high school and college aid. </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="product_tab_content tab-pane" id="library" role="tabpanel">
                <div class="product_description_wrap">
                  <div class="product-details-wrap">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="section-title text-center">
                          <h2 class="section-title--one section-title--center">Knowledge is Power </h2>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="owl-carousel owl-theme">
                          <div class="item"><img src="https://lrhome.us/media/images/Library-1.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Library-2.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Library-3.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Library-4.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/Library-5.jpg" class="img-fluid" alt=""></div>
                        </div>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col-lg-12">
                        <div class="details mt-30 text-justify">
                          <p> On the banks of the River Ganga in Mirzapur, India sits the Lala Lajpat Rai Memorial Library; the only library in the area. Vinamra Laddha, with an intimate knowledge of the US and Indian education system, came across this deserted place of learning and felt a sense of responsibility to restore the landmark. He set out to transform this space for the members of the Mirzapur community by cleaning, repairing, and restoring the library to make it a suitable place for learning. Part of this transformation included Vinamra working closely with the librarian and students to understand how to best meet the needs of the community. After three months of dedication, the library was opened for all the people of Mirzapur. </p>
                          <p>For more than 7 years now, this library has been maintained with books – both old and new, 24/7 power supply with air conditioning and electricity, a peaceful quiet environment for studyingand is serves as a center for education, activitiesand community participation. The ongoing upgrades include cataloging all the books, a computer lab with internet access and community engagement programs such as group yoga, quiz bowl contests, art classesand study groups for entrance examinations. </p>
                          <p>The library currently has a rich database of over 35,000 books in English, Hindi, Sanskrit, Bangla and Urdu. It more than 100 individuals per day. The future pipeline include as envisioned by Vinamra and his team at LR Home, includes addition of more engaging activities such as trivia nights, spelling bees and educational seminars. </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="product_tab_content tab-pane" id="hospital" role="tabpanel">
                <div class="product_description_wrap">
                  <div class="product-details-wrap">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="section-title text-center">
                          <h2 class="section-title--one section-title--center">Health is Wealth </h2>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="owl-carousel owl-theme">
                          <div class="item"><img src="https://lrhome.us/media/images/hos-2.jpg" class="img-fluid" alt=""></div>
                          <!--<div class="item"><img src="https://lrhome.us/https://lrhome.us/media/images/hos-3.jpg" class="img-fluid" alt=""></div>-->
                          <div class="item"><img src="https://lrhome.us/media/images/hos-4.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/hos-5.jpg" class="img-fluid" alt=""></div>
                          <div class="item"><img src="https://lrhome.us/media/images/hos-6.jpg" class="img-fluid" alt=""></div>
                        </div>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col-lg-12">
                        <div class="details mt-30 text-justify">
                          <p> Krishna and Rajani Laddha firmly believe that access to quality healthcare is a universal human right. Intheirjourney from Mirzapur to Georgia, theyrealizedthe glaring need for basic healthcare systems, especially for the underprivileged members of society. It became their mission to provide low-income communities access to early detection healthcare services to reduce future health complications. </p>
                          <p>To transform this mission into a reality, Shri Krishna Laddha has funded a hospital with a basic diagnostic facility to provide regular checkups to the underserved community members in Mirzapur. This has helped the local population to get access to basic treatment & surgical facility without the need to travel to distant cities.</p>
                          <p>With a constant desire to grow and expand, the hospital aims to provide the facility for ECG/EKG, defibrillators, MRI and another basic armamentarium soon. Currently, in the wake of the pandemic, the unit has been converted into a Covid-19 carefacility, otherwise they would have to be transported to other cities for admission & care.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <style>
        .grid-item {
            width: 25%;
        }
    
        .grid-item--width2 {
            width: 50%;
        }
    </style>
    
    
    <script>
    $('.owl-carousel').owlCarousel({
      loop:true,
    autoplay:true,
      margin:10,
      nav:true,
    dots: false,
    navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:3
          }
      }
    })
    </script> 
    <script>
    $('#owl-1,#owl-2,#owl-3').owlCarousel({
      loop:false,
      margin:10,
      nav:true,
    pagination: false,
    dots: false,
      responsive:{
          0:{
              items:4
          },
          600:{
              items:4
          },
          1000:{
              items:4
          }
      }
    })
    </script> 
    <script>
    $('.carousel').carousel({
    interval: false,
    });
    </script> 
    <script>	
    $('[id^=carousel-selector-]').hover(function() {
      var id_selector = $(this).attr("id");
      var id = id_selector.substr(id_selector.length - 1);
      id = parseInt(id);
      $('#myCarousel-1').carousel(id - 1);
      $('[id^=carousel-selector-]').removeClass('selected');
      $(this).addClass('selected');
    });
    </script> 
    <script>	
    $('[id^=carousel-selector2-]').hover(function() {
      var id_selector = $(this).attr("id");
      var id = id_selector.substr(id_selector.length - 1);
      id = parseInt(id);
      $('#myCarousel-2').carousel(id - 1);
      $('[id^=carousel-selector2-]').removeClass('selected');
      $(this).addClass('selected');
    });
    </script> 
    <script>	
    $('[id^=carousel-selector3-]').hover(function() {
      var id_selector = $(this).attr("id");
      var id = id_selector.substr(id_selector.length - 1);
      id = parseInt(id);
      $('#myCarousel-3').carousel(id - 1);
      $('[id^=carousel-selector3-]').removeClass('selected');
      $(this).addClass('selected');
    });
    </script> 
    <script>	
    $('[id^=carousel-selector4-]').hover(function() {
      var id_selector = $(this).attr("id");
      var id = id_selector.substr(id_selector.length - 1);
      id = parseInt(id);
      $('#myCarousel-4').carousel(id - 1);
      $('[id^=carousel-selector4-]').removeClass('selected');
      $(this).addClass('selected');
    });
    </script> 
    <script>	
    $('[id^=carousel-selector5-]').hover(function() {
      var id_selector = $(this).attr("id");
      var id = id_selector.substr(id_selector.length - 1);
      id = parseInt(id);
      $('#myCarousel-5').carousel(id - 1);
      $('[id^=carousel-selector5-]').removeClass('selected');
      $(this).addClass('selected');
    });
    </script> 
    <script>	
    $('[id^=carousel-selector6-]').hover(function() {
      var id_selector = $(this).attr("id");
      var id = id_selector.substr(id_selector.length - 1);
      id = parseInt(id);
      $('#myCarousel-6').carousel(id - 1);
      $('[id^=carousel-selector6-]').removeClass('selected');
      $(this).addClass('selected');
    });
    </script> 

    @include('frontend.'.$active_theme -> theme_abrv.'.components.footer')

  </div>    

@endsection
