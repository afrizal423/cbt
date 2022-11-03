<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Ujian;
use Rorecek\Ulid\Ulid;
use Illuminate\Database\Seeder;

class JawabanUjiansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('jawaban_ujians')->delete();

        // loop ujian
        // diwaktu loop ujian relasikan dgn kelas.
        // panggil query siswa where kelas_id
        // loop siswa
        // yg pntng siswaId sama ujian_id harus berbeda.

        $u = Ujian::with('kelasnya')->get();
        foreach ($u as $key => $value) {
            $siswa = Siswa::where('kelas_id', $value->kelas_id)->get();
            foreach ($siswa as $key => $valsis) {
                $ulid = new Ulid;
                \DB::table('jawaban_ujians')->insert(array (
                    0 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g7335jr5y1bs76ge2te5efb3',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"01g7334vpy69cawhsytshg9ec4"',
                        'bobot_nilai' => '10',
                        'ragu_jawaban' => false,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '10',
                        'data_rekomendasi_nilai' => NULL,
                    ),
                    1 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g7362t3yn9qqn8mxy5xj24s8',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"gambaran keseluruhan dari paragraf"',
                        'bobot_nilai' => '10',
                        'ragu_jawaban' => true,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '10',
                        'data_rekomendasi_nilai' => '[{"text":"gambaran keseluruhan dari sebuah paragraf","similarity":1},{"text":"Ide pokok bacaan berfungsi untuk menjelaskan inti atau pokok pembahasan utama dari suatu paragraf","similarity":0.06054936462149973},{"text":"Ide pokok bacaan adalah ide yang menjadi pokok atau pikiran utama dalam mengembangkan paragraf suatu bacaan","similarity":0.05709245287522211}]',
                    ),
                    2 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g735fxanwmxsydzh8yqbd6f3',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"01g735cwq6v85ttd741et0pk3n"',
                        'bobot_nilai' => '10',
                        'ragu_jawaban' => false,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '10',
                        'data_rekomendasi_nilai' => NULL,
                    ),
                    3 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g735pvg27nnd491j2bj1ctev',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"kalimat yang berisi ide pokok"',
                        'bobot_nilai' => '5',
                        'ragu_jawaban' => true,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '5',
                        'data_rekomendasi_nilai' => '[{"text":"Kalimat ini diartikan sebagai kalimat yang mengandung pokok pikiran paragraf","similarity":0.1786972569536653},{"text":"kalimat yang berisi ide pokok atau ide utama paragraf","similarity":0.5400123534870788},{"text":"kalimat jabaran yang isinya penjebaran dari pokok pikiran tersebut","similarity":0.3488810801322895},{"text":"Kalimat utama adalah kalimat yang berada di awal paragraf","similarity":0.08521932550520887}]',
                    ),
                    4 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g732vctje9f7j72xj5m1hj7k',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"01g732sftj1w4bq9jd00xjc2xm"',
                        'bobot_nilai' => '10',
                        'ragu_jawaban' => false,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '10',
                        'data_rekomendasi_nilai' => NULL,
                    ),
                    5 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g7330hg18mh4mt8x5zt9xqvp',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"01g732xhxshtk694ncpyffveh8"',
                        'bobot_nilai' => '10',
                        'ragu_jawaban' => false,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '10',
                        'data_rekomendasi_nilai' => NULL,
                    ),
                    6 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g7333r7d726ryh3twg5q38jm',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"01g7332yngcqkggn7w50wrs2dt"',
                        'bobot_nilai' => '10',
                        'ragu_jawaban' => false,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '10',
                        'data_rekomendasi_nilai' => NULL,
                    ),
                    7 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g735rzyztses2fm78rgxm6ec',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"membaca dengan seksama"',
                        'bobot_nilai' => '10',
                        'ragu_jawaban' => true,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '10',
                        'data_rekomendasi_nilai' => '[{"text":"Membaca judul teks","similarity":0.19905123822737344},{"text":"Membaca teks dengan cermat.","similarity":0.19905123822737344},{"text":"Menentukan ide pokok setiap paragra","similarity":0},{"text":"Menandai kata kunci","similarity":0},{"text":"membaca dengan seksama","similarity":1}]',
                    ),
                    8 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g735txk7r0w6d14d30tqp1zb',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"Kalimat utama bisa berada di awal sebuah paragraf"',
                        'bobot_nilai' => '8',
                        'ragu_jawaban' => true,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '8',
                        'data_rekomendasi_nilai' => '[{"text":"Kalimat utama bisa berada di awal atau akhir sebuah paragraf.","similarity":0.7795729685029128},{"text":"Menemukan kalimat utama yang berisi gagasan pokok.","similarity":0.16475708389497723},{"text":"Membedakan kalimat utama dan penjelas.","similarity":0.21923440971541877},{"text":"Mengetahui jenis paragraf.","similarity":0.11946078283645291},{"text":"Membaca secara intensif isi paragraf, menentukan kalimat utama pada paragraf, menentukan unsur inti kalimat utama","similarity":0.1416064474587855}]',
                    ),
                    9 =>
                    array (
                        'id' => $ulid->generate(),
                        'soal_id' => '01g735zf1wn3n3a25y8vq8vmg3',
                        'siswa_id' => $valsis->id,
                        'ujian_id' => $value->id,
                        'jawaban_siswa' => '"gambaran keseluruhan dari paragraf"',
                        'bobot_nilai' => '10',
                        'ragu_jawaban' => true,
                        'selesai_ujian' => NULL,
                        'rekomendasi_bobot_nilai' => '10',
                    'data_rekomendasi_nilai' => '[{"text":"gambaran keseluruhan dari suatu paragraf","similarity":1},{"text":"ide\\/gagasan yang menjadi pokok pengembangan paragraf. Gagasan utama terdapat di kalimat utama dan setiap paragraf hanya memiliki satu ide pokok. Berdasarkan letaknya, kalimat utama bisa terdapat pada awal paragraf (paragraf deduktif), akhir paragraf (paragraf induktif), dan awal sekaligus akhir paragraf (Campuran).","similarity":0.021960622481149737},{"text":"Gagasan Utama atau ide pokok merupakan pernyataan yang menjadi inti pembahasan. Gagasan utama terdapat pada kalimat utama dalam setiap paragraf. Letaknya biasanya terdapat pada awal atau akhir paragraf","similarity":0.03620216168368331}]',
                    ),
                ));
            }
        }

    }
}
