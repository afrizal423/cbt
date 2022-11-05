<?php

namespace Database\Seeders;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Ujian;
use Rorecek\Ulid\Ulid;
use Illuminate\Database\Seeder;
use App\Models\SoalnyaSiswaUjian;

class IkutUjiansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $ujian = Ujian::all();
        \DB::table('ikut_ujians')->delete();

        foreach ($ujian as $key1 => $u) {
            $siswa = Siswa::where('kelas_id', $u->kelas_id)->get();
            foreach ($siswa as $key => $sswa) {
                $ulid = new Ulid;
                \DB::table('ikut_ujians')->insert(array (
                        'id' => $ulid->generate(),
                        'siswa_id' => $sswa->id,
                        'ujian_id' => $u->id,
                        'status' => true,
                        'sudah_ujian' => false,
                ));
                // inisialisasi nilai null
                Nilai::updateOrCreate([
                    'siswa_id' => $sswa->id,
                    'ujian_id' => $u->id
                ],[
                    'nilai_ujian' => 0,
                    'status_penilaian' => false
                ]);

                // proses insert pengacakan soal
                $ujians = Ujian::select('mapel_id')->with([
                    'mapel' => function($q){
                        $q->select('id');
                        $q->with(
                            [
                                'soals' => function($q){
                                    $q->inRandomOrder();// jika random. klo gak hapus aja
                                    $q->select('id', 'mapel_id');
                                }
                            ]
                        );
                    }
                ])->where('id', $u->id)->first()->toArray();
                $data = [];
                foreach ($ujians['mapel']['soals'] as $key => $value) {
                    array_push($data, $value['id']);
                }
                // echo '<pre>' . var_export($data, true) . '</pre>';
                // echo json_encode($data);
                SoalnyaSiswaUjian::updateOrCreate([
                    'siswa_id' => $sswa->id,
                    'ujian_id' => $u->id],
                    ['listsoal' => json_encode($data)]
                );
            }
        }








    }
}
