<x-auth.layout>
    @slot('title')
        Halaman Login
    @endslot
    <main class="main" id="top">
        <div class="row vh-100 g-0">
            <div class="col-lg-6 position-relative d-none d-lg-block">
                <div class="bg-holder" style="background-image:url({{ asset('backend') }}/assets/img/bg/30.png);">
                </div>
                <!--/.bg-holder-->

            </div>
            <div class="col-lg-6">
                <div class="row flex-center h-100 g-0 px-4 px-sm-0">
                    <div class="col col-sm-6 col-lg-7 col-xl-6"><a class="d-flex flex-center text-decoration-none mb-4"
                            href="{{ asset('backend') }}/index.html">
                            <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img
                                    src="{{ $sets->web_logo ? Storage::url($sets->web_logo) : asset('backend/assets/img/default/nope.jpg') }}"
                                    alt="phoenix" width="58" />
                            </div>
                        </a>
                        <div class="text-center mb-7">
                            <h3 class="text-body-highlight">Login</h3>
                            <p class="text-body-tertiary">Masuk ke
                                {{ $sets->web_title ? $sets->web_title : config('app.name') }}</p>
                        </div>
                        <a href="{{ route('auth.google') }}" class="btn btn-phoenix-secondary w-100 mb-3"><span
                                class="fab fa-google text-success me-2 fs-9"></span>Login dengan Google</a>



                        <form class="needs-validation" action="{{ route('login') }}" method="post"
                            onsubmit="showLoader()" novalidate="">
                            @csrf
                            <div class="mb-3 text-start">
                                <label class="form-label" for="email">Alamat Email</label>
                                <div class="form-icon-container">
                                    <input class="form-control form-icon-input" id="email" name="email"
                                        type="email" placeholder="blabla@blabla.com"
                                        value="{{ old('email') }}" /><span
                                        class="fas fa-user text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <div class="mb-3 text-start">
                                <label class="form-label" for="password">Password</label>
                                <div class="form-icon-container" data-password="data-password">
                                    <input class="form-control form-icon-input pe-6" id="password" type="password"
                                        placeholder="Password" name="password"
                                        data-password-input="data-password-input" /><span
                                        class="fas fa-key text-body fs-9 form-icon"></span>
                                    <button type="button"
                                        class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary"
                                        data-password-toggle="data-password-toggle"><span
                                            class="uil uil-eye show"></span><span
                                            class="uil uil-eye-slash hide"></span></button>
                                </div>
                            </div>
                            <div class="row flex-between-center mb-7">
                                <div class="col-auto">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" id="basic-checkbox" type="checkbox"
                                            checked="checked" />
                                        <label class="form-check-label mb-0" for="basic-checkbox">Ingat saya</label>
                                    </div>
                                </div>
                                <div class="col-auto"><a class="fs-9 fw-semibold"
                                        href="{{ route('password.request') }}">Lupa Password?</a></div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                        </form>
                        <div class="text-center"><a class="fs-9 fw-bold" href="{{ route('register') }}">Buat akun</a>
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
