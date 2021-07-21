<div class="form-group col-lg-{{ $col }}">
    <label class="form-label" for="{{ $attr }}">{!!  $label  !!}</label>
    <br>
    <textarea id="{{ $id }}" name="{{$attr}}"  id="default-textarea" style="width: 400px; height: 300px"></textarea>

    @error($attr)
    <span class="invalid-feedback d-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


