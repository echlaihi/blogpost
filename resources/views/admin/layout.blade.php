<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Area | Dashboard</title>
  <link href="{{ asset('css/bootstrap3.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
</head>

<body>

  {{-- ====================================== the nav==================================================================== --}}
        @include('admin.components.nav')
  {{-- ===========end nav =============================================================================================== --}}

  {{-- === header ========================================================================================================= --}}
        @include('admin.components.header')
  {{-- === end header ===================================================================================================== --}}

  <section id="main">
    <div class="container">
      <div class="row">

        <div class="col-md-3">
          {{-- ====== sidebar ============================================================================================ --}}
                @include('admin.components.sidebar')
          {{-- === endsidebar ============================================================================================== --}}
        </div>

        <div class="col-md-9">
          {{-- --======= Website Overview ==================================================================================== --}}
                @include('admin.components.websiteOverView')
          {{-- == end website overview ======================================================================================= --}}
          

          {{-- ==== tables==================================================================================================== --}}
                @yield('table')
          {{-- === end tables ================================================================================================ --}}
          
         
        </div>
      </div>
    </div>
  </section>

  <footer id="footer">
    <p>Copyright AdminStrap &copy; 2021</p>
  </footer>

  
  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  <script src="{{ asset('js/boostrap4.js') }}"></script>
  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>

</html>