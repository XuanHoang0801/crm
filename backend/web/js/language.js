$('.language').click(function(){
    var lang = $(this).attr('id');
    $.post(
        '/crm/site/language',
        {'lang': lang},
        function(data){
           location.reload();
            // alert(data);
        }
    )
});
