function checkLoading() {
    var sUserAgent = navigator.userAgent.toLowerCase();
    var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
    var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
    var bIsMidp = sUserAgent.match(/midp/i) == "midp";
    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
    var bIsAndroid = sUserAgent.match(/android/i) == "android";
    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
    if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
        alert("电脑测试效果更佳");
    } else {
        // alert("welcome");
    }
}
function send_form(form_id) {
    // alert( form_id );
    $.post($("#" + form_id).attr("action"), $("#" + form_id).serialize(), function (data) {
        if ($("#" + form_id + "_notice"))
            $("#" + form_id + "_notice").html(data);

    });
}

function confirm_delete(id) {
    // note_remove.php?id=
    // alert( id );
    if (confirm("确定要删除这份文档么？")) {
        // 
        $.post('doc_remove.php?id=' + id, null, function (data) {
            if (data == 'done') {
                $("#rlist-" + id).remove();
            }
        });
    }
}





