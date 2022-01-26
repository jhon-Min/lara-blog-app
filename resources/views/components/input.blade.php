<lable class="form-label">{{ $title }}</lable>
<input type="text" class="form-control @error($name)
    is-invalid
@enderror" name="{{ $name }}" value="{{ old($name,$default) }}">
@error($name)
    <span class="small text-danger">{{ $message }}</span>
@enderror
