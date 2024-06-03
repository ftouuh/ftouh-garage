<!doctype html>
<html @if(app()->getLocale() == 'ar') dir="rtl" @endif
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('admin.layouts.partials.header')
    <body data-topbar="dark">
      <div id="preloader" style="background-color:#12101d;">
        <div id="status">
            <div class="spinner">
            <i class="ri-restart-line spin-icon" style="color:white;"></i>
            </div>
        </div>
    </div>
        <div id="layout-wrapper">
            @include('admin.layouts.components.header')
          @include('admin.layouts.components.leftside')
           @yield('content')
        </div>

        <div class="rightbar-overlay"></div>
        @include('admin.layouts.partials.scripts')
      </body>

</html>
