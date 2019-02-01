
$('#direction_select').on('change', function(){
    $('#direction').val($(this).val());
    console.log($('#direction').val());
    $('#search-form');
    document.getElementById('search-form');
})

$('#order_select').on('change', function(){
    $('#column').val($(this).val());
    console.log($('#column').val());
    $('#search-form').submit();
})