<head>
<script>
 
$('body').on('click', '#upload', function(e){
	alert();
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);

        $.ajax({
            url: 'upload.php',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
                alert("Data Uploaded: "+data);
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
})
</script>
</head>
<form enctype="multipart/form-data" action="upload.php" method="post">
    <input name="file[]" type="file" />
    <button class="add_more">Add More Files</button>
    <input type="button" value="Upload File" id="upload"/>
</form>
