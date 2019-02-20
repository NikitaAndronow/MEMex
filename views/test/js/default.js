$(function () {
   $(".test").fadeIn(1000);
    
    var play = true;
    var lvl = 5;
    
      var rNum;
    var uNum;
    var kostyl=false;
    $("#start").click(test);

    
    function test(){
        $("#hTest").text("Test: current complexity:"+lvl);
        $("#slide").slideDown(1000);;;
        $("#start").fadeOut(200);
        
       round(getRandom(lvl));
        
        
        
    }
    function round(rN){
        rNum=rN;
       
       
        $("#sRand").html('<strong>'+rNum+'</strong>');
        $("#sRand").fadeIn(1000);
        setTimeout(function () {
            $("#sRand").fadeOut(1000);
        }, 4000);
        setTimeout(function () {
            $("#uSec").fadeIn(1000);
        }, 4000);
      
          
        
    }
    
     
        $("#bAns").click(function () {
            uNum  = $("#iAns").val();
            $("#iAns").val("");
             console.log("rNum: "+rNum +"   uNum: "+uNum);
            $("#uSec").fadeOut(1000);
          if (rNum!=uNum) 
          {
              
             play=false;
             myAlert("Your rekord: "+lvl);
           
              
             lvl=5;
               $("#hTest").text("Test: current complexity:"+lvl);
          }
            else{
            lvl++;
              $("#hTest").text("Test: current complexity:"+lvl);
            }
           
             $("#start").fadeIn(200);
        });

    function getRandom(lvl) {
        while(true)
            {
        console.log('test = '+ Math.pow(10, lvl));
         console.log('x   = '+ Math.pow(10, lvl));
        var x = Math.floor(Math.random() * Math.pow(10, lvl)+ Math.pow(10, lvl-1) );
             if(x<Math.pow(10, lvl+1))return x;
                continue;
            }
        
    }
    
     function myAlert(msg){
          $.magnificPopup.open({
                items: {
                src: $('<div class="white-popup">'+msg+' </div>')
                },
                    type: 'inline',
                    mainClass: 'mfp-with-zoom', // this class is for CSS animation below


                    });
     }
     
});