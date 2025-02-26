<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Hasil Diagnosa Anda</h3>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $data['nama'] }}</p>
                <p><strong>Tanggal Konsultasi:</strong>
                    {{ \Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('d F Y') }}</p>
                <p><strong>Keluhan:</strong> {{ $data['keluhan'] }}</p>
                <hr>
                <p><strong>Hasil Diagnosa:</strong></p>
                <ul>
                    @if (empty($diagnosisResults) || count(array_filter($diagnosisResults, fn($result) => $result['percentage'] > 0)) === 0)
                        <div class="alert alert-warning" role="alert">
                            Tidak ada diagnosis yang ditemukan. Silakan konsultasikan lebih lanjut dengan dokter.
                        </div>
                    @else
                        @foreach ($diagnosisResults as $result)
                            @if ($result['percentage'] > 0)
                                <li>
                                    Diagnosis: {{ $result['diagnosis'] }} -
                                    Persentase Kecocokan: {{ $result['percentage'] }}% -
                                    Alasan: {{ $result['reason'] }}
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="card-footer text-muted text-center">
                <small>Diagnosa ini hanya bersifat indikatif. Silakan konsultasikan lebih lanjut dengan dokter.</small>
            </div>
        </div>
    </div>
</body>

</html>
