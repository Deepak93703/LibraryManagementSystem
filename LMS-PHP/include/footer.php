<?php include_once('../config/config.php') ?>

<script src="<?php echo BASE_URL ?>assets/js/jquery-3.7.1.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/dataTables.bootstrap5.js"></script>
<script src="https://kit.fontawesome.com/b24a136d5d.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</body>

</html>