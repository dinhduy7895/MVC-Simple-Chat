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
    url = url.replace(path, '');
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
        type: 'Get',
        data: {
            id: getId('id'),
            type: getId('ctl')
        },
        async: false,
        success: function (view) {
            $(".list-users").html(view);
            setTimeout(function () {
                reloadUser();
            }, 1000)
        },
        complete: function () {
            var noti = $("#sessionNoti").val();
            if (noti != 0) {
                document.title = '(' + noti + ')' + localStorage['title'];
            }
            else document.title = localStorage['title'];
        }
    });
}

function reload() {

    var url = window.location.href;
    var check;
    if (url.indexOf('Direct')  ==  -1 ) check = false;
    else check = true;
    if (typeof $(".join-room").attr("title") !== 'undefined') {
        return;
    }
    var count = $(".msgs .msg").length;
    localStorage['lastShow'] = $(".msgs .msg:last").attr("title");

    $.ajax({
        url: trueUrl("Message"),
        type: 'Post',
        data: {
            lastShow: localStorage['lastShow']
        },
        success: function (view) {
            if (check)
               $(".msgs").html(view);
            else
             $(".msgs").append(view);
            if (localStorage['lastShow'] < $(".msgs .msg:last").attr("title")) {
                doScroll();
            }
            setTimeout(function () {
                reload();
            }, 1000)
        }
        
    });
}

function reloadUpdate() {
    var focus = $('#sendmess').is(':focus');
    $.ajax({
        url: trueUrl("Countdown"),
        type: 'Post',
        data: {
            focus: focus
        },
        success: function (data) {
            // alert(data);
            setTimeout(function () {
                reloadUpdate();
            }, 1000)
        }
    });

}
$(document).ready(function () {
    localStorage['title'] = document.title;
    reloadUser();
    reload();
    reloadUpdate();
    doScroll();
    localStorage['firstShow'] = '';
    

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
