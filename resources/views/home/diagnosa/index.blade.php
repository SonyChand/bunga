<x-home.layout>
    @slot('title')
        Hasil Diagnosa
    @endslot





    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0 card-title">HASIL DIAGNOSA</h3>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $data['nama'] }}</p>
                <p><strong>Tanggal Konsultasi:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p><strong>Keluhan:</strong> <span class="badge bg-danger">{{ $data['keluhan'] }}</span></p>
                <hr>

                <h5 class="fw-bold">Diagnosis yang Ditemukan:</h5>

                @if (empty($diagnosisResults) || count(array_filter($diagnosisResults, fn($result) => $result['percentage'] > 0)) === 0)
                    <div class="alert alert-warning" role="alert">
                        Tidak ada diagnosis yang ditemukan. Silakan konsultasikan lebih lanjut dengan dokter.
                    </div>
                @else
                    @foreach ($diagnosisResults as $result)
                        @if ($result['percentage'] > 0)
                            <!-- Hanya tampilkan jika persentase lebih dari 0 -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6><strong>Diagnosis:</strong> {{ $result['diagnosis'] }}</h6>
                                    <p><strong>Persentase Kecocokan:</strong>
                                        <span class="badge bg-success">{{ $result['percentage'] }}%</span>
                                    </p>
                                    <p><strong>Alasan:</strong> {{ $result['reason'] }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="card-footer text-center">
                <a href="/" class="btn-lg btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>




    <!-- Doctors Section -->
    <section id="doctors" class="doctors section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak Reservasi</h2>
            <p>Hubungi kontak dibawah ini untuk melakukan reservasi</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('frontend') }}/assets/img/doctors/doctors-1.jpg"
                                class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Walter White</h4>
                            <span>Chief Medical Officer</span>
                            <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""> <i class="bi bi-linkedin"></i> </a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('frontend') }}/assets/img/doctors/doctors-2.jpg"
                                class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Sarah Jhonson</h4>
                            <span>Anesthesiologist</span>
                            <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""> <i class="bi bi-linkedin"></i> </a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('frontend') }}/assets/img/doctors/doctors-3.jpg"
                                class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>William Anderson</h4>
                            <span>Cardiology</span>
                            <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""> <i class="bi bi-linkedin"></i> </a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="{{ asset('frontend') }}/assets/img/doctors/doctors-4.jpg"
                                class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Amanda Jepson</h4>
                            <span>Neurosurgeon</span>
                            <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""> <i class="bi bi-linkedin"></i> </a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

            </div>

        </div>

    </section><!-- /Doctors Section -->




</x-home.layout>
