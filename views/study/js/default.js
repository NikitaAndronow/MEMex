$(function () {
    study();


    var quantity;
    var number;
    var position = 0;
    var position2 = 0;
    var position3 = 0;

    var engagedNum = [];
    var engagedNum2 = [];
    var engagedNum3 = [];
    var info = [{
        number: -1,
        position: -1
    }];

    var info2 = [{
        number: -1,
        position: -1
    }];
    var info3 = [{
        number: -1,
        position: -1
    }];
   

    function study() {


        $.get('study/xhrGetListings', function (o) {
            quantity = o[0].liczba;

           
            //  console.log(quantity);
            while (1)
                {
                   
                     var error=false;
                       number = myRandom(1, quantity);
                       $.ajax({
                    url: "http://memex/study/xhrIsNumberExist",
                    data: {
                        "num": number
                    },
                    type: "POST",

                    success: function (a) {

                        var a = JSON.parse(a);

                        if (a.numberExist == true) {
                            error = false;

                        } else error = true;

                    },
                    async: false
                }, 'json');
                    
                    if (error==false)break;
                }
         
            position = myRandom(0, 5);
            position2 = myRandom(0, 5);
            position3 = myRandom(0, 5);

            engagedNum.push(number);
            engagedNum2.push(number);
            engagedNum3.push(number);
            //console.log("main number "+number+ " position: " + position);    
            info[0].position = position;
            info[0].number = number;

            info2[0].position = position2;
            info2[0].number = number;

            info3[0].position = position3;
            info3[0].number = number;


            for (i = 0; i <= 5; i++) {
                if (i == position) continue;
                var n = generateNumber();

                info.push({
                    number: n,
                    position: i
                });
            }

            for (i = 0; i <= 5; i++) {
                if (i == position2) continue;
                var n = generateNumber2();

                info2.push({
                    number: n,
                    position: i
                });
            }

            for (i = 0; i <= 5; i++) {
                if (i == position3) continue;
                var n = generateNumber3();

                info3.push({
                    number: n,
                    position: i
                });
            }


            /*
            for (i = 0; i < info.length; i++)
                console.log(info[i].position);
            console.log("Numbers");
            for (i = 0; i < info.length; i++)
                console.log(info[i].number);

            console.log("info length 2: " + info2.length);
            console.log("position 2");
            for (i = 0; i < info2.length; i++)
                console.log(info2[i].position);
            console.log("Numbers 2");
            for (i = 0; i < info2.length; i++)
                console.log(info2[i].number);



            console.log("position 3");
            for (i = 0; i < info3.length; i++)
                console.log(info3[i].position);
            console.log("Numbers 3");
            for (i = 0; i < info3.length; i++)
                console.log(info3[i].number);
*/


            $("h1").find("span").text(number);
            for (i = 0; i < info.length; i++) {

                getImageName(info[i].number, info[i].position, "hero");
                getImageName(info2[i].number, info2[i].position, "action");
                getImageName(info3[i].number, info3[i].position, "item");

            }

        }, 'json');


        function generateNumber() {

            while (1) {
                var ran = myRandom(1, quantity);
                var check = true;
                var error = false;
                $.ajax({
                    url: "http://memex/study/xhrIsNumberExist",
                    data: {
                        "num": ran
                    },
                    type: "POST",

                    success: function (a) {

                        var a = JSON.parse(a);

                        if (a.numberExist == true) {
                            error = false;

                        } else error = true;

                    },
                    async: false
                }, 'json');
                 if (error==true)continue;


                engagedNum.forEach(checkMatches);

                function checkMatches(item) {

                    if (ran == item) {
                        check = false;
                        //       alert("ran = "+ran+"; item = "+item+" ;");
                        return;
                    }

                }
                if (check == true) {
                    engagedNum.push(ran);
                    break;
                }
            }
             console.log("1) return "+ran);
            return ran;
        }

        function generateNumber2() {
               // alert("begin");
            while (1) {

                var ran = myRandom(1, quantity);
                 var error = false;
                $.ajax({
                    url: "http://memex/study/xhrIsNumberExist",
                    data: {
                        "num": ran
                    },
                    type: "POST",

                    success: function (a) {

                        var a = JSON.parse(a);
                        if (a.numberExist == true) {
                            error = false;

                        } else error = true;

                    },
                    cache: false,
                    async: false
                }, 'json');

                if (error == true) {

                    continue;
                }
                var check = true;
                engagedNum2.forEach(checkMatches);

                function checkMatches(item) {

                    if (ran == item) {
                        check = false;

                        return;
                    }

                }

                if (check == true) {

                    engagedNum2.push(ran);
                    break;
                }
            }
            console.log("2) return "+ran);
            return ran;
        }

        function generateNumber3() {

            while (1) {
                var ran = myRandom(1, quantity);
                 var error = false;
                 $.ajax({
                    url: "http://memex/study/xhrIsNumberExist",
                    data: {
                        "num": ran
                    },
                    type: "POST",

                    success: function (a) {

                        var a = JSON.parse(a);
                        if (a.numberExist == true) {
                            error = false;

                        } else error = true;

                    },
                    cache: false,
                    async: false
                }, 'json');


               if(error == true)continue;



                var check = true;
                engagedNum3.forEach(checkMatches);

                function checkMatches(item) {

                    if (ran == item) {
                        check = false;
                        //       alert("ran = "+ran+"; item = "+item+" ;");
                        return;
                    }

                }
                if (check == true) {
                    engagedNum3.push(ran);
                    break;
                }
            }
             console.log("3) return "+ran);
            return ran;
        }




        function myRandom(from, to) {
            return Math.floor((Math.random() * to) + from);

        }


        function getImageName(num, i, type) {

            //start point  for user=) 
            $.post("study/xhrgetImageName", {
                    "number": num.toString(),
                    "type": type.toString()
                })
                .done(function (data) {

                    $("." + type + "Test").find("#" + i + "").attr({
                        src: "../../public/img/board/" + data.toString() + ".jpg"
                    });

                    $(".study").fadeIn(3500);

                    $("." + type + "Test").find("#" + i + "").click(function () {

                        $("." + type + "Test").find("*").removeClass("pressed");
                        $(this).addClass("pressed");

                    });



                });

        }
    }

    $("#checkButt").click(function () {
        if (!$(".heroTest").find("#" + position).hasClass("pressed")) myAlert("Error in Hero");
        if (!$(".actionTest").find("#" + position2).hasClass("pressed")) myAlert("Error in Action");
        if (!$(".itemTest").find("#" + position3).hasClass("pressed")) myAlert("Error in Item");
        if (($(".heroTest").find("#" + position).hasClass("pressed")) && ($(".actionTest").find("#" + position2).hasClass("pressed")) && ($(".itemTest").find("#" + position3).hasClass("pressed"))) {
            myAlert("Congratulations!!!! ");

            var myVar = setInterval(function () {
                location.reload();
            }, 700);
        }
    });


    function myAlert(msg) {
        $.magnificPopup.open({
            items: {
                src: $('<div class="white-popup">' + msg + ' </div>')
            },
            type: 'inline',
            mainClass: 'mfp-with-zoom', // this class is for CSS animation below
        });
    }
});
