@extends('admin.layouts.main')

@section('contents')

<style>
    .tabelku {        
        
        border-collapse: collapse        
    }

    .tabelku td {
        padding-bottom: 10px;
        padding-top: 10px;
        padding-right: 10px;
        padding-bottom: 10px;
        padding-left: 10px;  
        border: 1px solid #e5e7eb;     
    }

</style>

    
</body>
</html>
    
</body>
</html>
    
</body>
</html>


<div class="row">
    <div class="col-md-6">
        <table class="tabelku" width="100%">
            <tr>
                <td colspan="2" class="text-center" style="background-color: rgb(233, 231, 231);">Informasi Instansi</td>
                
            </tr>
            <tr>
                <td style="width: 35%;" >Nama</td>
                <td style="width: 65%;"><i class="bi bi-mortarboard-fill"></i> {{ session('memnamasingkat') }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <i class="bi bi-geo-alt-fill"></i> {{ session('memalamat') }} <br>
                    Desa/Kelurahan {{ session('memdesa') }} <br>
                    Kecamatan {{ session('memkecamatan') }} <br>
                    Kabupaten {{ session('memkabupaten') }} <br>
                    Propinsi {{ session('mempropinsi') }}                
                </td>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td><i class="bi bi-mailbox"></i> {{ session('memkodepos') }}</td>
            </tr>
            <tr>
                <td>Telp.</td>
                <td><i class="bi bi-telephone-fill"></i> {{ session('memnomorkontak') }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td><i class="bi bi-envelope-fill"></i> {{ session('mememail') }}</td>
            </tr>
            <tr>
                <td>Web</td>
                <td><i class="bi bi-globe2"></i> {{ session('memwebsite') }}</td>
            </tr>

        </table>
    </div>

    <div class="col-md-6">
        <table class="tabelku" width="100%">
            <tr>
                <td colspan="2" class="text-center" style="background-color: rgb(233, 231, 231)">Informasi Aplikasi</td>
                
            </tr>
            <tr>
                <td style="width: 35%">Nama</td>
                <td style="width: 65%"><i class="bi bi-grid-1x2-fill"></i> Sistem Informasi Sekolah Terpadu (SIST)</td>
            </tr>
            <tr>
                <td>Aplikasi</td>
                <td><i class="bi bi-window-fullscreen"></i> {{ session('aplikasi') }} ({{ session('kode') }})</td>
            </tr>
            <tr>
                <td>Framework</td>
                <td>
                    <span class="d-inline-flex align-items-center">
                    <!-- Ikon Laravel SVG Isometrik Merah -->
                    <svg xmlns="http://w3.org" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2" style="width: 1.25em; height: 1.25em; color: #FF2D20;">
                        <path d="M11 21.5h-5.5a1.5 1.5 0 0 1 -1.5 -1.5v-10.5m14 -3v-2.5a1.5 1.5 0 0 0 -1.5 -1.5h-5a1.5 1.5 0 0 0 -1.5 1.5v9.5m1.5 -9.5h5.5a1.5 1.5 0 0 1 1.5 1.5v12.5a1.5 1.5 0 0 1 -1.5 1.5h-11a1.5 1.5 0 0 1 -1.5 -1.5v-2m14 -10.5h-5.5m-3.5 12.5v-10.5"/>
                    </svg>
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                    </span>

                </td>
            </tr>
            <tr>
                <td>PHP Language</td>
                <td>
                <span class="d-inline-flex align-items-center">
                <!-- Ikon Logo PHP SVG Resmi -->
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" fill="currentColor" class="me-2" style="width: 1.5em; height: 1.5em; color: #777BB4;">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-3.5 13H7v-6h1.5v2.25h1V9H11v6h-1.5v-2.25h-1V15zm5.5-2.25h1.25V11H14v1.75zm1.5 2.25H12.5v-6H15.5c.83 0 1.5.67 1.5 1.5v1.5c0 .83-.67 1.5-1.5 1.5zm4.5 0h-1.5v-2.25h-1V15H19v-6h1.5v2.25h1V9H23v6z"/>
                </svg>
                PHP v<?php print phpversion(); ?>
                </span>
                </td>
            </tr>
            

            {{-- Membaca versi Bootstrap dan tailwindcss langsung dari file package.json --}}
            @php
                $packageJson = json_decode(file_get_contents(base_path('package.json')), true);
                // Bootstrap
                $bootstrapVersion = ltrim($packageJson['dependencies']['bootstrap'] ?? 'Not Found', '^~');
                // Tailwin
                $tailwindRaw = $packageJson['dependencies']['tailwindcss'] 
                            ?? $packageJson['devDependencies']['tailwindcss'] 
                            ?? 'Tidak Ditemukan';
                            
                $tailwindVersion = ltrim($tailwindRaw, '^~');
            @endphp

            <tr>
                <td>                    
                    CSS Styling
                </td>                
                <td>
                    <i class="bi bi-bootstrap-fill"></i> <span id="bootstrap-version">Bootstrap v{{ $bootstrapVersion }}></span>, 
                    <span><img
                        src="{{ asset('assets/admin/dist/img/tailwind-logo-bg-0-30.png') }}"
                        alt="SiST"
                        class="brand-image opacity-75 shadow"
                        style="height: 20px; object-fit: contain;"
                        />
                    </span>
                    <span id="tailwind-version">Tailwind v{{ $tailwindVersion }}</span>
                </td>
            </tr>
            <tr>
                <td>IP Address</td>
                <td>{{ $_SERVER['REMOTE_ADDR'] }}</td>
            </tr>
            
                    @php
                        use Jenssegers\Agent\Facades\Agent;
                        $device = Agent::device();
                        $browser = Agent::browser(). ' ' . Agent::version(Agent::browser());
                        $platform = Agent::platform(). ' ' . Agent::version(Agent::platform());
                        if (Agent::isMobile()) {
                            $result = 'Mobile';
                        }else if (Agent::isDesktop()) {
                            $result = 'Desktop';
                        }else if (Agent::isTablet()) {
                            $result = 'Tablet';
                        }else if (Agent::isPhone()) {
                            $result = 'Phone';
                        }
                    @endphp
            <tr>
                <td>Browser</td>
                <td>{{ $browser }}</td>
            </tr>
            <tr>
                <td>OS</td>
                <td>{{ $platform }}</td>
            </tr>
            <tr>
                <td>Device</td>
                <td>{{ $result }}</td>
            </tr>

        </table>
    </div>

</div>


<div class="text-center">
    <table style="border-collapse: collapse; border:1px">
        <tr>
            <td></td>
        </tr>
    </table>

</div>

<script  type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof bootstrap !== 'undefined') {
            // Mengambil string versi dari objek global Bootstrap
            document.getElementById('bootstrap-version').textContent = 'Bootstrap v' + bootstrap.Tooltip.VERSION;
        } else {
            document.getElementById('bootstrap-version').textContent = 'Tidak terdeteksi';
        }
    });
</script>



@endsection