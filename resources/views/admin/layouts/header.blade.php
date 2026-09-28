  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- icon -->
   <link rel="icon" href="{{ asset('storage/') }}/{{ session('memlogo') }}">

    <!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
    <script>
      (() => {
        'use strict';
        const STORAGE_KEY = 'lte-theme';
        let stored = null;
        try {
          stored = localStorage.getItem(STORAGE_KEY);
        } catch {
          // localStorage may be unavailable (private mode, sandboxed iframe).
        }
        const prefersDark = globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
        // Mirror the resolution in _scripts.astro: explicit "dark"/"light" win,
        // otherwise ("auto" or unset) fall back to the OS preference.
        let resolved = 'light';
        if (stored === 'dark' || stored === 'light') {
          resolved = stored;
        } else if (prefersDark) {
          resolved = 'dark';
        }
        document.documentElement.setAttribute('data-bs-theme', resolved);
        document.documentElement.style.colorScheme = resolved;
      })();
    </script>
    <!--end::Theme Init-->

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | Starter Page" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel"
    />
    <!--end::Primary Meta Tags-->

    {{-- <script src="{{ asset('assets/admin/plugins/bootstrap-5.2.3/dist/js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/plugins/bootstrap-5.3.8/dist/js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

    {{-- <link rel="stylesheet" href="{{ asset('assets/front/plugins/bootstrap-5.3.8/dist/css/bootstrap.min.css') }}"> --}}

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('assets/admin/dist/css/adminlte.css') }}" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      {{-- href="{{ asset('assets/plugins/fontsource-sans-3-5.3.0/package/index.css') }}" --}}
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media = 'all'"
    />
    <!--end::Fonts--> 

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/overlayscrollbars.min.css') }}"  crossorigin="anonymous"/>
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous"/> --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-icons-1.13.1/bootstrap-icons.min.css') }}" crossorigin="anonymous"/>
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->

     <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    {{-- <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/admin/plugins/overlayscrollbars-2.16.0/package/browser/overlayscrollbars.browser.es6.min.js') }}" crossorigin="anonymous"></script>

    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/admin/plugins/proper-2.11.8/package/dist/umd/popper.min.js') }}" crossorigin="anonymous"></script>
    
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('assets/admin/plugins/bootstrap-5.3.8/dist/js/bootstrap.min.js') }}" crossorigin="anonymous"></script> --}}

    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    {{-- <link rel="stylesheet" href="./css/adminlte.css" /> --}}
    <script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/admin/w3schools/w3.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">

    <!-- style-ku -->
  <link rel="stylesheet" href="{{ asset('assets/style-ku/css/style-ku.css') }}">
  <script src="{{ asset('assets/style-ku/js/style-ku.js') }}"></script>

    {{-- <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script> --}}
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-ui-1.14.2/jquery-ui.min.js') }}"></script>
    <!-- DataTables -->

  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}">

  <!-- DataTables  & Plugins -->
  {{-- <script src="{{ asset('assets/admin/plugins/bootstrap-3.5.8/js/bootstrap.bundle.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/admin/plugins/datatables.net/dataTables.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/admin/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/admin/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/admin/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/admin/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/admin/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/admin/plugins/jszip/plugins/jszip.min.js') }}"></script> --}}
  <script src="{{ asset('assets/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/pdfmake/build/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
    <!-- ckeditor4 -->
    <script src="{{ asset('assets/admin/plugins/ckeditor4/ckeditor.js') }}"></script>
    <!-- datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/vanillajs-datepicker/dist/css/datepicker-bs5.min.css') }}">
    <script src="{{ asset('assets/admin/plugins/vanillajs-datepicker/dist/js/datepicker-full.min.js') }}"></script>

    <!-- Tabulator -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tabulator-tables/dist/css/tabulator.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/admin/plugins/tabulator-tables/dist/js/tabulator.min.js') }}"></script>
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tabulator-tables/dist/css/tabulator_bootstrap5.min.css') }}"> --}}
    {{-- <script type="text/javascript" src="{{ asset('assets/admin/plugins/tabulator-tables/dist/js/tabulator_bootstrap5.min.js') }}"></script> --}}

    <link href="https://cdn.datatables.net/v/dt/dt-3.0.1/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/4.0.1/css/buttons.dataTables.min.css" rel="stylesheet">
    {{-- https://cdn.datatables.net/3.0.1/css/dataTables.dataTables.min.css --}}
    <script src="https://cdn.datatables.net/v/dt/dt-3.0.1/datatables.min.js" ></script>

    <script src="https://cdn.datatables.net/3.0.1/js/dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/buttons/4.0.1/js/dataTables.buttons.min.js" ></script>
    <script src="https://cdn.datatables.net/buttons/4.0.1/js/buttons.dataTables.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" ></script>

    {{-- CKEditor --}}
    {{-- <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/48.4.0/ckeditor5.css" />
    <script src="https://cdn.ckeditor.com/ckeditor5/48.4.0/ckeditor5.umd.js"></script>
    <!-- Add if you use premium features. -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/48.4.0/ckeditor5-premium-features.css" />
    <script src="https://cdn.ckeditor.com/ckeditor5-premium-features/48.4.0/ckeditor5-premium-features.umd.js"></script> --}}


<script>

 const app_ckeditor5 = {
    
 }
  // This sample still does not showcase all CKEditor 5 features (!)
  // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
  
  const formatckeditor5 = {
      // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
      
      toolbar: {
              items: [
                  'exportPDF','exportWord', '|',
                  'findAndReplace', 'selectAll', '|',
                  'heading', '|',
                  'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                  'bulletedList', 'numberedList', 'todoList', '|',
                  'outdent', 'indent', '|',
                  'undo', 'redo',
                  '-',
                  'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                  'alignment', '|',
                  'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                  'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                  'textPartLanguage', '|',
                  'sourceEditing'
                  
              ],
              shouldNotGroupWhenFull: true
          },

          

          // Changing the language of the interface requires loading the language file using the <script> tag.
          // language: 'es',
          list: {
              properties: {
                  styles: true,
                  startIndex: true,
                  reversed: true
              }
          },
          // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
          heading: {
              options: [
                  { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                  { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                  { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                  { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                  { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                  { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                  { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
              ]
          },
          // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
          placeholder: 'Welcome to CKEditor 5!',
          // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
          fontFamily: {
              options: [
                  'default',
                  'Arial, Helvetica, sans-serif',
                  'Courier New, Courier, monospace',
                  'Georgia, serif',
                  'Lucida Sans Unicode, Lucida Grande, sans-serif',
                  'Tahoma, Geneva, sans-serif',
                  'Times New Roman, Times, serif',
                  'Trebuchet MS, Helvetica, sans-serif',
                  'Verdana, Geneva, sans-serif'
              ],
              supportAllValues: true
          },
          // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
          fontSize: {
              options: [ 10, 12, 14, 'default', 18, 20, 22 ],
              supportAllValues: true
          },
          // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
          // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
          htmlSupport: {
              allow: [
                  {
                      name: /.*/,
                      attributes: true,
                      classes: true,
                      styles: true
                  }
              ]
          },
          // Be careful with enabling previews
          // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
          htmlEmbed: {
              showPreviews: true
          },
          // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
          link: {
              decorators: {
                  addTargetToExternalLinks: true,
                  defaultProtocol: 'https://',
                  toggleDownloadable: {
                      mode: 'manual',
                      label: 'Downloadable',
                      attributes: {
                          download: 'file'
                      }
                  }
              }
          },
          // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
          mention: {
              feeds: [
                  {
                      marker: '@',
                      feed: [
                          '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                          '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                          '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                          '@sugar', '@sweet', '@topping', '@wafer'
                      ],
                      minimumCharacters: 1
                  }
              ]
          },
          // The "super-build" contains more premium features that require additional configuration, disable them below.
          // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
          removePlugins: [
              // These two are commercial, but you can try them out without registering to a trial.
              // 'ExportPdf',
              // 'ExportWord',
              'CKBox',
              'CKFinder',
              'EasyImage',
              // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
              // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
              // Storing images as Base64 is usually a very bad idea.
              // Replace it on production website with other solutions:
              // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
              // 'Base64UploadAdapter',
              'RealTimeCollaborativeComments',
              'RealTimeCollaborativeTrackChanges',
              'RealTimeCollaborativeRevisionHistory',
              'PresenceList',
              'Comments',
              'TrackChanges',
              'TrackChangesData',
              'RevisionHistory',
              'Pagination',
              'WProofreader',
              // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
              // from a local file system (file://) - load this site via HTTP server if you enable MathType
              'MathType'
          ]
  }


</script>



</head>

