function restore() {
    $("#record, #live").removeClass("disabled");
    $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
//    $(".one").addClass("disabled");
    Fr.voice.stop();
}
$(document).ready(function () {
    $("#autohide").hide();
    $("#autoSending").hide();
    $("#pvmailsAudio").hide();
    $("#TimeAlert").hide();
    $("#alertMsg").hide();
    $("#audioauto").hide();
    $("#requir").hide();
    $("#autoSend").hide();
    $(document).on("click", "#nvoicemails:not(.disabled)", function () {
        var nVoice = $('input:checkbox[name=nvoicemail]:checked').val();
        if (nVoice == 'NewVoiceMail')
        {

            $("#autohide").show();
            $("#pMS").hide();
            $("#presuccessmail").hide();
            $("#predelsuccessmail").hide();
            $("#autoMS").hide();
            $("#autoSending").hide();
            $("#getAutoVoice").hide();
            $("#autosuccessmail").hide();
        } else {
            $("#autohide").hide();
            $("#pMS").show();
            $("#autoMS").show();
        }
    });
    $(document).on("click", "#automails:not(.disabled)", function () {
        var autoVoice = $('input:checkbox[name=automail]:checked').val();
        if (autoVoice == 'Automated')
        {
            $(".two").removeClass("disabled");
            $("#record").hide();
            $("#pause").hide();
            $("#presuccessmail").hide();
            $("#predelsuccessmail").hide();
            $("#play").hide();
            $("#audio").hide();
            $("#save").hide();
            $("#audioauto").show();
            $("#requir").show();
            $("#autoSend").show();
            $("#nMS").hide();
            $("#pMS").hide();




        } else {

            $(".two").addClass("disabled");
            $("#record").show();
            $("#pause").show();
            $("#play").show();
            $("#audio").show();
            $("#save").show();
            $("#audioauto").hide();
            $("#requir").hide();
            $("#autoSend").hide();
            $("#nMS").show();
            $("#pMS").show();
            $("#getAutoVoice").hide();
            $("#autoSending").hide();
            $("#autosuccessmail").hide();

        }

    });

    $(document).on("click", "#pvoicemails:not(.disabled)", function () {
        var pVoice = $('input:checkbox[name=pvoicemail]:checked').val();
        if (pVoice == 'PreviousVoiceMail')
        {
            
            $("#pvmailsAudio").show();
            $("#paudio").hide();
            $('#preVoiceDelete').hide();
            $("#autosuccessmail").hide();
            $("#autoSending").hide();
            $(".two").removeClass("disabled");
//            $("#record").hide();
//            $("#pause").hide();
//            $("#play").hide();
//            $("#audio").hide();
//            $("#save").hide();
//            $("#audioauto").hide();
//            $("#requir").hide();
//            $("#autoSend").hide();
            $("#autoMS").hide();
//            $("#autohide").hide();
            $("#nMS").hide();

        } else {
            $("#pvmailsAudio").hide();
            $("#autoMS").show();
            $("#nMS").show();
            $("#presuccessmail").hide();
            $("#predelsuccessmail").hide();
        }
    });
    $(document).ready(function () {

        $('#req').on('change', function () {
            var vID = $(this).val();
            if (vID) {
                $.ajax({
                    type: 'POST',
                    url: 'getvoices.php',
                    data: 'v_id=' + vID,
                    success: function (html) {
                        $('#vmget').html(html);
                        $('#preVoiceDelete').show();
                    }
                });
            }
        });
    });
    $(document).on("click", "#autoSending:not(.disabled)", function () {
        $("#alrtCreateAuto").hide();
        var mid = document.getElementById("midvalue").value;
        var voi = document.getElementById("autoaudio").src;
        var maillist = new Array();
        for (var m = 1; m <= 200000; m++) {

            var check_maillist = document.getElementById(m);

            if (check_maillist != null) {
                if (check_maillist.checked == true) {
                    //                                                        console.log(check_maillist);
                    maillist.push(check_maillist.value);
                }
            }
        }
        var formData = {"check_maillist": maillist};
        var emails = formData.check_maillist;
        var autoconfirm = 'CONFIRM';
        $("#loadStatus").fadeIn("slow");

        $.ajax({
            type: "POST",
            url: "automail.php",
            data: 'mid=' + mid + '&list=' + emails + '&path=' + voi + '&autoconfirm=' + autoconfirm,
            cache: false,
            success: function (data)
            {
                $("#loadStatus").fadeOut("slow");
                $("#autosuccessmail").html("<b style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Automated Voice Mail Sent Successfully.</b>");
            }
        });
    });
    $(document).on("click", "#autoSend:not(.disabled)", function () {
        var mid = document.getElementById("midvalue").value;
        var req = document.getElementById("reqa").value;
        var reqr = document.getElementById("reqr").value;
        if (req == '' && reqr == '') {
            $("#alertMsg").show();
            return;
        }

        if (req != '') {
            $("#alertMsg").hide();
            var requirement = req;

        } else if (reqr != '') {

            var requirement = reqr;

        }
        var maillist = new Array();
        for (var m = 1; m <= 200000; m++) {

            var check_maillist = document.getElementById(m);

            if (check_maillist != null) {
                if (check_maillist.checked == true) {
                    //                                                        console.log(check_maillist);
                    maillist.push(check_maillist.value);
                }
            }
        }
        var formData = {"check_maillist": maillist};
        var emails = formData.check_maillist;
        $("#loadStatus").fadeIn("slow");
        $.ajax({
            type: "POST",
            url: "automail.php",
            data: 'mid=' + mid + '&list=' + emails + '&requirement=' + requirement,
            cache: false,
            success: function (data)
            {
                $("#loadStatus").fadeOut("slow");
                $("#getAutoVoice").html(data);
                $("#autoSending").show();
                $("#alrtCreateAuto").html("<b style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Automated Voice Created Successfully.</b>");
//                $(".the-return").html(
//                        "<b style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Automated Voice Mail Sent Successfully.</b>"
//                        );
            }
        });


    });

    $(document).on("click", "#record:not(.disabled)", function () {
        var vti = document.getElementById("voicetitle").value;
        if (vti) {

            $("#voicealert").hide();
            checkTime();
            $("#countdown-1").show();
            $(".the-return").hide();

            elem = $(this);
            Fr.voice.record($("#live").is(":checked"), function () {
                elem.addClass("disabled");
                $("#live").addClass("disabled");
                $(".one").removeClass("disabled");
            });
        } else {
            $("#voicealert").html(
                    "<b style='color:red;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Please Enter Title.</b>"
                    );
        }
    });

    $(document).on("click", "#pause:not(.disabled)", function () {
        checkTime();
        $("#countdown-1").hide();
        if ($(this).hasClass("resume")) {
            Fr.voice.resume();
            $(this).replaceWith('<a class="button one" id="pause">Pause</a>');
        } else {
            Fr.voice.pause();
            $(this).replaceWith('<a class="button one resume" id="pause">Resume</a>');
        }
    });

    $(document).on("click", "#stop:not(.disabled)", function () {
        restore();
    });

    $(document).on("click", "#play:not(.disabled)", function () {
        Fr.voice.export(function (url) {
            $("#audio").attr("src", url);
            $("#audio")[0].play();
            $("#pause").addClass("disabled");
        }, "URL");
        restore();
    });

    $(document).on("click", "#download:not(.disabled)", function () {
        Fr.voice.export(function (url) {
            $("<a href='" + url + "' download='MyRecording.wav'></a>")[0].click();
        }, "URL");
        restore();
    });

    $(document).on("click", "#base64:not(.disabled)", function () {
        Fr.voice.export(function (url) {
            uploadAudio(url);
            // alert("Check the web console for the URL");
            // $("<a href='"+ url +"' target='_blank'></a>")[0].click();
        }, "base64");
        restore();
    });
    function uploadAudio(audiosrcs) {
        var mid = document.getElementById("midvalue").value;
        var maillist = new Array();
        for (var m = 1; m <= 200000; m++) {

            var check_maillist = document.getElementById(m);

            if (check_maillist != null) {
                if (check_maillist.checked == true) {
                    //                                                        console.log(check_maillist);
                    maillist.push(check_maillist.value);
                }
            }
        }
        var formData = {"check_maillist": maillist};
        var emails = formData.check_maillist;
        var audiosrc = audiosrcs;

        $.ajax({
            type: "POST",
            url: "uploadAudio.php",
            data: 'action=sendVoice' + '&list=' + emails + '&audiosrc=' + audiosrc + '&rid=' + mid,
            cache: false,
            success: function (html)
            {

            }
        });
    }
    $(document).on("click", "#mp3:not(.disabled)", function () {
        alert("The conversion to MP3 will take some time (even 10 minutes), so please wait....");
        Fr.voice.export(function (url) {
            console.log("Here is the MP3 URL : " + url);
            alert("Check the web console for the URL");

            $("<a href='" + url + "' target='_blank'></a>")[0].click();
        }, "mp3");
        restore();
    });

    $(document).on("click", "#preVoiceSend:not(.disabled)", function () {
        $("#autosuccessmail").hide();
        var mid = document.getElementById("midvalue").value;
        var voi = document.getElementById("paudio").src;
        var maillist = new Array();
        for (var m = 1; m <= 200000; m++) {

            var check_maillist = document.getElementById(m);

            if (check_maillist != null) {
                if (check_maillist.checked == true) {
                    //                                                        console.log(check_maillist);
                    maillist.push(check_maillist.value);
                }
            }
        }
        var formData = {"check_maillist": maillist};
        var emails = formData.check_maillist;
        var autoconfirm = 'PRECONFIRM';
        $("#loadStatus").fadeIn("slow");
        $.ajax({
            type: "POST",
            url: "automail.php",
            data: 'mid=' + mid + '&list=' + emails + '&path=' + voi + '&autoconfirm=' + autoconfirm,
            cache: false,
            success: function (data)
            {
                $("#loadStatus").fadeOut("slow");
                $("#presuccessmail").html("<b style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Voice Mail Sent Successfully.</b>");
            }
        });

    });
    $(document).on("click", "#preVoiceDelete:not(.disabled)", function () {
        $("#autosuccessmail").hide();
        var mid = document.getElementById("midvalue").value;
        var voicid = document.getElementById("req").value;
        $("#loadStatus").fadeIn("slow");
        $.ajax({
            type: "POST",
            url: "voiceDel.php",
            data: 'mid=' + mid + '&voicid=' + voicid,
            cache: false,
            success: function (data)
            {
                $("#loadStatus").fadeOut("slow");
                $("#predelsuccessmail").html("<b style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Voice mail has been deleted successfully.</b>");
                $('#pvmailsAudio').load('list_resumes.php #pvmailsAudio', function () {
                });
            }
        });
    });

    $(document).on("click", "#save:not(.disabled)", function () {
        $("#autosuccessmail").hide();
        $("#loadStatus").fadeIn("slow");
        $(".the-return").show();
        Fr.voice.export(function (blob) {
            var mid = document.getElementById("midvalue").value;
            var vtitle = document.getElementById("voicetitle").value;

            var maillist = new Array();
            for (var m = 1; m <= 200000; m++) {

                var check_maillist = document.getElementById(m);

                if (check_maillist != null) {
                    if (check_maillist.checked == true) {
                        //                                                        console.log(check_maillist);
                        maillist.push(check_maillist.value);
                    }
                }
            }
            var formData = {"check_maillist": maillist};
            var emails = formData.check_maillist;
            console.log(emails);
            console.log(mid);
            var fd = new FormData();
            fd.append('file', blob);
            $.ajax({
                url: "uploadAudio.php?list=" + emails + "&rid=" + mid + "&vtitle=" + vtitle,
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function (url) {
//                    $("#audio").attr("src", url);
//                    $("#audio")[0].play();
                    $("#loadStatus").fadeOut("slow");
                    $(".the-return").html(
                            "<b style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Voice Mails Sent Successfully.</b>"
                            );
                    $('#pvmailsAudio').load('list_resumes.php #pvmailsAudio', function () {
                    });

                }
            });
            $("#save").addClass("disabled");
            $("#pause").addClass("disabled");
        }, "blob");
        restore();
    });
});
