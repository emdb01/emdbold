
<link href="js/filejs/uploadfilemulti.css" rel="stylesheet">
<script src="js/filejs/jquery-1.8.0.min.js"></script>
<script src="js/filejs/jquery.fileuploadmulti.min.js"></script>

<div id="mulitplefileuploader" >Upload</div>
<?php
if (isset($_GET['dir'])) {
    $path = $_GET['dir'];
} else {
    $path = 0;
}
?>
<div id="status"></div>
<script>

    $(document).ready(function ()
    {

        var settings = {
            url: "ajaxfileupload.php?dir=<?php echo $path; ?>",
            method: "POST",
            allowedTypes: "doc,docx,pdf,zip",
            fileName: "files",
            multiple: true,
            onSuccess: function (files, data, xhr)
            {
                $("#status").html("<font color='green'>Upload is success</font>");

            },
            afterUploadAll: function ()
            {
//                alert("All Files Uploaded Successfully.");
                setTimeout(function () {
                    window.location.href = "";
                }, 900);
            },
            onError: function (files, status, errMsg)
            {
                $("#status").html("<font color='red'>Upload is Failed</font>");
            }

        }
        $("#mulitplefileuploader").uploadFile(settings);

    });
</script>
