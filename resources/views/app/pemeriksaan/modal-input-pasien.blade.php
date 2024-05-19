<div class="modal fade" id="modal_input_pasien">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Data Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" id="form_modal_create_edit" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <x-select2 id="select_user" label="Pilih Pasien" placeholder="Pilih Pasien">
                                        @foreach ($anggota as $item)
                                            <option value="{{ $item->id }}"> {{ $item->nama }} -
                                                {{ $item->nik }} - {{ $item->nrp }}</option>
                                        @endforeach
                                    </x-select2>
                                    <table class="table table-bordered display text-xs" style="width:100%">
                                        <tr>
                                            <th>Nama Lengkap:</th>
                                            <td id="nama"></td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td id="nik"></td>
                                        </tr>
                                        <tr>
                                            <th>NRP</th>
                                            <td id="nrp"></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td id="alamat"></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td id="jenis_kelamin"></td>
                                        </tr>
                                        <tr>
                                            <th>Pangkat/Jabatan</th>
                                            <td id="pangkat_jabatan"></td>
                                        </tr>
                                        <tr>
                                            <th>No HP</th>
                                            <td id="no_hp"></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Anggota</th>
                                            <td id="jenis"></td>
                                        </tr>
                                        <tr>
                                            <th>No BPJS</th>
                                            <td id="no_bpjs"></td>
                                        </tr>
                                    </table>
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
                            <button id="btn_action" type="submit" class="float-right btn btn-primary">Input
                                Pasien</button>
                        </div>

                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
