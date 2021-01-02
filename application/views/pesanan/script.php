<!-- index -->
<script>
    $(document).ready(function() {
        $('#barangTable').DataTable();

        $('#dataTable2').DataTable();

        $('input[type=number]').on('mousewheel', function(e) {
            $(e.target).blur();
        });

        <?php if ($this->session->flashdata('cetak')) : ?>
            window.open('<?= base_url('pesanan/cetak/' . $this->session->flashdata('cetak')) ?>', '_blank')
        <?php endif; ?>
    });

    window.setTimeout(function() {
        $(".alert").fadeTo(200, 0).slideUp(200, function() {
            $(this).remove();
        });
    }, 2000);
</script>
<script>
    $('#barang_temp').on('keyup change input paste', function() {
        getBarang()
    })

    function getBarang() {
        var temp = $('#barang_temp')
        var nama = $('#nama-barang')
        var gambar = $('#gambar-barang')
        var banyak = $('#banyak-barang')
        var harga = $('#harga-barang')
        var kategori = $('#kategori')
        var label = $('#label')

        // console.log(temp.val());

        if (temp.val().length == 5) {
            var kode = temp.val();
            $.ajax({
                method: 'GET',
                url: '<?= base_url('barang/call/') ?>' + kode,
                dataType: 'json',
                success: function(data) {
                    label.show();
                    nama.html('Nama : ' + data.nama_barang);
                    gambar.attr('src', '<?= base_url('asset/img/barang/') ?>' + data.gambar_barang);
                    nama.show()
                    gambar.show()
                    $('#id-barang').val(data.id_barang)
                    banyak.show()
                    kategori.show()
                    console.log($('#kat-barang').val());
                    if ($('#kat-barang').val() != '') {
                        harga.show()
                        if ($('#kat-barang').val() == 'L') {
                            harga.html('Harga : Rp. ' + number_formating(data.harga_laundry_barang, 2, '.', ','))
                        } else {
                            harga.html('Harga : Rp. ' + number_formating(data.harga_dry_barang, 2, '.', ','))
                        }
                    } else {
                        harga.hide()
                    }

                },
                fail: function(xhr, textStatus, errorThrown) {
                    label.hide()
                    nama.hide()
                    gambar.hide()
                    banyak.hide()
                    harga.hide()
                    kategori.hide()
                }
            })
        } else {
            label.hide()
            nama.hide()
            gambar.hide()
            banyak.hide()
            harga.hide()
            kategori.hide()
        }
    }

    function pilihBarang(kode) {
        $('#barang_temp').val(kode);
        getBarang();
        $('#barangModal').modal('toggle');
    }

    function clearData(link) {
        $('#clearModal').modal('show');
        $('#btn-clear').attr('href', link)
    }

    function voidData(link) {
        $('#voidModal').modal('show');
        $('#form-void').attr('action', link)
    }

    function number_formating(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>