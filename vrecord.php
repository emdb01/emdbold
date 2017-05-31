
<input type="hidden" value="<?php echo $mid = $_SESSION['user_id']; ?>" id="midvalue">

<head>
    <script src="js/recorder.js"></script>
    <script src="js/Fr.voice.js"></script>
<!-- <script src="js/js/jquery.js"></script>-->
    <script src="js/audrecord.js"></script>
</head>
<!--Timer-------->
<link href="css/timeTo.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="js/js/jquery.timeTo.js"></script>
<script type="text/javascript" src="js/js/scripts.js"></script>
<!--Timer-------->

<body>
    <div id="autohide" style="">
        <div class="the-return" > </div>
        <input type="text" name="voicetitle" id="voicetitle" value="" required placeholder="Enter Title" class="form-control"><b id="voicealert"></b><br>
        <audio controls src="" id="audio"></audio> <b id="countdown-1"></b>
        <div style="margin-top:10px;">
            <a class="button" id="record">Start</a>
            <a class="button disabled one" id="pause">Stop</a>
            <a class="button disabled one " id="play">Play</a>
            <!-- <a class="button" id="base64">Save Or Send</a>-->
            <!--<a class="button disabled one" id="stop">Reset</a>
            <a class="button disabled one" id="download">Download</a>
<a class="button disabled one" id="mp3">MP3 URL</a>-->
            <a class="button disabled one" id="save">Send</a>

        </div>


    </div>
</body>

        <style>
            #loadStatus{display:none;color:#666666;margin-bottom:10px;width:20px;}
            .button{
                display: inline-block;
                vertical-align: middle;
                /*margin: 0px 5px;*/
                padding: 5px 12px;
                cursor: pointer;
                outline: none;
                font-size: 13px;
                text-decoration: none !important;
                text-align: center;
                color:#fff;
                background-color: #4D90FE;
                background-image: linear-gradient(top,#4D90FE, #4787ED);
                background-image: -ms-linear-gradient(top,#4D90FE, #4787ED);
                background-image: -o-linear-gradient(top,#4D90FE, #4787ED);
                background-image: linear-gradient(top,#4D90FE, #4787ED);
                border: 1px solid #4787ED;
                box-shadow: 0 1px 3px #BFBFBF;
            }
            a.button{
                color: #fff;
            }
            .button:hover{
                box-shadow: inset 0px 1px 1px #8C8C8C;
            }
            .button.disabled{
                box-shadow:none;
                opacity:0.7;
            }
        </style>