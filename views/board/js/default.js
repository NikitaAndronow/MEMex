$(function(){
  $(".board").fadeIn(3500);
    $.get('board/xhrGetListings',function(o){
        
       for(var i = 0 ;i <o.length;i++){
          
           $('#listInserts').append( '<div class="container shadowBlock"> <h1>'+o[i].number+'</h1>'+
    '<div class="row">'+
    ' <div  class="col-md-4">'+
     '     <div class="mycard">'+
    '<img class="boardIMG" src="../../public/img/board/'+o[i].imghero+'.jpg" alt="aim" width="100px" height="100px">'+
   ' <p class="captionD">'+o[i].hero+'</p>'+
'</div>   '    +
    '</div>'+
        '<div  class="col-md-4">'+
        ' <div class="mycard">'+
    '<img class="boardIMG" src="../../public/img/board/'+o[i].imgaction+'.jpg" alt="aim" width="100px" height="100px">'+
   ' <p class="captionD">'+o[i].action+'</p>'+
'</div>'+
         
    ' </div>'+
      '  <div  class="col-md-4">     '+
'<div class="mycard">'+
    '<img class="boardIMG" src="../../public/img/board/'+o[i].imgitem+'.jpg" alt="aim" width="100px" height="100px">'+
   ' <p class="captionD">'+o[i].item+'</p>'+
'</div>'+
    ' </div>    '+
   ' </div>'+
'</div>');
       }
        
       
      //   $('$listInserts');
    },'json');
   
    
  
   
    
    
});