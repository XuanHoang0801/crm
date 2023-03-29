$(".note").click(function(){
// $('input[type="checkbox"]').change(function(){
   // if($(this).is(':checked')){

      var show = $(this).parents('tr td').children('textarea').show();
      if(show.css('display','none')){
         show.show();
         $(this).parents('tr td').children('.hide').show();
         // $('.note-hide').show();
         $(this).hide();
      }
      else{
         show.hide();

      }
   // }
   // else{
   //    $(this).parents('tr td').children('.off').show();
   // }

});


$('.note-intro').click(function(){
  var intro = $(this).parents('tr td').children('textarea').val();
  var unit = $(this).parents('tr').attr('data-id');
   $.post(
      '/crm/step/update-intro',
      {
         unit:unit,
         intro:intro,
      },
      function(data){
         location.href= '/crm/step';
      }
   );
});
$('.note-zalo').click(function(){
   var zalo = $(this).parents('tr td').children('textarea').val();
   var unit = $(this).parents('tr').attr('data-id');
    $.post(
       '/crm/step/update-zalo',
       {
          unit:unit,
          zalo:zalo,
       },
       function(data){
          location.href= '/crm/step';
       }
    );
});

$('input[type="checkbox"]').click(function(){
   $comfirm = confirm('Bạn có chắc chắn muốn thay đổi trạng thái không?');
   if($comfirm == true){
      var unit = $(this).parents('tr').attr('data-id');
      var type = $(this).attr('name');
      if($(this).is(':checked')){
         var val = 1;
      }
      else{
         var val = 0;
      }

      console.log(val);
      if(type == 'intro'){
         $.post(
            '/crm/step/check-intro',
            {
               unit: unit,
               val:val
            },
            function(data){
            location.href= '/crm/step';
            }
         )
      }

      if(type == 'zalo'){
         $.post(
            '/crm/step/check-zalo',
            {
               unit: unit,
               val:val
            },
            function(data){
            location.href= '/crm/step';
            }
         )
      }
   }

});

$('.add-unit').click(function(){
   var unit = $('.unit').val();;
   $.post(
      '/crm/step/add',
      {
         unit:unit   
      },
      function(data){
         location.href= '/crm/step';

      }
   )
});


