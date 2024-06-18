<div class="modal fade" id="modal_upload_excel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Data Siswa Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" id="form_upload_excel" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="callout callout-info">
                                        <h5>Info</h5>
                                        <p>Pastikan Upload File Excel Sesuai Dengan Template file Berikut ini : </p>
                                        <a href="{{ asset('file/template_siswa.xlsx') }}">Download Template</a>
                                    </div>
                                    <div class="form-group">
                                        <label for="file">File Excel Data Siswa :</label>
                                        <input type="file" name="file" id="file"class="form-control"
                                            required>
                                    </div>
                                    <x-select2 required id="angkatan" label="Pilih Angkatan"
                                        placeholder="Pilih Angkatan">
                                        @foreach ($angkatan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </x-select2>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="btn_action" type="submit" class="float-right btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
