<div class="form-group">
   <label>{{ $label }}
      @if ($attributes['required'] == 'true')
          <span style="color: red">*</span>
      @endif
  </label>
  <input  spellcheck="false" class="form-control input" type="number" id="{{ $id }}" name="{{ $name ?? "" }}" step="0.01" pattern="\d+(\.\d{1,2})?" value="" {{ $attributes }}>
  <small style="font-style: italic; margin-bottom: 10px">{{ $info ?? "" }}</small> 
  <span class="text-danger error error-text {{ $id }}_err"></span>
</div>

