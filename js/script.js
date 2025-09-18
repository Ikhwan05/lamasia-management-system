$(document).ready(function() {

    $('#button').hide();

    $('#keyword').on('keyup', function() {
        // munculkan gamba loading
        $('#loader').show();

        // ajax menggunakan load
        // $('#container').load('ajax/lamasia.php?keyword=' + $('#keyword').val());

        // $.get()
        $.get('ajax/lamasia.php?keyword=' + $('#keyword').val(), function(data){

            // tampilkan data
            $('#container').html(data)
            $('#loader').hide();

        })
    })




})