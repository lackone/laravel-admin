<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<div class="col">
    <select class="selectpicker" name="{{ $name }}">
        <option value="0">无</option>
        @if($list)
            @foreach($list as $k => $v)
                <option value="{{ $v['id'] }}" {{ $v['id'] == $data ? 'selected' : '' }}>{{ $v['title'] }}</option>
                @if($v['children'])
                    @foreach($v['children'] as $kk => $vv)
                        <option value="{{ $vv['id'] }}" {{ $vv['id'] == $data ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $vv['title'] }}</option>
                        @if($vv['children'])
                            @foreach($vv['children'] as $kkk => $vvv)
                                <option value="{{ $vvv['id'] }}" {{ $vvv['id'] == $data ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $vvv['title'] }}</option>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>

