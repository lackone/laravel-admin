<label for="{{ $name }}{{ array_keys($list)[0] }}" class="form-label">{{ $label }}</label>
<div>
    @if($list)
        @foreach($list as $key => $value)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ $name }}{{ $key }}"
                       value="{{ $key }}"
                    {{ $key == $data ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $name }}{{ $key }}">{{ $value }}</label>
            </div>
        @endforeach
    @endif
</div>
