<?php

namespace App\Http\Livewire\Admin\Ujian;

use App\Models\Nilai;
use App\Models\Ujian;
use Livewire\Component;
use App\Models\IkutUjian;
use Livewire\WithPagination;
use App\Jobs\GenerateSoalSiswa;
use Illuminate\Support\Facades\Auth;

class TableUjian extends Component
{
    use WithPagination;
    public $model = Ujian::class;
    public $name;

    public $perPage = 10;
    public $sortField = "ujians.id";
    public $sortAsc = false;
    public $search = '';
    protected $listeners = ["deleteItem" => "delete_item", "tutupModal" => "tutupModal", "ubahStatusUjian"];
    public $ujian, $jikaUpdate, $idsoal, $showSoal = [];

    public function openModal()
    {
        $this->dispatchBrowserEvent('openModal');
    }
    public function tutupModal()
    {
        $this->ujian = [];
        $this->dispatchBrowserEvent('tutupModal');
    }


    public function show($id)
    {
        $kls = $this->model::where('id','=',$id)->with(['kelasnya', 'mapel'])->first();

        $this->ujian = $kls->toArray();
        // dd($this->ujian);
        $this->openModal();
    }
    public function ubahStatusUjian(string $datanya)
    {
        $idnya = json_decode($datanya);
        $statusnya = $idnya->status;
        $dt = $this->model::find($idnya->data);
        if ($idnya->status) {
            $d['mapel_id'] = $dt->mapel_id;
            $d['ujian_id'] = $dt->id;
            $d['kelas_id'] = $dt->kelas_id;

            GenerateSoalSiswa::dispatch($d);
        }
        $dt->update([
            "status_ujian" => $statusnya
        ]);
    }
    public function delete_item($id)
    {
        $data = $this->model::find($id);
        $ij = IkutUjian::select('status')
            ->where('ujian_id', $id)
            ->where('status', true)
            ->count();
        $ni = Nilai::select('status_penilaian')
            ->where('ujian_id', $id)
            ->where('status_penilaian', true)
            ->count();
        // dd($ni);
        if ($data->status_ujian) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Tidak bisa menghapus Data! <b>Akses ujian masih terbuka!</b>"
            ]);
        } elseif ($ij > 0) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Tidak bisa menghapus Data! <b>Siswa sudah ada yang mengerjakan ujian!</b>"
            ]);
        }elseif ($ij > 0) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Tidak bisa menghapus Data! <b>Terdapat ujian siswa yang sudah dinilai!</b>"
            ]);
        } else {
            \DB::table('nilais')->where('ujian_id', $id)->delete();
            \DB::table('jawaban_ujians')->where('ujian_id', $id)->delete();
            \DB::table('ikut_ujians')->where('ujian_id', $id)->delete();
            $data->delete();
            $this->emit("deleteResult", [
                "status" => true,
                "message" => "Data berhasil dihapus!"
            ]);
        }
    }

    public function get_pagination_data()
    {
        $guru_id = Auth::user()->with('guru')->where('id', Auth::user()->id)->first()->guru->id;
        $soalnya = $this->model::search($this->search)
            ->select(
                [
                    'ujians.id as id',
                    'mapels.nama_mapel as mapel',
                    'mapels.id as mapelid',
                    'ujians.judul as judul',
                    'ujians.jenis_ujian as jenis_ujian',
                    'kelas.nama_kelas as nama_kelas',
                    'ujians.status_ujian as status_ujian'
                ]
            )
            ->join('mapels', 'mapels.id','=','ujians.mapel_id')
            ->join('kelas', 'kelas.id','=','ujians.kelas_id')
            ->join('gurus', 'gurus.id','=','ujians.guru_id')
            ->where('ujians.guru_id','=',$guru_id)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return [
            "view" => 'livewire.admin.ujian.table-ujian',
            "ujians" => $soalnya
        ];
    }

    public function mount()
    {
        $kls = $this->model::with(['kelasnya', 'mapel'])->first();
        if ($kls != null) {
            $this->ujian = $kls->toArray();
        } else {
            $this->ujian['mapel']['nama_mapel'] = null;
            $this->ujian['kelasnya']['nama_kelas'] = null;
            $this->ujian['judul'] = null;
            $this->ujian['jenis_ujian'] = null;
            $this->ujian['tgl_mulai_ujian'] = null;
            $this->ujian['waktu_mulai_ujian'] = null;
            $this->ujian['tgl_selesai_ujian'] = null;
            $this->ujian['waktu_selesai_ujian'] = null;
            $this->ujian['code_ujian'] = null;
        }
    }
    public function render()
    {
        $data = $this->get_pagination_data();
        // dd($data['ujians']);
        return view($data['view'], $data);
    }
}
