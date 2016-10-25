<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0"/>
<title>WebIM-DEMO</title>
<!--sdk-->
<script src="static/sdk/strophe.js"></script>
<script src="static/sdk/easemob.im-1.1.js"></script>
<script src="static/sdk/easemob.im-1.1.shim.js"></script><!--兼容老版本sdk需引入此文件-->

<!--config-->
<script src="static/js/easemob.im.config.js"></script>

<!--demo-->
<script src="static/js/jquery-1.11.1.js"></script>
<script src="static/js/bootstrap.js"></script>
<link rel="stylesheet" href="static/css/bootstrap.css" />
<link rel="stylesheet" href="static/css/webim.css" />

<!-- <script type="text/javascript">
    console.log(Easemob);
</script> -->

<!--[if lte IE 9]>
<script src="static/js/jplayer/jquery.jplayer.min.js"></script>
<script src="static/js/swfupload/swfupload.js"></script>
<![endif]-->

</head>
<body>
<!--登录页面-->
    <div id="loginmodal" class="modal hide in" role="dialog"
        aria-hidden="true" data-backdrop="static" style="display: none;">
        <div class="modal-header">
            <h3>用户登录</h3>
        </div>
        <div class="modal-body">
            <table>
                <tr>
                    <td width="65%">
                        <label for="username">用户名:</label>
                        <input type="text" name="username" value="" id="username" tabindex="1"/>
                        <label for="password">密码:</label>
                        <input type="password" name="password" value="" id="password" tabindex="2" />
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button class="flatbtn-blu" onclick="login()" tabindex="3">登录</button>
        </div>
    </div>

<!--加载页面-->
    <div id="waitLoginmodal" class="modal hide" data-backdrop="static">
        <img src="static/img/waitting.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正在努力加载中...</img>
    </div>
<!--聊天页面-->
    <div class="content" id="content" style="display: block;">
<!--        左侧栏-->
        <div class="leftcontact" id="leftcontact">
<!--            头像。。顶栏-->
            <div id="headerimg" class="leftheader">
                <span> <img src="static/img/head/header2.jpg" alt="logo"
                    class="img-circle" width="60px" height="60px"
                    style="margin-top: -40px; margin-left: 20px" /></span> <span
                    id="login_user" class="login_user_title"> <a
                    class="leftheader-font" href="#"></a>
                </span> <span>
                    <div class="btn-group" style="margin-left: 5px;">
                        <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" onclick="showAddFriend()">添加好友</a></li>
                            <li><a href="javascript:;" onclick="showDelFriend()">删除好友</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:;" onclick="logout();return false;">退出</a></li>
                        </ul>
                    </div>
                </span>
            </div>
<!--            联系人-->
            <div id="contractlist11"
                style="height: 492px; overflow-y: auto; overflow-x: auto;">
                <div class="accordion" id="accordionDiv">
                    <div class="accordion-group" style="border-bottom: none;">
                        <div class="accordion-heading">
                            <a id="accordion1" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDiv" href="#collapseOne">我的好友 </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner" id="contractlist">
                                <ul id="contactlistUL" class="chat03_content_ul"></ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="rightTop" style="height: 78px;"></div>
        <!-- 聊天页面 -->
        <div class="chatRight" id="chat">
            <div id="chat01">
                <div class="chat01_title">
                    <ul class="talkTo">
                        <li id="talkTo"><a href="#"></a></li>
                        <li id="recycle" style="float: right;"><img
                            src="static/img/recycle.png" onclick="clearCurrentChat();"
                            style="margin-right: 15px; cursor: hand; width: 18px;" title="清屏" /></li>
                        <li id="roomInfo" style="float: right;"><img
                            id="roomMemberImg"
                            src="static/img/head/find_more_friend_addfriend_icon.png"
                            onclick="showRoomMember();"
                            style="margin-right: 15px; cursor: hand; width: 18px; display: none"
                            title="成员" /></li>
                    </ul>
                </div>
                <div id="null-nouser" class="chat01_content"></div>
            </div>

            <div class="chat02">
                <div class="chat02_title">
                    <a class="chat02_title_btn ctb01" onclick="showEmotionDialog()" title="选择表情"></a>
					<input id='sendPicInput' style='display:none'/>
					<a class="chat02_title_btn ctb03" title="选择图片" onclick="send()" type='img' href="#"></a>
					<input id='sendAudioInput' style='display:none'/>
					<a class="chat02_title_btn ctb02" title="选择语音" onclick="send()" href="#" type='audio'></a>
                    <a class="chat02_title_btn ctb04" title="聊天记录" onclick="showMsg()" href="#" type="data"></a>
					<!--<input id='sendFileInput' class='emim-hide'/>
					<a class="chat02_title_btn ctb04" title="选择文件" onclick="send()" href="#"></a>-->
					<label id="chat02_title_t"></label>
                    <div id="wl_faces_box" class="wl_faces_box">
                        <div class="wl_faces_content">
                            <div class="title">
                                <ul>
                                    <li class="title_name">常用表情</li>
                                    <li class="wl_faces_close"><span
                                        onclick='turnoffFaces_box()'>&nbsp;</span></li>
                                </ul>
                            </div>
                            <div id="wl_faces_main" class="wl_faces_main">
                                <ul id="emotionUL">
                                </ul>
                            </div>
                        </div>
                        <div class="wlf_icon"></div>
                    </div>
                </div>
                <div id="input_content" class="chat02_content">
                    <textarea id="talkInputId" style="resize: none;"></textarea>
                </div>
                <div class="chat02_bar">
                    <ul>
                        <li style="right: 5px; top: 5px;"><img src="static/img/send_btn.jpg"
                            onclick="sendText()" /></li>
                    </ul>
                </div>

                <div style="clear: both;"></div>
            </div>
        </div>

        <div class="chatRight" id="record" style="display:none;">
            <div>
                <div class="chat01_title">
                    <ul class="talkTo">
                        <li id="talkTo_record"><a href="#"></a></li>
                    </ul>
                </div>
                <div class="record_content">
                </div>
                <div class="chat02_bar">
                    <ul>
                        <li style="right: 5px; top: 5px;"><a href="javascript:void(0);" onclick="hidden_record();">返回</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="addFridentModal" class="modal hide" role="dialog"
            aria-hidden="true" data-backdrop="static">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <h3>添加好友</h3>
            </div>
            <div class="modal-body">
                <input id="addfridentId" onfocus='clearInputValue("addfridentId")' />
                <div id="add-frident-warning"></div>
            </div>
            <div class="modal-footer">
                <button id="addFridend" class="btn btn-primary"
                    onclick="startAddFriend()">添加</button>
                <button id="cancelAddFridend" class="btn" data-dismiss="modal">取消</button>
            </div>
        </div>

        <div id="delFridentModal" class="modal hide" role="dialog"
            aria-hidden="true" data-backdrop="static">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <h3>删除好友</h3>
            </div>
            <div class="modal-body">
                <input id="delfridentId" onfocus='clearInputValue("delfridentId")' />
                <div id="del-frident-warning"></div>
            </div>
            <div class="modal-footer">
                <button id="delFridend" class="btn btn-primary"
                    onclick="directDelFriend()">删除</button>
                <button id="canceldelFridend" class="btn" data-dismiss="modal">取消</button>
            </div>
        </div>

        <!-- 一般消息通知 -->
        <div id="notice-block-div" class="modal hide">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <div class="modal-body">
                <h4>Warning!</h4>
                <div id="notice-block-body"></div>
            </div>
        </div>

        <!-- 确认消息通知 -->
        <div id="confirm-block-div-modal" class="modal hide"
            role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-header">
                <h3>订阅通知</h3>
            </div>
            <div class="modal-body">
                <div id="confirm-block-footer-body"></div>
            </div>
            <div class="modal-footer">
                <button id="confirm-block-footer-confirmButton"
                    class="btn btn-primary">同意</button>
                <button id="confirm-block-footer-cancelButton" class="btn"
                    data-dismiss="modal">拒绝</button>
            </div>
        </div>

        <!-- 群组成员操作界面 -->
        <div id="option-room-div-modal" class="alert modal hide"
            role="dialog" aria-hidden="true" data-backdrop="static">
            <button type="button" class="close" data-dismiss="modal"
                aria-hidden="true">&times;</button>
            <div class="modal-header">
                <h3>成员</h3>
            </div>
            <div class="modal-body">
                <div id="room-member-list" style="height: 100px; overflow-y: auto"></div>
            </div>
        </div>
    </div>
	<input type='file' id="fileInput" style='display:none;'/>
	<div id='alert' class='em-alert' style='display:none;'><span></span><button>好的</button></div>
	<script src="static/js/webim.js"></script>
<script type="text/javascript">
    $(function(){
            var user = 'admin';
            var pass = 'admin';
            hiddenLoginUI();
            showWaitLoginedUI();
            //根据用户名密码登录系统
            conn.open({
                apiUrl : Easemob.im.config.apiURL,
                user : user,
                pwd : pass,
                //连接时提供appkey
                appKey : Easemob.im.config.appkey
            });         

            // 传这个
            // defaultChatId = "eee";
            // defaultChatId = $ChatId;
            <?php
                if(isset($_GET['chatid']))
                {
                    $ChatId = $_GET['chatid'];
                    echo "defaultChatId = '$ChatId'";
                }
            ?>

            // console.log(defaultChatId);

})
</script>


<?php

    include "Easemob.class.php";

    $options['client_id']='YXA6f5YwwBLHEeaQZPUnEvVuwA';
    $options['client_secret']='YXA6fj97nxicGEEHn4aACYAh_8hq_Hc';
    $options['org_name']='tmn07';
    $options['app_name']='chatme';
    //"77f9a16a-1387-11e6-a4b7-419c4f2cd8bd"
    $h=new Easemob($options);

    $h->addFriend($ChatId,"admin");


?>
</body>
</html>
