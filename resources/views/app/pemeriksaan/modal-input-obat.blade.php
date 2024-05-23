<div class="modal fade" id="modal_input_obat">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Data Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" id="form_input_obat" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                 <x-input label="" id="pemeriksaan_obat_id" hidden />
                                    <x-select2 id="select_obat" label="Data Obat" placeholder="Pilih Obat" required>
                                        @foreach ($obat as $item)
                                            <option value="{{ $item->id }}">{{ $item->kode_obat }} -
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </x-select2>
                                    <x-input-number label="Sisa Stok " id="stok" placeholder="" disabled />
                                    <x-input label="Tgl Expired" id="tgl_expired" placeholder="" disabled />
                                    <x-input-number label="Harga " id="harga" placeholder="" disabled/>
                                    <x-input-number label="Jumlah " id="jumlah" placeholder="" required/>
                                    <x-input-number label="Dosis Perhari" id="dosis_perhari" placeholder="" />
                                    <x-input label="Keterangan" id="keterangan_obat" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="btn_action" type="submit" class="float-right btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
