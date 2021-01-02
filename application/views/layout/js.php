<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('asset/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('asset/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('asset/js/sb-admin-2.min.js') ?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('asset/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('asset/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('asset/js/demo/datatables-demo.js') ?>"></script>

<!-- Custom Page JS -->
<script>
    function hapusData(link) {
        $('#deleteModal').modal('show');
        $('#btn-hapus').attr('href', link)
    }
</script>