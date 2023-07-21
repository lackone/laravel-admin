@extends('admin.layouts.sub')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form id="form" method="post" action="{{ route('admin.user.set_role', $admin['id']) }}">
                @csrf
                <div class="mb-3">
                    <label for="account" class="form-label">账号</label>
                    <input type="text" class="form-control" id="account" name="account" value="{{ $admin['account'] }}"
                           readonly disabled>
                </div>
                <div class="mb-3">
                    <label for="role_ids" class="form-label">角色</label>
                    <div class="col">
                        <div class="col col-3">
                            <select name="role_ids[]" id="role_ids" class="select2" multiple>
                                @foreach($role_list as $key => $value)
                                    <option value="{{ $key }}" {{ in_array($key, $role_ids) ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">修改</button>
            </form>
        </div>
    </div>
@endsection

@section('myjs')
    <script>

    </script>
@endsection
