<div class="form-group col-lg-{{ $col }}">
    <label class="form-label" for="{{ $attr }}">{!!  $label  !!}</label>

    <textarea id="{{ $id }}" class="form-control form-control-simple no-resize" id="default-textarea"></textarea>

    @error($attr)
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


