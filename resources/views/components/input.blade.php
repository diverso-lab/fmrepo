<div class="form-group col-lg-{{ $col }} {{$class}}">
        <label class="form-label" for="{{ $attr }}">{!!  $label  !!}</label>
        <input id="{{ $id }}" type="{{ $type }}"

               class="form-control "

               placeholder="{{ $placeholder }}"
               @error($attr) is-invalid @enderror
               name="{{ $attr }}"

               @if(old($attr))
               value="{{ old($attr) }}"
               @else
               value="{{$value}}"
               @endif

               @if($required)
               required
               @endif

               autocomplete="{{ $attr }}" autofocus

               @if($edit == true)
               @if($disabled == true)
               disabled
                @endif
                @endif

        >

        <small class="form-text text-muted">{{ $description }}</small>

        @error($attr)
        <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
        @enderror
</div>


