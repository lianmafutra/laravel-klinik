<div class="form-group">
   <label>{{ $label }}
      @if ($attributes['required'] == 'true')
          <span style="color: red">*</span>
      @endif
  </label>
    <input id="{{ $id }}" class="form-control input input-number" name="{{ $name }}" type='number'
        value="" {{ $attributes }}>
    <span class="text-danger error error-text {{ $id }}_err"></span>
</div>
{{--  --}}