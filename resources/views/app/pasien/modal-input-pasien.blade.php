<div class="modal fade" id="modal_input_pasien" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Data Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" id="form_submit_pasien" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="select_jenis_pasien">
                                        <input label="Pasine ID" id="pasien_id" name="pasien_id" hidden />
                                        <x-check-box label="Pilih Jenis Pasien : ">
                                            <x-checkbox.item id="radio_1" value="anggota" name="radio"
                                                text="Dari Anggota" type="radio" color="primary" checked>
                                            </x-checkbox.item>
                                            <x-checkbox.item id="radio_2" value="lainnya" name="radio"
                                                text="Lainnya" type="radio" color="primary">
                                            </x-checkbox.item>
                                        </x-check-box>
                                    </div>

                                    <hr class="select_jenis_pasien" style="margin-bottom: 20px">
                                    <div class="select_jenis_anggota">
                                       <x-select2 id="select_jenis_anggota" label="Pilih Jenis Anggota"
                                       placeholder="Pilih Jenis Anggota" required>
                                       <option value="siswa">Siswa</option>
                                       <option value="personil">Personil</option>
                                   </x-select2>
                                    </div>
                            
                                    <!-- Horizontal Line -->
                                    <x-select2 id="select_user" label="Pilih Anggota" placeholder="Pilih Anggota"
                                        required>
                                        {{-- @foreach ($use as $item)
                                            <option data-jenis="{{ $item->jenis_anggota }}" value="{{ $item->id }}">
                                                {{ $item->nama }} - {{ $item->jenis_anggota }}</option>
                                        @endforeach --}}
                                    </x-select2>
                                    <x-input label="Nama Lengkap" id="nama" required />
                                    <x-datepicker id="tgl_lahir" label="Tanggal Lahir" required />
                                    <x-select2 required id="jenis_kelamin" label="Jenis Kelamin"
                                        placeholder="Pilih Jenis Kelamin">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </x-select2>
                                    <x-textarea id="alamat" label="Alamat" placeholder="Alamat Tempat Tinggal"
                                        required />
                                    <x-input-phone id="no_hp" label="Nomor HP" placeholder="Nomor Telepon Aktif" />
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <div class="d-flex">
                        <div class="mr-auto p-2">
                        </div>
                        <div class="p-2"> <button type="button" class="btn btn-default"
                                data-dismiss="modal">Tutup</button>
                        </div>
                        <div class="p-2">
                            <button id="btn_submit_pasien" type="submit" class="float-right btn btn-primary">Simpan </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
