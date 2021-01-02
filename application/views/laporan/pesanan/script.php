<!-- index -->
<script>
    function cariData() {
        var awal = $('#awal').val()
        var akhir = $('#akhir').val()
        window.location = "<?php echo base_url('laporanpenjualan') ?>" + "/?awal=" + awal + "&akhir=" + akhir;
    }
</script>