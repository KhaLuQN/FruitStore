<div class="filer">
    <div class="perpage">
        <form id="perpage-form" method="GET" action="{{ route('products.index') }}">
            <select name="perpage" class="form-control input-sm perpage filter mr10" id="perpage">
                @for($i = 20; $i <= 140; $i += 20)
                    <option value="{{ $i }}" {{ request('perpage') == $i ? 'selected' : '' }}>
                        {{ $i }} bản ghi
                    </option>
                @endfor
            </select>
            <!-- Giữ lại các tham số truy vấn khác -->
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="group" value="{{ request('group') }}">
        </form>
    </div>
    <form id="group-form" method="GET" action="{{ route('products.index') }}" class="mt10">
        
        <div class="action">
            <div class="uk-flex uk-flex-middle">
                <select name="group" class="form-control mr10" id="group" onchange="submitGroupForm()">
                    <option value="0" {{ request('group') == 0 ? 'selected' : '' }}>Tất cả</option>
                    <option value="1" {{ request('group') == 1 ? 'selected' : '' }}>Sản Phẩm nội địa</option>
                    <option value="2" {{ request('group') == 2 ? 'selected' : '' }}>Sản Phẩm ngoại địa</option>
                    
                </select>
            </div>
        </div>
    </form>
    <form method="GET" action="{{ route('products.index') }}">
        <div class="search mt10">
            <input type="text" name="search" class="form-control mr10" id="search" placeholder="Tìm kiếm..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary" id="search-btn">Tìm kiếm</button>
        </div>
    </form>
    
    
</div>
