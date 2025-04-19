<form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>{{ config('apps.user.title') }}</h2>
            <ol class="breadcrumb" style="margin-bottom: 10px">
                <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li><strong><a href="{{ route('user.index') }}">{{ config('apps.user.title') }}</a></strong></li>
                <li><strong><a href="{{ route('user.create') }}">{{ config('apps.user.table2') }}</a></strong></li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight ecommerce" style="padding-bottom: 120px">
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" placeholder="User name"
                        value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" placeholder="example@domain.com"
                        value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Password:</label>
                <div class="col-sm-10">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Phone:</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Cấp bậc</label>
                <div class="col-sm-10">
                    <select name="role" class="form-control" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>

                    </select>
                </div>
            </div>
        </fieldset>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-white" type="reset">Cancel</button>
                <button class="btn btn-primary" type="submit">Save changes</button>
            </div>
        </div>
    </div>
</form>
