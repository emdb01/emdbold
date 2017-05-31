<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var emdbid='mmurali.technodrive@gmail.com';
        $.ajax({url: "https://www.employeemasterdatabase.com/getstatus.php?id="+emdbid,
            context: document.body,
            success: function (data) {
                alert(data);
            }});
    })
</script>