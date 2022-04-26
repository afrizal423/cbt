{{-- Table custom menambahkan tombol tambah data maupun tombol lain  --}}
<div class="card">
    {{ $inputdata }}
</div>
<div class="card">
    <div class="p-8 pt-4 mt-2" x-data="window.__controller.dataTableMainController()" x-init="setCallback();" style="margin: 20px">
        <div class="row mb-4">
            <div class="col form-inline">
                Per Halaman: &nbsp;
                <select wire:model="perPage" class="form-control">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>25</option>
                </select>
            </div>

            <div class="col">
                <input wire:model="search" class="form-control" type="text" placeholder="Pencarian...">
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        {{ $head }}
                    </thead>
                    <tbody>
                        {{ $body }}
                    </tbody>
                </table>
            </div>
        </div>

        <div id="table_pagination" class="py-3">
            {{ $model->links('vendor.livewire.bootstrap') }}
        </div>
    </div>
</div>

