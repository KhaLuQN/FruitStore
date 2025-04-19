<form action="{{ route('discount.store') }}" method="POST">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight ecommerce" style="padding-bottom: 120px">
        <fieldset class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">CODE:</label>
                <div class="col-sm-10">
                    <input type="text" name="code" class="form-control" placeholder="CODE" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Giảm (%):</label>
                <div class="col-sm-10">
                    <input type="text" name="percentage" class="form-control" placeholder="%" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Số lượng:</label>
                <div class="col-sm-10">
                    <input type="text" name="quantity" class="form-control" placeholder="00" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Ngày Bắt đầu:</label>
                <div class="col-sm-10">
                    <input type="date" name="start_date" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Ngày kết thúc:</label>
                <div class="col-sm-10">
                    <input type="date" name="end_date" class="form-control" required>
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
