$(document).ready(function(){
    $('input[type="checkbox"]').change(function(){
        var check = $('input:checkbox:checked').length;
        // console.log(check);
        if(check == 0){
            $('.delete').css('display','none');
        }
        else{
            $('.delete').css('display','block');

        }
    });

    $('#delete').click(function(){
        if(confirm('Bạn có chắn muốn xóa không?') == true){

            $('input[type="checkbox"]').each(function(){
                if($(this).is(':checked')){
                   var id = $(this).val();
                    $.post(
                        '/crm/unit/ajax-delete',
                        {id:id},
                        function(data){}
                        
                        );
                $(this).parents('tr').remove();
                $('.delete').css('display','none');                        
                }
           });
        }
    });
    $('#delete-all').click(function(){
        if(confirm('Bạn có chắn muốn xóa không?') == true){

            $('input[type="checkbox"]').each(function(){
                if($(this).is(':checked')){
                   var id = $(this).val();
                    $.post(
                        '/crm/unit/ajax-delete-all',
                        // {id:id},
                        function(data){}
                        
                        );
                $(this).parents('tr').remove();
                $('.delete').css('display','none');                        
                }
           });
        }
    });
});