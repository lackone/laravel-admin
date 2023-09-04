<label for="{{ $name }}" class="{{ $label_class ?? 'form-label' }}">{{ $label }}</label>
<div class="col">
    <select class="form-control select2" name="{{ $name }}" {{ $multiple ?? '' }}>
        @if(!$multiple)
            <option value="">请选择</option>
        @endif
        @if($list)
            @foreach($list as $k => $v)
                <option value="{{ $k }}" {{ ($k == $data || in_array($k, (array)$data)) ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        @endif
    </select>
</div>
