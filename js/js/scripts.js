function checkTime() {

    $(function ()
    {
        $("#TimeAlert").hide();
        $('#countdown-1').timeTo(45, function ()
        {

            if ($('#countdown-1').css('display') == 'none')
            {

            }
            else {
                $("#TimeAlert").show();
                $(".one").addClass("disabled");

                $("#record, #live").removeClass("disabled");
            }
        });



    });
}
