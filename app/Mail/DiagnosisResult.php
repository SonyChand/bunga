<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DiagnosisResult extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $diagnosisResults; // Tambahkan properti untuk hasil diagnosis

    public function __construct($data, $diagnosisResults)
    {
        $this->data = $data;
        $this->diagnosisResults = $diagnosisResults; // Simpan hasil diagnosis
    }

    public function build()
    {
        return $this->subject('Hasil Diagnosa Anda')
            ->view('emails.diagnosis_result')
            ->with([
                'data' => $this->data,
                'diagnosisResults' => $this->diagnosisResults, // Kirim hasil diagnosis ke tampilan
            ]);
    }
}
