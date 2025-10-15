
<script src="<?php echo BASE_URL ?>assets/js/jquery-3.7.1.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/dataTables.bootstrap5.js"></script>
<script src="https://kit.fontawesome.com/b24a136d5d.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    setTimeout(function() {
        var alertNode = document.querySelector('.alert');
        if (alertNode) {
            // Bootstrap 5 method to remove alert
            var bsAlert = new bootstrap.Alert(alertNode);
            bsAlert.close();
        }
    }, 3000);
</script>


</body>

</html>