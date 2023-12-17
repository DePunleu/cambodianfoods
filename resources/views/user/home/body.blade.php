
<!-- food section -->
<!-- Service Start -->
<div class="container-xxl py-5">
  <div class="container">
      <div class="row g-4">
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
              <div class="service-item rounded pt-3 ">
                  <div class="p-4 text-center">
                      {{-- <i class="fa fa-3x fa-user-tie text-warning mb-4"></i> --}}
                      <img class="mb-4" src="frontend/images/salads.png" alt="">
                      <h5>100% Fresh</h5>
                      
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
              <div class="service-item rounded pt-3">
                  <div class="p-4 text-center">
                      {{-- <i class="fa fa-3x fa-utensils text-warning mb-4"></i> --}}
                      <img class="mb-4" src="frontend/images/vegetables-packages.png" alt="">
                      <h5>Locally Sourced</h5>
                      
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
              <div class="service-item rounded pt-3">
                  <div class="p-4 text-center">
                      {{-- <i class="fa fa-3x fa-cart-plus text-warning mb-4"></i> --}}
                      <img class="mb-4" src="frontend/images/love.png" alt="">
                      <h5>High Quality</h5>
                      
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
              <div class="service-item rounded pt-3">
                  <div class="p-4 text-center">
                      {{-- <i class="fa fa-3x fa-headset text-warning mb-4"></i> --}}
                      <img class="mb-4" src="frontend/images/user-ex.png" alt="">
                      <h5>Unique Experience</h5>
                      
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Service End -->
<section class="food_section layout_padding-bottom">
    <div class="container">
      <!-- Menu -->
       <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
        </h2>
      </div>
      <div class="d-flex justify-content-center">
    <ul class="filters_menu custom rounded-pill">
      <li class="{{ Request::route('menuId') ? '' : 'active' }}" data-filter="*">
          <a href="{{ url('/menu') }}" class="menu-link {{ Request::route('menuId') ? 'text-dark' : 'text-white' }}">All</a>
      </li>
        @foreach ($menu as $row)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="menuDropdown{{$row->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                    {{$row->name_menu}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="menuDropdown{{$row->id}}">
                    <!-- Loop through submenus related to the current menu -->
                    @foreach ($row->submenus as $submenu)
                        <li>
                            <a href="{{ route('user.submenu_items', ['submenuId' => $submenu->id]) }}" class="submenu-link text-dark" data-submenu="{{ $submenu->submenu_name}}">
                                {{$submenu->submenu_name}}
                            </a>
                        </li>
                    @endforeach
                    <!-- Add more submenu items or actions as needed -->
                </ul>
            </div>
        @endforeach
    </ul>
</div>
      <!-- End Menu -->

      <div class="filters-content">
        <div class="row grid">
          @foreach ($item as $data)
          
            <form action="{{ route('user.addcartPost', ['id' => $data->id]) }}" method="POST">
            @csrf
            <div class="col-sm-6 col-lg-4 all pizza">
              <div class="box">
                <div>
                  <a href="{{ route('user.item_detail', ['itemId' => $data->id]) }}">
                    <div class="img-box">
                      
                      <img src="upload/item_images/{{$data->image}}" width="200" height="150" alt="">
                      
                    </div>
                  </a>
                  <div class="detail-box">
                    <h5>
                      {{$data->title}}
                    </h5>
                    {{-- <p>
                      {{$data->description}}
                    </p> --}}
                    <div class="options">
                      <div >
                        <div >
                          <h5 class="item_price">
                            ${{$data->price}}
                          </h5>
                        </div>
                        <div class="text-center">
                          <span> {{ $data->orderItems->count() }} sold</span>
                        </div>
                      </div>
                        <div class="stars-and-reviews">
                          <div class="stars">
                            @php
                              $rating = $data->reviews->count() > 0 ? $data->reviews->avg('stars_rated') : 0;
                              $fullStars = floor($rating);
                              $halfStar = ceil($rating - $fullStars);
                              $emptyStars = 5 - $fullStars - $halfStar;
                            @endphp
                            @for ($i = 0; $i < $fullStars; $i++)
                              <span class="fa fa-star checked"></span>
                            @endfor
                            @if ($halfStar)
                              <span class="fa fa-star-half-alt checked"></span>
                            @endif
                            @for ($i = 0; $i < $emptyStars; $i++)
                              <span class="fa fa-star"></span>
                            @endfor
                          </div>
                          <div class="text-center">
                            <span class="review-no">{{ $data->reviews->count() }} reviews</span>
                          </div>
                        </div>
                      <button type="submit" style=" background-color: transparent; border: none; "> 
                      <a href="" >
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                          <g>
                            <g>
                              <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                          c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                          C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                          c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                          C457.728,97.71,450.56,86.958,439.296,84.91z" />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                          c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                            </g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                          <g>
                          </g>
                        </svg>
                      
                      </a>
                    </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          @endforeach                            
        </div>
      </div>
      <div class="paginate-custom">
        {!!$item->withQueryString()->links('pagination::bootstrap-5')!!}
      </div>
    </div>
</section>
  <!-- end food section -->
  <!-- about section -->
  <!-- end about section -->
  <!-- book section -->
  <!-- end book section -->

  <!-- client section -->

  <!-- Testimonial Start -->
  <div class="client_section container-xxl pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h1 class="mb-5">What Says Our Customers</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            <div class="testimonial-item bg-dark text-light border rounded p-4  ">
                <i class="fa fa-quote-left fa-2x text-warning mb-3"></i>
                <p>
                  I have been to this place many times with friends,family as well as solo.
                  A very friendly atmosphere with polite staff.
                <div class="d-flex align-items-center">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="frontend/user_images/202305050814IMG_8904.jpg" style="width: 50px; height: 50px;">
                    <div class="ps-3">
                        <h5 class="mb-1">Punleu</h5>
                        <small>Customer</small>
                    </div>
                </div>
            </div>
            <div class="testimonial-item bg-dark text-light border rounded p-4">
                <i class="fa fa-quote-left fa-2x text-warning mb-3"></i>
                <p>
                  This place is customer friendly, ambience is amazing and food is mouth watering ❤️loved the concept of their infrastructure..!!
                </p>
                <div class="d-flex align-items-center">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="frontend/user_images/202330051149bunny-155674_1280.png" style="width: 50px; height: 50px;">
                    <div class="ps-3">
                        <h5 class="mb-1">Chisang</h5>
                        <small>Customer</small>
                    </div>
                </div>
            </div>
            <div class="testimonial-item bg-dark text-light border rounded p-4">
                <i class="fa fa-quote-left fa-2x text-warning mb-3"></i>
                <p>
                  The location is good for a break on highway. Food choice average. Food preparation good.
                </p>
                <div class="d-flex align-items-center">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="frontend/user_images/202309050921penguin-158551_1280.png" style="width: 50px; height: 50px;">
                    <div class="ps-3">
                        <h5 class="mb-1">Nary</h5>
                        <small>Customer</small>
                    </div>
                </div>
            </div>
            <div class="testimonial-item bg-dark text-light border rounded p-4">
                <i class="fa fa-quote-left fa-2x text-warning mb-3"></i>
                <p>
                  Ambience is quite good of this place .While we reach there, A guitarist was playing very melodious tune.
                </p>
                <div class="d-flex align-items-center">
                    <img class="img-fluid flex-shrink-0 rounded-circle" src="frontend/user_images/202330051151doctor-2027768_1280.png" style="width: 50px; height: 50px;">
                    <div class="ps-3">
                        <h5 class="mb-1">Dany</h5>
                        <small>Customer</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
<!-- Testimonial End -->
  <!-- end client section -->
