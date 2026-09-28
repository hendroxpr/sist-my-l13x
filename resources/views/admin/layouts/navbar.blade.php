@php
  use Carbon\Carbon;

  $kode = session('kode');
  $aplikasi = session('aplikasi');
  $username = auth()->user()->name;
  $jmllogin = auth()->user()->jmllogin;
  $created_at = auth()->user()->created_at;
  $created_at = substr($created_at, 0, 10);
  $created_at = Carbon::parse($created_at)->format('d F Y');
  $status = auth()->user()->status;
  if($status){
    $status = "(" . auth()->user()->status . ")";
  }else{
    $status = "";
  }

  $foto = auth()->user()->foto;
  if($foto){
    $foto = auth()->user()->foto;
  }else{
    $foto = 'admin-users-foto/blank.png';
  }

@endphp

<style>
    /* 1. Atur teks pemicu */
    .teks-pemicu {
      color: #007bff;
      text-decoration: underline;
      cursor: pointer;
      display: inline-block;
    }

    /* 2. Sembunyikan div popover secara default */
    .popover-info {
      display: none;
      position: fixed; /* Menggunakan fixed agar posisi akurat terhadap layar */
      padding: 10px;
      background-color: #333;
      color: #fff;
      border-radius: 5px;
      font-size: 14px;
      pointer-events: none; /* Mencegah kedipan jika kursor mengenai div ini */
      z-index: 1000;
    }
  </style>

<nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a
                class="nav-link"
                data-lte-toggle="sidebar"
                href="#"
                role="button"
                aria-label="Toggle sidebar"
              >
                <i class="bi bi-list"></i>
              </a>
            </li>

            <li class="nav-item d-none d-md-block" id="lix1" name="lix1">
                <a  href="{{ url('') }}/admin/" class="nav-link">{{ $aplikasi }} <span id="waktumundur" style="display: none;"></span><span id="waktumundurx" style="display: none;"></span> <span id="countdown">[00:00:00]</span></a>
            </li>
            {{-- <li class="nav-item d-none d-md-block">
              <a href="./index.html" class="nav-link">
                <i class="bi bi-grid-1x2 me-1" aria-hidden="true"></i>
                  Live preview
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="./docs/introduction.html" class="nav-link">
                <i class="bi bi-book me-1" aria-hidden="true"></i>
                Documentation
              </a>
            </li> --}}
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Messages Dropdown Menu-->
            {{-- <li class="nav-item dropdown">
              <a
                class="nav-link"
                data-bs-toggle="dropdown"
                href="#"
                aria-label="Messages: 3 unread"
              >
                <i class="bi bi-chat-text"></i>
                <span class="navbar-badge badge text-bg-danger">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="./assets/img/user1-128x128.jpg"
                        alt=""
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <p class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger"
                          ><i class="bi bi-star-fill"></i
                        ></span>
                      </p>
                      <p class="fs-7">Call me whenever you can...</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="./assets/img/user8-128x128.jpg"
                        alt=""
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <p class="dropdown-item-title">
                        John Pierce
                        <span class="float-end fs-7 text-secondary">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </p>
                      <p class="fs-7">I got your message bro</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="./assets/img/user3-128x128.jpg"
                        alt=""
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <p class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-end fs-7 text-warning">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </p>
                      <p class="fs-7">The subject goes here</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
            </li> --}}
            <!--end::Messages Dropdown Menu-->

            <!--begin::Notifications Dropdown Menu-->
            {{-- <li class="nav-item dropdown">
              <a
                class="nav-link"
                data-bs-toggle="dropdown"
                href="#"
                aria-label="Notifications: 15 unread"
              >
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li> --}}
            <!--end::Notifications Dropdown Menu-->

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a
                class="nav-link"
                href="#"
                data-lte-toggle="fullscreen"
                aria-label="Toggle fullscreen"
              >
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::Color Mode Toggle (#6010)-->
            <li class="nav-item dropdown">
              <a
                class="nav-link"
                href="#"
                id="bd-theme"
                aria-label="Toggle color scheme"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
              </a>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="bd-theme"
                style="--bs-dropdown-min-width: 8rem"
              >
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="light"
                    aria-pressed="false"
                  >
                    <i class="bi bi-sun-fill me-2"></i>
                    Light
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center"
                    data-bs-theme-value="dark"
                    aria-pressed="false"
                  >
                    <i class="bi bi-moon-fill me-2"></i>
                    Dark
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item d-flex align-items-center active"
                    data-bs-theme-value="auto"
                    aria-pressed="true"
                  >
                    <i class="bi bi-circle-half me-2"></i>
                    Auto
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
              </ul>
            </li>
            <!--end::Color Mode Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="{{ asset('storage/') }}/{{ $foto }}"
                  class="user-image rounded-circle shadow"
                  alt="{{ $username }}"
                />
                <span class="d-none d-md-inline">{{ $username }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <p class="mt-2 mb-2">{{ $jmllogin }}</p>
                  <img
                    src="{{ asset('storage/') }}/{{ $foto }}"
                    class="rounded-circle shadow"
                    alt="{{ $username }}"
                  />
                  <p>
                   {{ $username }} - {{ $kode }}</br> 
                   {{ $status }}
                    <small>Registered since {{ $created_at }}</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    {{-- <div class="col-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="#">Friends</a>
                    </div> --}}
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                
                  <a href="{{ route('admin.users_index') }}" class="btn btn-outline-secondary bi-person-plus-fill"> Profile</a>

                  <a href="{{ route('front.admin_logout') }}" class="btn btn-outline-danger float-end"><i class="nav-icon bi bi-box-arrow-right" style="size: 24px;"></i> Sign out</a>

                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>

    <script type="text/javascript">
		
		$(document).ready(function(){
      
      
      var awalx = '<?php echo auth()->user()->countdown; ?>';
      var waktux = '<?php echo auth()->user()->countdown; ?>';
      cd(waktux);

      let waktusisa = waktux;
      let waktu = null;

      function cd(jam){

        var h1 = parseInt(parseInt(jam)/3600);
        var mx = parseInt(parseInt(jam)%3600);
        var m1 = parseInt(parseInt(mx)/60);
        var s1 = parseInt(parseInt(mx)%60);
        
        if(h1<10){
          var hh = '0'+h1;
        }else{
          var hh = h1;
        }

        if(m1<10){
          var mm = '0'+m1;
        }else{
          var mm = m1;
        }
        
        if(s1<10){
          var ss = '0'+s1;
        }else{
          var ss = s1;
        }

        $('#countdown').text('['+hh+':'+mm+':'+ss+']');
      }

      mulai();

      function mulai(){
        waktu = setInterval(() => {
          waktusisa--;
          cd(waktusisa);
          if(waktusisa < 1){
              tutup();
          }else{
            if(waktusisa<=10){
              document.getElementById("lix1").style.cssText = "background-color: red";
            }else{
              $("#lix1").removeAttr("style");
            }
          }
        }, 1000);
      }

      document.addEventListener('mousemove', (event) => {
        selesai();
        waktusisa = awalx;
        cd(waktusisa);
        mulai();          
      });
      
			function tutup(){	        			
				selesai();
        var url = "{{ route('front.admin_logout') }}";
        location.href = url;
			}

			function selesai() {
			  clearInterval(waktu);
			}


			
	  });



	</script>