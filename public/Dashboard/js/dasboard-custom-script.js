// reset form data on manage staff page 
$('#reset-staff').on('click',function(){
    $('input[name="filters[firstname][value]"]').val('');
    $('input[name="filters[lastname][value]"]').val('');
    $('input[name="filters[email][value]"]').val('');
});
