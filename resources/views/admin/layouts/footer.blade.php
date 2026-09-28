@php
    $meminstansi = session('memnamasingkat');
@endphp

      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">
          Developed by team IT {{ $meminstansi }}
        </div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2026-<?= date('Y'); ?> {{ $meminstansi }}
        </strong>
        All rights reserved. Build v{{ Illuminate\Foundation\Application::VERSION }} 
        PHP v<?php print phpversion(); ?>
        <!--end::Copyright-->
      </footer>