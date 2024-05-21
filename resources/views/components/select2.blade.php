
    <div class="form-group"  name="{{ $name }}">
      <label>{{ $label }}
         @if ($attributes['required'] == 'true')
             <span style="color: red">*</span>
         @endif
     </label>
        <select id="{{ $id }}" name="{{ $name }}"
            class="select2 select2-{{ $id }} form-control select2bs4"
            data-placeholder="-- {{ $attributes['placeholder'] }} --" style="width: 100%;" {{ $attributes }}>
            <option></option>
            {{ $slot }}
        </select>
        <span class="text-danger error-text {{ $id }}_err"></span>
    </div>

