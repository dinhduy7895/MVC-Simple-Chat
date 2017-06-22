$("#myDropdown").hide();
$(".show-status").on("mousedown", function () {
    if ($("#myDropdown").css("display") == 'none') {
        $("#myDropdown").slideDown("slow");
        $(".list-users").hide(300);
    }
    else {
        $("#myDropdown").hide(300);
        $(".list-users").slideDown("slow");
    }
});
function getId(name) {
    var url = window.location.href;
    var path = location.protocol + '//' + location.host + '/';
    url = url.replace(path,'');
    var res = url.split('/');
   var param = [];
    param['ctl'] = res[0];
    param['act'] = res[1];
    param['id'] = res[2];
    return param[name];
}
function doScroll() {
    if (typeof $(".msgs")[0] === 'undefined') return;
    $(".msgs").animate({
        scrollTop: $(".msgs")[0].scrollHeight
    });
}

function trueUrl(typeChat) {
    var url = window.location.href;
    str1 = "Direct/chat";
    str2 = "Room/chat";
    if (url.indexOf(str1) != -1)
        return url.replace("/chat", "/directAjax" + typeChat);
    else if (url.indexOf(str2) != -1)
        return url.replace("/chat", "/roomAjax" + typeChat);
    else return false;
}

function reloadUser() {
    var url = location.protocol + '//' + location.host + '/';
    url += "Chat/AjaxOnline";
    $.ajax({
        url: url,
        type : 'Get',
        data: {
            id: getId('id'),
            type: getId('ctl')
        },
        success: function (view) {
            $(".list-users").html(view);
            setTimeout(function () {
                reloadUser();
            },10000)
        }
    });
}

function reload() {

    if (typeof $(".join-room").attr("title") !== 'undefined') {
        return;
    }
    
    $.ajax({
        url : trueUrl("Countdown"),
            // success : alert('sc'),
            // error : alert('er')
    });
    
    localStorage['lastShow'] = $(".msgs .msg:last").attr("title");
    $.ajax({
        url: trueUrl("Message"),
        success: function (view) {
            $(".msgs").html(view);
            if (localStorage['lastShow'] != $(".msgs .msg:last").attr("title")) {
                doScroll();
            }
            // setTimeout(function () {
            //     reload();
            // },1000)
        }
    });
}

$(document).ready(function () {
   //   reload();
  //  reloadUser();
    doScroll();


    // localStorage['lastId'] = 20;
    //
    // $('.chatbox-wrapper').scroll(function () {
    //     if ($('.chatbox-wrapper').scrollTop() == 0) {
    //         // Display AJAX loader animation
    //         $('#loader').show();
    //
    //         // Youd do Something like this here
    //         // Query the server and paginate results
    //         // Then prepend
    //         $.ajax({
    //             url: trueUrl("Message"),
    //             dataType: 'html',
    //             success: function (data) {
    //                 setTimeout(function () {
    //                     $('.msgs').prepend(data);
    //                     $('#loader').hide();
    //                     $('.chatbox-wrapper').scrollTop(30);
    //                 },780)
    //
    //                 localStorage['lastId']  += 20;
    //             }
    //         })
    //         //BUT FOR EXAMPLE PURPOSES......
    //         // We'll just simulate generation on server
    //
    //
    //         //Simulate server delay;
    //         setTimeout(function () {
    //             // Simulate retrieving 4 messages
    //             for (var i = 0; i < 4; i++) {
    //                 $('.inner').prepend('<div class="messages">Newly Loaded messages<br/><span class="date">' + Date() + '</span> </div>');
    //             }
    //             // Hide loader on success
    //             $('#loader').hide();
    //             // Reset scroll
    //             $('#chatBox').scrollTop(30);
    //         }, 780);
    //     }
    // });
    $("#msg_form").on("submit", function () {
        input = $(this).find("input[type=text]");
        val = input.val();

        if (val != "") {
            $.ajax({
                type: 'Post',
                url: trueUrl("post"),
                data: {
                    msg: val,
                },
                success: function () {
                    input.val("");
                }

            });
        }

        return false;
    });
});
