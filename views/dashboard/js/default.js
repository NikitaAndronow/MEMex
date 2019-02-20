$(function(){
  
    $.get('dashboard/xhrGetListings',function(o){
        
       for(var i = 0 ;i <o.length;i++){
          console.log("i = "+o[i].text);
           $('#listInserts').append('<div>'+o[i].text+'<a class="del" rel="'+o[i].id+'" href="#">x</a>'+'</div>');
       }
        
        $('#listInserts').on('click', '.del',function(){
          
            delItem=$(this);
        var id =$(this).attr('rel');
            
        $.post("dashboard/xhrDeleteListing",{"id":id},function(o){
            delItem.parent().remove();
               });
            
        return false;
    });
      //   $('$listInserts');
    },'json');
   
    
   
   
    
    
    $("#randomInsert").submit(function(){
      var url=   $(this).attr('action');
      var data = $(this).serialize();
        $.post(url,data,function(o){
              //alert(o.text);
             $('#listInserts').append('<div>'+o.text+'<a class="del" rel="'+o.id+'" href="#">x</a>'+'</div>');
               }, 'json');
       
          event.preventDefault();
    
    });
    
    
    
});