<!-- add & edit -->
<script type="text/javascript" src="<?php echo base_url('asset/vendor/autoNumeric/autoNumeric.min.js') ?>"></script>
<script>
    const autoFloatOptions = {
        digitGroupSeparator: ',',
        decimalCharacter: '.',
        modifyValueOnWheel: false,
    };
    new AutoNumeric.multiple('.Float', autoFloatOptions);
</script>
<script>
    function showPict(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = input.files[0].name.substring(0, 17);;

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
                $('#preview').show();
            }

            reader.readAsDataURL(input.files[0]);

            if (filename != "") {
                $('#label-upload').text(filename);
            }
        }
    }
</script>