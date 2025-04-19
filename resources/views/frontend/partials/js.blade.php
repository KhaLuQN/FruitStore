<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>


<script src="js/simple.money.format.js"></script>
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
