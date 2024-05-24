<div class="modal fade" id="modal_reset_password">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Reset Password User</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_reset_password">
                @csrf
                <div class="modal-body">
                    <p>Apakah anda yakin Mereset Password User <span style="font-weight: bold" class="username"></span>
                        ? (Password Default : 123456)</p>
                    <div class="form-group">
                        <input autocomplete="off" hidden  name="user_id"></input>
                        <x-input-password id="password" placeholder="Password Baru" label="Password" value="123456"  info=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ok Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
</script>