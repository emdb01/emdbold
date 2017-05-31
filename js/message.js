$(document).ready(function () {
    $("#openNewMsg").hide();
    $("#openPreMsg").hide();
    $("#succMsg").hide();
    $("#loadStatus1").hide();
    $("#delsuccMsg").hide();
    $("#succMsg").hide();
    $(document).on("click", "#ptemps:not(.disabled)", function () {
        $("#succMsg").hide();
        var pMsg = $('input:checkbox[name=ptemp]:checked').val();
        if (pMsg == 'PreviousTemp')
        {
            $("#newmg").hide();
            $("#openPreMsg").show();
        } else {
            $("#newmg").show();
            $("#openPreMsg").hide();
            $("#delsuccMsg").hide();
        }

    });
    $(document).on("click", "#ntemps:not(.disabled)", function () {

        $("#succMsg").hide();
        var nMsg = $('input:checkbox[name=ntemp]:checked').val();
        if (nMsg == 'NewTemp')
        {
            $("#premg").hide();
            $("#openNewMsg").show();

        } else {
            $("#premg").show();
            $("#openNewMsg").hide();
        }
    });

});
function sendNewmessage() {

    $("#loadStatus1").fadeIn("slow");
    $("#succMsg").hide();
    var maillist = new Array();
    for (var m = 1; m <= 200000; m++) {
        var check_maillist = document.getElementById(m);

        if (check_maillist != null) {
            if (check_maillist.checked == true) {
                maillist.push(check_maillist.value);
            }
        }
    }

    var formData = {"check_maillist": maillist};
    var emails = formData.check_maillist;
    var setid = document.getElementById("getid").value;
    var setsubject = document.getElementById("getsubject").value;
    var setmessage = document.getElementById("getmessage").value;
    $.ajax({
        url: 'mailForm.php',
        data: 'action=sendNew' + '&rid=' + setid + '&list=' + emails + '&subject=' + setsubject + '&message=' + setmessage,
        type: 'post',
        cache: false,
        dataType: 'html',
        success: function (data) {
            $("#loadStatus1").fadeOut("slow");
            $("#succMsg").show();
            $('#openPreMsg').load('list_resumes.php #openPreMsg', function () {

            });

        }
    });

}
function sendPremessage() {
    $("#loadStatus1").fadeIn("slow");
    $("#succMsg").hide();
    var maillist = new Array();
    for (var m = 1; m <= 200000; m++) {
        var check_maillist = document.getElementById(m);

        if (check_maillist != null) {
            if (check_maillist.checked == true) {
                maillist.push(check_maillist.value);
            }
        }
    }

    var formData = {"check_maillist": maillist};
    var emails = formData.check_maillist;
    var setid = document.getElementById("getid").value;
    var msgid = document.getElementById("reqid").value;
    $.ajax({
        url: 'mailForm.php',
        data: 'action=sendPre' + '&rid=' + setid + '&list=' + emails + '&msgid=' + msgid,
        type: 'post',
        cache: false,
        dataType: 'html',
        success: function (data) {
            $("#loadStatus1").fadeOut("slow");
            $("#succMsg").show();

        }
    });
}
function deletePremessage() {
    $("#loadStatus1").fadeIn("slow");
    $("#succMsg").hide();
    var maillist = new Array();
    for (var m = 1; m <= 200000; m++) {
        var check_maillist = document.getElementById(m);

        if (check_maillist != null) {
            if (check_maillist.checked == true) {
                maillist.push(check_maillist.value);
            }
        }
    }

    var formData = {"check_maillist": maillist};
    var emails = formData.check_maillist;
    var setid = document.getElementById("getid").value;
    var msgid = document.getElementById("reqid").value;
    $.ajax({
        url: 'mailForm.php',
        data: 'action=deletePre' + '&rid=' + setid + '&msgid=' + msgid,
        type: 'post',
        cache: false,
        dataType: 'html',
        success: function (data) {
            $("#loadStatus1").fadeOut("slow");
            $("#delsuccMsg").show();

        }
    });
}
$(document).ready(function () {
    $('#reqid').on('change', function () {
        
        var subID = $(this).val();
        if (subID) {
            $.ajax({
                type: 'POST',
                url: 'getmessages.php',
                data: 'sub_id=' + subID,
                success: function (html) {
//                    $('#state').html(html);
                    $('#mesgget').html('<textarea name="message" id="getmessage" readonly class="form-control" style="height: 150px !important;" placeholder="Message">' + html + '</textarea> ');
                }
            });
        }
    });
});

function reset() {
    document.getElementById("reset").reset();
}
function sendVerification() {
    $("#sendButton").hide();
    $("#validOpen").hide();
    $("#loadStatus1").fadeIn("slow");
    var maillist = new Array();
    for (var m = 1; m <= 200000; m++) {
        var check_maillist = document.getElementById(m);

        if (check_maillist != null) {
            if (check_maillist.checked == true) {
                maillist.push(check_maillist.value);
            }
        }
    }

    var formData = {"check_maillist": maillist};
    var emails = formData.check_maillist;
    $.ajax({
        url: 'mailverification.php',
        data: 'list=' + emails,
        type: 'post',
        cache: false,
        dataType: 'html',
        success: function (data) {
            $("#loadStatus1").fadeOut("slow");
            $("#succMsg").show();
             $('#validOpen').load('notverifyjobseeker.php #validOpen', function () {
                    });

        }
    });

}