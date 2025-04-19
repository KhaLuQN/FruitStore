<div class="filer">
    <div class="perpage">
        <form id="perpage-form" method="GET" action="{{ route('user.index') }}">
            <select name="perpage" class="form-control input-sm perpage filter mr10" id="perpage">
                @for ($i = 20; $i <= 140; $i += 20)
                    <option value="{{ $i }}" {{ request('perpage') == $i ? 'selected' : '' }}>
                        {{ $i }} bản ghi
                    </option>
                @endfor
            </select>

            <input type="hidden" name="search" value="{{ request('search') }}">

        </form>
    </div>
    <form id="group-form" method="GET" action="{{ route('user.index') }}" class="mt10">

    </form>
    <form method="GET" action="{{ route('user.index') }}">
        <div class="search mt10">
            <input type="text" name="search" class="form-control " id="search" placeholder="Tìm kiếm..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-w-m btn-primary" id="search-btn">Tìm </button>
        </div>
    </form>
    <form method="GET" action="{{ route('user.index') }}">
        <div class="search mt10">
            <input type="text" name="search_id" class="form-control " id="search" placeholder="Nhập id người dùng"
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-w-m btn-primary " id="search-btn">Tìm</button>
        </div>
    </form>

    <div id="overlay" class="overlay"></div>

</div>
