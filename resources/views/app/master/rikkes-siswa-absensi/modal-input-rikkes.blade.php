<div class="modal fade" id="modal_input_rikkes" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Pemeriksaan Rikkes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" id="form_input_rikkes" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <x-input label="" id="rikkes_siswa_jadwal_id" placeholder="" hidden />
                                <x-input label="" id="user_id" placeholder="" hidden />
                                <x-input label="" id="rikkes_siswa_absensi_id" placeholder="" hidden />
                                <div class="col-md-12">
                                    <x-input label="Nama" id="nama" placeholder="" disabled />
                                    <x-input label="Nosis" id="nosis" placeholder="" disabled />
                                    <x-input label="TENSI" id="tensi" name="tensi" placeholder="" info=""
                                        required />
                                    <x-input-float label="TINGGI (cm)" id="tinggi" name="tinggi" placeholder=""
                                        info="" required />
                                    <x-input-float label="BB (Kg)" id="bb" placeholder="" name="bb"
                                        info="" required />
                                    <x-input-float label="IMT ( Indeks Massa Tubuh )" id="imt" placeholder=""
                                        name="imt" info="Info : Otomatis Terisi, BB/(tinggi x tinggi)" required />
                                    <x-input label="Keterangan IMT" id="ket_imt" placeholder="" name="ket_imt"
                                        info="" disabled />
                                    <x-input-float label="NILAI" id="nilai" placeholder="" name="nilai"
                                        info="" />
                                    <x-textarea label="Keterangan" id="keterangan" placeholder="" name="keterangan"
                                        info="" />
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
<script>
 
</script>
