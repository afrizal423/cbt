<?php

namespace App\Http\Controllers\ExportData;

use App\Models\Ujian;
use Illuminate\Support\Str;
use Laraindo\TanggalFormat;
use Illuminate\Http\Request;
use App\Models\Nilai as TbNIlai;
use App\Exports\ExportNilaiUjian;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class Nilai extends Controller
{
    private function proses_word(string $Ujian_id): string
    {
        $u = Ujian::with(['nilais','nilais.siswa'])->withCount('nilais as jumlahsiswa')->where('id', $Ujian_id)->first()->toArray();
        // dd($u);
        $templateProcessor = new TemplateProcessor(public_path('export_data/daftarNilaiSiswaUjian.docx'));
        $templateProcessor->setValue('namaUjian', $u['judul']);
        $tgl = $u['tgl_mulai_ujian'].' '.$u['waktu_mulai_ujian'];
        $templateProcessor->setValue('waktuMulaiUjian', TanggalFormat::DateIndo($tgl));

        // inisialisasi jumlah setiap row
        $templateProcessor->cloneRow('siswaNISN', $u['jumlahsiswa']); // ini PK/unique harus ada, oarams kedua itu jumlah seluruh data yg ingin dimasukkan ke word

        foreach ($u['nilais'] as $key => $value) {
            $templateProcessor->setValue('no#'.$key+1, $key+1);
            $templateProcessor->setValue('siswaNISN#'.$key+1, $value['siswa']['nisn']);
            $templateProcessor->setValue('siswaNama#'.$key+1, $value['siswa']['nama_siswa']);
            $templateProcessor->setValue('siswaNilai#'.$key+1, $value['nilai_ujian']);
        }

        $templateProcessor->setValue('tglBulanTahunNow', TanggalFormat::DateIndo(date("j F Y"),'j F Y'));
        $templateProcessor->setValue('namaGuru', '..................');

        // echo date('H:i:s'), ' Saving the result document...', PHP_EOL;
        $save_file_name = 'Ujian-'.Str::slug($u['judul']).'-'.date('dmy-His').'.docx';
        $templateProcessor->saveAs(storage_path($save_file_name));
        return $save_file_name;
    }

    public function to_pdf($Ujian_id)
    {
        $save_file_name = $this->proses_word($Ujian_id);
        $tmp = explode('.', $save_file_name);
        $nama_baru = $tmp[0].'.pdf';
        shell_exec('/usr/bin/libreoffice --headless --convert-to pdf '.storage_path($save_file_name).' --outdir '.storage_path().' '.storage_path($nama_baru));
        // hapus file doc lama
        unlink(storage_path($save_file_name));
        return response()->download(storage_path($nama_baru))->deleteFileAfterSend(true);
    }

    public function to_word($Ujian_id)
    {
        $save_file_name = $this->proses_word($Ujian_id);
        return response()->download(storage_path($save_file_name))->deleteFileAfterSend(true);
    }

    public function to_excel($Ujian_id)
    {
        $u = Ujian::with(['nilais','nilais.siswa'])->where('id', $Ujian_id)->first();
        $data = [];
        foreach ($u->nilais as $key => $value) {
            $tmp = [];
            array_push($tmp, $key+1);
            array_push($tmp, $value->siswa->nisn);
            array_push($tmp, $value->siswa->nama_siswa);
            array_push($tmp, $value->nilai_ujian);
            array_push($data, $tmp);
        }
        // dd($data);
        $save_file_name = 'Ujian-'.Str::slug($u->judul).'-'.date('dmy-His').'.xlsx';
        return Excel::download(new ExportNilaiUjian($data), $save_file_name);
    }
}
