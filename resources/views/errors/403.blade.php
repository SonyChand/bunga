<x-auth.layout>
    @slot('title')
        Halaman Login
    @endslot
    <main class="main" id="top">
        <div class="px-3">
            <div class="row min-vh-100 flex-center p-5">
                <div class="col-12 col-xl-10 col-xxl-8">
                    <div class="row justify-content-center align-items-center g-5">
                        <div class="col-12 col-lg-6 text-center order-lg-1"><img class="img-fluid w-lg-100 d-dark-none"
                                src="{{ asset('backend') }}/assets/img/spot-illustrations/403-illustration.png"
                                alt="" width="400" /><img class="img-fluid w-md-50 w-lg-100 d-light-none"
                                src="{{ asset('backend') }}/assets/img/spot-illustrations/dark_403-illustration.png"
                                alt="" width="540" /></div>
                        <div class="col-12 col-lg-6 text-center text-lg-start"><img
                                class="img-fluid mb-6 w-50 w-lg-75 d-dark-none"
                                src="{{ asset('backend') }}/assets/img/spot-illustrations/403.png" alt="" /><img
                                class="img-fluid mb-6 w-50 w-lg-75 d-light-none"
                                src="{{ asset('backend') }}/assets/img/spot-illustrations/dark_403.png"
                                alt="" />
                            <h2 class="text-body-secondary fw-bolder mb-3">Akses Ditolak</h2>
                            <p class="text-body mb-5">Anda tidak memiliki izin untuk mengakses halaman ini</p><a
                                class="btn btn-lg btn-primary" href="{{ url()->previous() }}">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
            var navbarTop = document.querySelector('.navbar-top');
            if (navbarTopStyle === 'darker') {
                navbarTop.setAttribute('data-navbar-appearance', 'darker');
            }

            var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
            var navbarVertical = document.querySelector('.navbar-vertical');
            if (navbarVertical && navbarVerticalStyle === 'darker') {
                navbarVertical.setAttribute('data-navbar-appearance', 'darker');
            }
        </script>
    </main>

</x-auth.layout>
