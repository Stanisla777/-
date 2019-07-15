<?php
/*******************************************************************************
Aprel jChat
http://aprel-chat.googlecode.com/
aprelvovanya@mail.ru
����� �������� ������������
Ryzhov Vladimir Vladimirovich
*******************************************************************************/
?>
<?php include("chat_config.php"); ?>
<script language="JavaScript" src="jquery-1.3.2.js" type="text/javascript"></script>
<script language="JavaScript" src="jquery.scrollTo.js" type="text/javascript"></script>
<link rel="stylesheet" href="chat.css" type="text/css" />
<script language="JavaScript" type="text/javascript">
/*<![CDATA[*/
var chat_waiting_time = <?= $chat_waiting_time ?>;
var chat_scroll_speed = <?= $chat_scroll_speed ?>;
var intervalID;
//������������� �������� ����� ���������
function get_new_msg() {
    var chat_id = $(".chat_msg:last").attr("id");
    var chat = $("#chat_body").html();
    $.ajax({
        type: "POST",
        url: "chat_dialog.php",
        data: "chat_id="+chat_id,
        dataType: "html",
        success: function(msg) {
            if(msg != "") {
                $("#chat_body").html(chat+msg);
                $("#chat_body").scrollTo("max", chat_scroll_speed);
            }
        }
    });
}

$(document).ready(function() {
    //��������� ���� � ����� (���� javascript ��������, �� ���� �� �����)
    $("#chat").css("display", "block");
    //�������� ��������� ��������� ��� �������� ��������
    $.ajax({
        type: "POST",
        url: "chat_dialog.php",
        data: "chat_last_msg=",
        dataType: "html",
        success: function(msg) {
            $("#chat_body").html(msg);
            $("#chat_body").scrollTo("max", chat_scroll_speed);
        }
    });
    //����� ������������� �������� ����� ���������
    intervalID = window.setInterval("get_new_msg()", chat_waiting_time);
    
    $("#chat_body").hover(function() {
        clearInterval(intervalID);
    }, function() {
        intervalID = window.setInterval("get_new_msg()", chat_waiting_time);
    });

    //�������� ��������� � ���
    $("#chat_send_message").click(function() {
        //�������� ��� ����������
        var chat_id = $(".chat_msg:last").attr("id");
        var chat_name = $.trim($("#chat_name").attr("value"));
        var chat_text = $.trim($("#chat_text").attr("value"));
        var chat = $("#chat_body").html();
        //��� ajax ������
        if(chat_name != "" & chat_text != "") {
            $.ajax({
                type: "POST",
                url: "chat_dialog.php",
                data: "chat_id="+chat_id+"&chat_name="+chat_name+"&chat_text="+chat_text,
                dataType: "html",
                success: function(msg) {
                    $("#chat_body").html(chat+msg);
                    $("#chat_text").attr("value", "").focus();
                    $("#chat_body").scrollTo("max", chat_scroll_speed);
                }
            });
        }
    });
});
/*]]>*/
</script>
<table id="chat">
    <tr><td><b>���� ����:</b></td></tr>
    <tr><td><div id="chat_body"></div></td></tr>
    <tr><td><b>���� ���:</b></td></tr>
    <tr><td><input id="chat_name" maxlength="<?= $chat_maxlength_name ?>" /></td></tr>
    <tr><td><b>����� ���������:</b></td></tr>
    <tr><td><textarea id="chat_text" rows="<?= $chat_text_rows ?>"></textarea></td></tr>
    <tr><td><input type="button" id="chat_send_message" value="���������" /></td></tr>
</table>