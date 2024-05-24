<div class="modal fade" id="modal_input_rikkes">
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
                                <div class="col-md-12">     
                                    <x-input label="" id="rikkes_siswa_jadwal_id" placeholder=""  hidden  />  
                                    <x-input label="" id="user_id" placeholder="" hidden  />

                                    <x-input label="Nama" id="nama" placeholder="" disabled />
                                    <x-input label="Nosis" id="nosis" placeholder="" disabled />
                                    <x-input-float label="TENSI" id="tensi" placeholder="" info="" />
                                    <x-input-float label="TINGGI" id="tinggi" placeholder=""  info=""/>
                                    <x-input-float label="BB" id="bb" placeholder="" info=""/>
                                    <x-input-float label="IMT" id="imt" placeholder="" info=""/>
                                    <x-input-float label="NILAI" id="nilai" placeholder="" info=""/>
                                    <x-textarea  label="Keterangan" id="keterangan" placeholder="" info=""/>
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
