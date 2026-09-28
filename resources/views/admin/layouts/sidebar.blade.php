@php
  $foto = auth()->user()->foto;
  if($foto){
    $foto = auth()->user()->foto;
  }else{
    $foto = 'admin-users-foto/blank.png';
  }
  
@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        
        <!-- Brand Logo -->
        <div class="sidebar-brand text-start">
          
          <!--begin::Brand Link-->
          <a href="{{ url('') }}/admin/" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('assets/admin/dist/img/sistlogo.png') }}"
              alt="SiST"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">SIST</span>
            <!--end::Brand Text-->
          </a><br>
          <!--end::Brand Link-->
          <br>

        </div>
        <div class="info" style="text-align: center; color: white;">
          <small>Sistem Informasi Sekolah Terpadu</small>
        </div>
        
        <div class="sidebar-brand text-start">
          
          <!--begin::Brand Link-->
          <div class="info">
            <p style="color: white; font-size: 0.8em;" class="mb-0">
              <i class="nav-icon bi bi-circle-fill text-success"></i> Online <b><span id="jam">00:00:00</span></b>
            </p>
              {{-- <a href="#" class="text-decoration-none"><i class="nav-icon bi bi-circle-fill text-success"></i> Online <b><span id="jam"></span></b></a> --}}
          </div>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2" aria-label="Main navigation">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item">
                <a href="{{ url('') }}/admin/" class="nav-link">
                  <i class="nav-icon bi bi-house-door-fill"></i>                      
                  <p>
                     Beranda                
                  </p>
                </a>
              </li>

              @php
                use App\Models\Menuutama;
                use App\Models\Menusub;
                
                $kunci1 = auth()->user()->kunci1;
                $kunci2 = auth()->user()->kunci2;
                
                $level = auth()->user()->levels;
                if ($level === 1) {
                    $menuutama= Menuutama::where([['adminmenu','=','Y']])
                                ->orderby('urutan')->get();
                }elseif ($level===2) {
                    $menuutama= Menuutama::where([['usermenu','=','Y']])
                                ->orderby('urutan')->get();
                }else {
                    $menuutama= Menuutama::where([['entrymenu','=','Y']])
                                ->orderby('urutan')->get();
                }   
              @endphp

              @foreach ($menuutama as $utama)
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-grid-3x3-gap-fill" style="-webkit-text-stroke: 0px;"></i>
                    {{-- <i class="nav-icon bi bi-list-task" style="-webkit-text-stroke: 1px;"></i> --}}
                    <p>
                      {{ $utama->namamenu }}
                      <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    @php
                    
                    $id=$utama->id;
                    
                    $menusub= Menusub::where([['idmainmenu','=',$id],['idaplikasi','>=',$kunci1],['idaplikasi','<=',$kunci2]]);
                    if ($level === 1) {
                        if($id === 1) {
                          $menusub= Menusub::where([['idmainmenu','=',$id]]);
                          $menusub = $menusub->where([['adminmenu','=','Y']])
                                      ->orderby('urutan')->get();
                        }else{
                          $menusub = $menusub->where([['adminmenu','=','Y']])
                                      ->orderby('urutan')->get();
                        }
                    }elseif ($level===2) {
                        $menusub = $menusub->where([['usermenu','=','Y']])
                                    ->orderby('urutan')->get();
                    }else {
                        $menusub = $menusub->where([['entrymenu','=','Y']])
                                    ->orderby('urutan')->get();
                    }   
                    @endphp
                    @foreach ($menusub as $sub)
                      <li class="nav-item">
                        <a href="{{ url('') }}{{ $sub->link }}" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>{{ $sub->namamenu }}</p>
                        </a>
                      </li>
                    @endforeach

                  </ul>
                </li>
              @endforeach

              <li class="nav-item">
                <a href="{{ route('admin.users_index') }}" class="nav-link">
                  <i class="nav-icon bi bi-person-fill"></i>                      
                  <p>
                    Profile                
                  </p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('front.admin_logout') }}" class="nav-link">
                  <i class="nav-icon bi bi-box-arrow-right"></i>                      
                  <p>
                    Sign out                
                  </p>
                </a>
              </li>
              
            </ul>
            <!--end::Sidebar Menu-->

            <!-- Docs CTA (bottom of sidebar) -->
            
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>

<script type="text/javascript">

    //set date time zone
      "<?php date_default_timezone_set('Asia/Jakarta');?>";
      //time start
      var jamx = new Date("<?=session('awaljam');?>").getTime();    
      var jamr = new Date().getTime();

      myTimer=setInterval(startTimer,1000);
      function startTimer(){ 
          //time count up time every 1 second
          var jamy = new Date().getTime();
          var c=jamy-jamx;
          var ss=checkwaktu(Math.floor((c % (1000 * 60)) / 1000));        
          var mm=checkwaktu(Math.floor((c % (1000 * 60 * 60)) / (1000 * 60)));
          var hh=checkwaktu(Math.floor((c % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
          var dd=checkhari(Math.floor(c / (1000 * 60 * 60 * 24)));
          document.getElementById('jam').innerHTML=hh+":"+mm+":"+ss;        
      }
      
      function checkwaktu(x){
          if(x<10&&x>=0){x="0"+x};
          if(x<0){x="59"};
          return x;
      }
      
      function checkhari(x){
          if(x<10&&x>=0){x="0"+x};
          if(x<0){x="23"};
          return x;
      }
      
      $(document).ready(function(){
            startTimer();
      });
      
  </script>