<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\DiagnosisResult;

class DiagnosisController extends Controller
{
    private $dataset;

    public function __construct()
    {
        // Dataset besar dengan berbagai kombinasi gejala untuk melatih pohon keputusan
        $this->dataset = [
            ['gatal', 'merah', 'kering', 'Eksim'],
            ['gatal', 'berair', 'basah', 'Dermatitis'],
            ['tidak gatal', 'merah', 'kering', 'Psoriasis'],
            ['gatal', 'merah', 'tidak kering', 'Alergi'],
            ['gatal', 'bersisik', 'putih', 'Psoriasis Vulgaris'],
            ['bintik merah', 'berair', 'gatal', 'Cacar Air'],
            ['gatal', 'bercak putih', 'kering', 'Panu'],
            ['gatal', 'melepuh', 'berair', 'Herpes'],
            ['kemerahan', 'gatal', 'terbakar', 'Lupus Kulit'],
            ['gatal', 'merah', 'bercak', 'Dermatitis Kontak'],
            ['gatal', 'kering', 'putih', 'Kandidiasis'],
            ['gatal', 'merah', 'gatal', 'Alergi Makanan'],
            ['gatal', 'berair', 'kering', 'Infeksi Jamur'],
            ['gatal', 'merah', 'bercak', 'Psoriasis Guttata'],
            ['gatal', 'berair', 'melepuh', 'Impetigo'],
            ['gatal', 'merah', 'terbakar', 'Dermatitis Seboroik'],
            ['gatal', 'bercak', 'kering', 'Tinea Versicolor'],
            ['gatal', 'merah', 'berair', 'Cacar Air'],
            ['gatal', 'putih', 'kering', 'Lichen Planus'],
            ['gatal', 'merah', 'bercak', 'Eritema Multiforme'],
            ['gatal', 'berair', 'bercak', 'Urtikaria'],
            ['gatal', 'merah', 'berbintik', 'Folikulitis'],
            ['gatal', 'kering', 'bercak', 'Dermatitis Atopik'],
            ['gatal', 'merah', 'berair', 'Kudis'],
            ['gatal', 'berair', 'kering', 'Sifilis'],
            ['gatal', 'merah', 'bercak', 'Pityriasis Rosea'],
            ['gatal', 'berair', 'melepuh', 'Herpes Simpleks'],
            ['gatal', 'merah', 'kering', 'Kanker Kulit'],
            ['gatal', 'bercak', 'putih', 'Vitiligo'],
            ['gatal', 'merah', 'berbintik', 'Eczema'],
            ['gatal', 'kering', 'berair', 'Dermatitis Perioral'],
            ['gatal', 'merah', 'bercak', 'Granuloma Annulare'],
            ['gatal', 'berair', 'kering', 'Keratolisis'],
            ['gatal', 'merah', 'melepuh', 'Penyakit Behçet'],
            ['gatal', 'bercak', 'putih', 'Penyakit Kawasaki'],
            ['gatal', 'merah', 'kering', 'Penyakit Lyme'],
            ['gatal', 'berair', 'bercak', 'Penyakit Autoimun'],
            ['gatal', 'merah', 'berbintik', 'Penyakit Celiac'],
            ['gatal', 'kering', 'putih', 'Penyakit Crohn'],
            ['gatal', 'merah', 'berair', 'Penyakit Refluks'],
            ['gatal', 'bercak', 'kering', 'Penyakit Psoriasis'],
            ['gatal', 'merah', 'melepuh', 'Penyakit Lupus'],
            ['gatal', 'berair', 'bercak', 'Penyakit Scleroderma'],
            ['gatal', 'merah', 'kering', 'Penyakit Dermatomiositis'],
            ['gatal', 'bercak', 'putih', 'Penyakit Eosinofilik'],
            ['gatal', 'merah', 'berbintik', 'Penyakit Sjögren'],
            ['gatal', 'kering', 'berair', 'Penyakit Takayasu'],
            ['gatal', 'merah', 'bercak', 'Penyakit Still'],
            ['gatal', 'berair', 'kering', 'Penyakit Behçet'],
            ['gatal', 'merah', 'kering', 'Penyakit Granuloma'],
            ['gatal', 'berair', 'bercak', 'Penyakit Dermatitis'],
            ['gatal', 'merah', 'kering', 'Penyakit Erythema'],
            ['gatal', 'bercak', 'putih', 'Penyakit Pemfigus'],
            ['gatal', 'merah', 'berbintik', 'Penyakit Lichen'],
            ['gatal', 'kering', 'berair', 'Penyakit Dermatitis Seboroik'],
            ['gatal', 'merah', 'bercak', 'Penyakit Erythema Multiforme'],
            ['gatal', 'berair', 'kering', 'Penyakit Pityriasis'],
            ['gatal', 'merah', 'melepuh', 'Penyakit Pemfigoid'],
            ['gatal', 'bercak', 'putih', 'Penyakit Dermatitis Atopik'],
            ['gatal', 'merah', 'berbintik', 'Penyakit Folikulitis'],
            ['gatal', 'kering', 'bercak', 'Penyakit Granuloma Annulare'],
            ['gatal', 'merah', 'berair', 'Penyakit Urtikaria'],
            ['gatal', 'berair', 'bercak', 'Penyakit Scleroderma'],
            ['gatal', 'merah', 'kering', 'Penyakit Psoriasis Guttata'],
            ['gatal', 'bercak', 'putih', 'Penyakit Vitiligo'],
            ['gatal', 'merah', 'berbintik', 'Penyakit Eczema'],
            ['gatal', 'kering', 'berair', 'Penyakit Dermatitis Perioral'],
            ['gatal', 'merah', 'bercak', 'Penyakit Granuloma'],
            ['gatal', 'berair', 'kering', 'Penyakit Keratolisis'],
            ['gatal', 'merah', 'melepuh', 'Penyakit Behçet'],
            ['gatal', 'bercak', 'putih', 'Penyakit Kawasaki'],
            ['gatal', 'merah', 'kering', 'Penyakit Lyme'],
            ['gatal', 'berair', 'bercak', 'Penyakit Autoimun'],
            ['gatal', 'merah', 'berbintik', 'Penyakit Celiac'],
            ['gatal', 'kering', 'putih', 'Penyakit Crohn'],
            ['gatal', 'merah', 'berair', 'Penyakit Refluks'],
            ['gatal', 'bercak', 'kering', 'Penyakit Psoriasis'],
            ['gatal', 'merah', 'melepuh', 'Penyakit Lupus'],
            ['gatal', 'berair', 'bercak', 'Penyakit Scleroderma'],
            ['gatal', 'merah', 'kering', 'Penyakit Dermatomiositis'],
            ['gatal', 'bercak', 'putih', 'Penyakit Eosinofilik'],
            ['gatal', 'merah', 'berbintik', 'Penyakit Sjögren'],
            ['gatal', 'kering', 'berair', 'Penyakit Takayasu'],
            ['gatal', 'merah', 'bercak', 'Penyakit Still'],
            ['gatal', 'berair', 'kering', 'Penyakit Behçet'],
            ['gatal', 'merah', 'kering', 'Penyakit Granuloma'],
        ];
    }

    public function index()
    {
        // Ambil hasil diagnosa dari session
        $diagnosis = Session::get('diagnosis', [
            'data' => [
                'nama' => 'Belum ada diagnosa',
                'keluhan' => 'Silakan lakukan konsultasi terlebih dahulu.'
            ],
            'results' => []
        ]);
        return view('home.diagnosa.index', [
            'data' => $diagnosis['data'],
            'diagnosisResults' => $diagnosis['results']
        ]);
    }


    public function diagnose(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'keluhan' => 'required|string',
        ]);

        // Memproses dataset menggunakan Algoritma C4.5 untuk mencari diagnosis terbaik
        $inputSymptoms = explode(' ', strtolower(trim($request->keluhan)));
        $diagnosisResults = $this->c45DecisionTree($inputSymptoms);

        // Simpan hasil dalam session
        Session::put('diagnosis', [
            'data' => $data, // Simpan data pengguna
            'results' => $diagnosisResults // Simpan hasil diagnosis
        ]);

        // Kirim email ke user dengan hasil diagnosis
        Mail::to($request->email)->send(new DiagnosisResult($data, $diagnosisResults));

        return redirect()->route('diagnose.index')->with('success', 'Diagnosa berhasil dilakukan. Hasil diagnosa telah dikirim ke email Anda.');
    }

    private function c45DecisionTree($inputSymptoms)
    {
        // Menghapus duplikat dari input gejala
        $inputSymptoms = array_unique($inputSymptoms);

        $matches = [];

        foreach ($this->dataset as $rule) {
            $ruleSymptoms = array_slice($rule, 0, count($rule) - 1);
            $matchingCount = count(array_intersect($inputSymptoms, $ruleSymptoms));
            $totalSymptoms = count($ruleSymptoms);

            if ($totalSymptoms > 0) {
                $percentageMatch = ($matchingCount / $totalSymptoms) * 100; // Hitung persentase kecocokan
                $diagnosis = end($rule); // Ambil diagnosis dari rule
                $matches[] = [
                    'diagnosis' => $diagnosis,
                    'percentage' => $percentageMatch,
                    'matchedSymptoms' => $matchingCount,
                    'totalSymptoms' => $totalSymptoms,
                    'ruleSymptoms' => $ruleSymptoms, // Simpan gejala dari rule
                ];
            }
        }

        // Urutkan berdasarkan persentase kecocokan tertinggi
        usort($matches, function ($a, $b) {
            return $b['percentage'] <=> $a['percentage'];
        });

        // Ambil top 3 diagnosis
        $topMatches = array_slice($matches, 0, 3);

        // Siapkan hasil untuk ditampilkan
        $result = [];
        foreach ($topMatches as $match) {
            // Buat alasan yang lebih detail
            $matchedSymptomsList = array_intersect($inputSymptoms, $match['ruleSymptoms']);
            $unmatchedSymptomsList = array_diff($match['ruleSymptoms'], $inputSymptoms);

            $reason = "Kecocokan {$match['matchedSymptoms']} dari {$match['totalSymptoms']} gejala. ";
            $reason .= "Gejala yang cocok: " . implode(", ", $matchedSymptomsList) . ". ";
            if (!empty($unmatchedSymptomsList)) {
                $reason .= "Gejala yang tidak cocok: " . implode(", ", $unmatchedSymptomsList) . ". ";
            } else {
                $reason .= "Semua gejala cocok dengan diagnosis ini. ";
            }

            $result[] = [
                'diagnosis' => $match['diagnosis'],
                'percentage' => round($match['percentage'], 2), // Pembulatan dua desimal
                'reason' => $reason,
            ];
        }



        return $result;
    }
}
