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
    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^]*)').exec(window.location.href);
        if (results == null) {
            return null;
        }
        else {
            return results[1] || 0;
        }
    }
    return $.urlParam(name);

}
function doScroll() {
    if (typeof $(".msgs")[0] === 'undefined') return;
    $(".msgs").animate({
        scrollTop: $(".msgs")[0].scrollHeight
    });
}

function trueUrl(typeChat) {
    var url = window.location.href;
    str1 = "ctl=Direct&act=chat";
    str2 = "ctl=Room&act=chat";
    if (url.indexOf(str1) != -1)
        return url.replace("act=chat", "act=directAjax" + typeChat);
    else if (url.indexOf(str2) != -1)
        return url.replace("act=chat", "act=roomAjax" + typeChat);
    else return false;
}

// function active() {
//     console.log("Active");
//     $('.list-content div a').on("click", function (e) {
//         $('.list-content div').removeClass('current');
//         var $parent = $(this).parent();
//         if (!$parent.hasClass('current')) {
//             $parent.addClass('current');
//         }
//         var targetUrl = $(this).attr("href");
//         history.pushState(null, null, targetUrl);
//         $.ajax({
//             url: targetUrl,
//             success: function (data) {
//                 $(".chatbox-wrapper").html(data);
//                 if (localStorage['lastShow'] != $(".msgs .msg:last").attr("title")) {
//                     doScroll();
//                 }
//             }
//         });
//         e.preventDefault();
//         return false;
//     });
//
// }
function reloadUser() {
    console.log(1);
    var url = location.protocol + '//' + location.host + location.pathname;
    url += "?ctl=Chat&act=AjaxOnline";
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
            },1000)
        }
    });
}

function reload() {
    console.log(2);

    if (typeof $(".join-room").attr("title") !== 'undefined') {
        return;
    }
    localStorage['lastShow'] = $(".msgs .msg:last").attr("title");
    $.ajax({
        url: trueUrl("Message"),
        success: function (view) {
            $(".msgs").html(view);
            if (localStorage['lastShow'] != $(".msgs .msg:last").attr("title")) {
                doScroll();
            }
            setTimeout(function () {
                reload();
            },1000)
        }
    });
}
// $(document).ajaxSuccess(function () {
//     active();
// });
$(document).ready(function () {
    reload();
    reloadUser();
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
                    reload();
                    input.val("");
                }

            });
        }

        return false;
    });
});
