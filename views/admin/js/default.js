$(function () {
    
    
    $("#showAdd").click(function(){
         $("#add").slideDown("slow");
        $("#delete").hide();
        
    });
    
    
     $("#showDel").click(function(){
         $("#delete").slideDown("slow");
         $("#add").hide();
         
       
           
    });
     $.ajax({
                url: "http://memex/admin/loadSelectDelete",
                type: "POST",
                async: true,
                success: function (a) {
                      
                    a=JSON.parse(a);
                    for(i=0;i<a.length;i++)
                        {
                       
                            $("#idInputDelNumber").append("<option value="+a[i].id_card+" > "+a[i].number+"</option>");
                    }
                },
                cache: false,
                contentType: false    
            }, 'json');
        

    var hero;
    var number;
    var action;
    var item
    var imgHero;
    var imgAction;
    var imgItem;
    creatListener("Hero");
    creatListener("Action");
    creatListener("Item");
    $("#saveAll").click(function () {
         
        
        

        hero = ($("#idInputHero").val());
        number = ($("#idInputNumber").val());
        action = ($("#idInputAction").val());
        item = ($("#idInputItem").val());
      
      if(basicCheckCorrectNumber(number,'errorNum')==false) return false;
        

        $.ajax({
            url: "http://memex/admin/checkNumber",
            type: "POST",
            data: {"number":number},
            async: false,
            success: function (data) {

                var object = JSON.parse(data);
                
               
                if (object.errorNumber == true)
                    $('#errorNum').text("Number already exist");
                else {
                    $('#errorNum').text("");

                    $("#insertHero").submit();;
                    $("#insertAction").submit();;
                    $("#insertItem").submit();;


                }
            }

        }, 'json');
        
        
    
         
         imgHero=imgHero.slice(0,-4);
         imgAction=imgAction.slice(0,-4);
         imgItem=imgItem.slice(0,-4);
         
        
      
       
        console.log("imgHero   : "+imgHero);
        console.log("imgAnction: "+imgAction);
        console.log("imgItem   : "+imgItem);
        
        
             $.ajax({
            url: "http://memex/admin/saveDate",
            type: "POST",
            data: {"number":number,"hero":hero,"action":action,
                    "item":item,"imgHero":imgHero,
                    "imgAction":imgAction,"imgItem":imgItem},
            async: false,
            success: function() {
                
                 $.magnificPopup.open({
                items: {
                src: $('<div class="white-popup">Card been successfully added. </div>')
                },
                    type: 'inline',
                    mainClass: 'mfp-with-zoom', // this class is for CSS animation below


                    });
               var myVar = setInterval(function(){location.reload();}, 3000);
            }
            

        }, 'json');


    });


    //--------------------------------------------------------------------------------- 1
    function creatListener(target) {
        $(document).on("submit", "#insert" + target, function (e) {


            var $input = $("#uploadimage");

            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "http://memex/admin/uploadIMG",
                type: "POST",
                data: formData,
                async: false,
                success: function (a) {
                    console.log("target: " + target  + " and a=    "+a);
                    a=a.toString();
                    switch (target) {
                        case "Hero":
                            imgHero = a;          
                            break;
                        case "Action":
                            imgAction = a;
                            break;
                        case "Item":
                            imgItem = a;
                            break;

                    }
                    
               
                    $("#img" + target).attr("src", "../../../public/img/board/" + a);

                },
                cache: false,
                contentType: false,
                processData: false
            }, 'json');

            e.preventDefault();
            return false;
        });

    }
    
    
    $("#DelNumButt").click(function(){
           var idNumber = $("#idInputDelNumber").val();
    
          $.ajax({
                url: "http://memex/admin/deleteNumber",
                type: "POST",
                async: false,
                data: {"idCard":idNumber},
                success: function (a) {
                     $.magnificPopup.open({
                items: {
                src: $('<div class="white-popup">Card been successfully deleted. </div>')
                },
                    type: 'inline',
                    mainClass: 'mfp-with-zoom', // this class is for CSS animation below


                    });
                     var myVar = setInterval(function(){location.reload();}, 3000);
                }
              
            }, 'json');
        
    });
        
        
    

  function basicCheckCorrectNumber(num, errorField){
                
          
        if ((num <= 0)) {

            $('#'+errorField).text("Number must be > 0 ");
            return false;
        }

        if ((num >= 100)) {

            $('#'+errorField).text("Number must be  < 100");
            return false;
        }
      
       $('#'+errorField).text("");
      return true;
  }

});


