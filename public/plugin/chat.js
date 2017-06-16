// function doScroll() {
//     if(typeof $(".msgs")[0] === 'undefined' ) return;
//
//     $(".msgs").animate({
//         scrollTop: $(".msgs")[0].scrollHeight
//     });
// }
//
// function reload() {
//     var url = location.protocol + '//' + location.host + location.pathname;
//     url += "?ctl=Chat&act=AjaxOnline";
//     $(".list-users").load(url);
//     url = trueUrl("Message");
//     if( url == false ) return;
//     if(typeof $(".join-room").attr("title") !== 'undefined' ){
//         return;
//     }
//     localStorage['lastShow'] = $(".msgs .msg:last").attr("title");
//     $.ajax({
//        url : url,
//         success : function (view) {
//
//             $(".msgs").html(view);
//             if (localStorage['lastShow'] != $(".msgs .msg:last").attr("title")) {
//                 doScroll();
//             }
//         },
//     });
// }
// function trueUrl(typeChat) {
//     var url = window.location.href;
//     str1 = "ctl=Direct&act=chat";
//     str2 = "ctl=Room&act=chat";
//     if(url.indexOf(str1) != -1 )
//        return  url.replace("act=chat","act=directAjax"+typeChat);
//     else if (url.indexOf(str2) != -1)
//         return url.replace("act=chat","act=roomAjax"+typeChat);
//     else return false;
// }
// $(document).ready(function () {
//     doScroll();
//     url = trueUrl("post");
//      if( url == false ) return;
//
//     $("#msg_form").on("submit", function () {
//         // t = $(this);
//         input  = $(this).find("input[type=text]");
//         val = input.val();
//         if (val != "") {
//             $.ajax({
//                type : 'Post',
//                 url : url,
//                 data :{
//                     msg : val,
//                 },
//                 success : function () {
//                     reload();
//                     input.val("");
//                 },
//                 error : function (data) {
//                     alert(data);
//                 }
//             });
//         }
//         return false;
//     });
// });
//
// setInterval(function () {
//     reload();
// }, 1000);
