<div class="modal fade" id="modal_penyesuaian_stok">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Data Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" id="form_penyesuaian_stok" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <x-select2 id="obat" label="Data Obat" placeholder="Pilih Obat">
                                        @foreach ($obat as $item)
                                            <option value="{{ $item->id }}">{{ $item->kode_obat }} -
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </x-select2>
                                    <x-input-number label="Sisa Stok " id="stok" placeholder="" />
                                    <x-input-number label="Harga " id="harga" placeholder="" />
                                    <x-input-number label="Jumlah " id="jumlah" placeholder="" />
                                    <x-input-number label="Dosis Perhari" id="dosis_perhari" placeholder="" />
                                    <x-input label="Keterangan" id="keterangan_obat" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="btn_action" type="submit" class="float-right btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
