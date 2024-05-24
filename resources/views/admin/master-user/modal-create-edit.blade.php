<div class="modal fade" id="modal_create_edit_user">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
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
                                 <input autocomplete="off" hidden name="user_id"></input>
                                    <x-input id='username'  name='username' placeholder='Username Login'  label='Username' required='true' />
                                    <x-input id='name' name='name' placeholder='Nama Lengkap user'  label='Nama Lengkap' required='true'  />
                                    <x-input-number id='kontak' name='kontak'  label='Kontak'  placeholder="Kontak User" />
                                    {{-- <x-input id='email' name='email' placeholder='Email'  label='Email' required='false'  /> --}}
                                   
                                    <x-select2 id="role" name='role' label='Select Role' required="true" placeholder='Select Role User'>
                                       @foreach ($roles as $item)
                                           <option value='{{ $item->name }}'>{{ $item->name }}</option>
                                       @endforeach
                                   </x-select2>
                                   {{-- <small>Password Default Untuk Login : 123456</small> --}}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_action" type="submit" class="float-right btn btn-primary">Save</button>

                </div>
            </form>
        </div>
    </div>
</div>
