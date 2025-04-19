<!-- Mainly scripts -->

<script src="backend/js/bootstrap.min.js"></script>
<script src="backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- jQuery UI -->
<script src="backend/library/library.js"></script>
<script src="backend/js/simple.money.format.js"></script>
<script src="backend/js/plugins/jquery-ui/jquery-ui.min.js"></script>
@foreach ($config['js'] as $key => $val)
    {!! '<script src="' . $val . '"></script>' !!}
@endforeach

<script>
    $('.money').simpleMoneyFormat();


    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.view-details').forEach(function(button) {
            button.addEventListener('click', function() {
                var targetId = this.getAttribute('data-target')
                var targetRow = document.querySelector(targetId)

                targetRow.style.display = targetRow.style.display === 'none' ? '' : 'none'
            })
        })
    })
</script>
