<!-- index -->
<script>
    function cariData() {
        var awal = $('#awal').val()
        var akhir = $('#akhir').val()
        var jenis = $('#jenis').val()
        window.location = "<?php echo base_url('laporanpesanan') ?>" + "/?awal=" + awal + "&akhir=" + akhir + "&jenis=" + jenis;
    }
</script>