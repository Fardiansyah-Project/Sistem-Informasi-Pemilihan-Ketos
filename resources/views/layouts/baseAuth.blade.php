
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
@include('layouts.head')
<!-- [Head] end -->
<!-- [Body] Start -->
<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <a href="#"><img src="{{ asset('assets/images/logo-dark.svg') }}" alt="img"></a>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- [ Script ] start -->
    @include('layouts.script')
    <!-- [ Script ] end -->



</body>
<!-- [Body] end -->

</html>
