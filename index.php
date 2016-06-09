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
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a id="accordion1" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDiv" href="#collapseOne">我的好友 </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner" id="contractlist">
                                <ul id="contactlistUL" class="chat03_content_ul"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a id="accordion2" class="accordion-toggle collapsed"
                                data-toggle="collapse" data-parent="#accordionDiv"
                                href="#collapseTwo">我的群组</a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                            <div class="accordion-inner" id="contracgrouplist">
                                <ul id="contracgrouplistUL" class="chat03_content_ul"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a id="accordion3" class="accordion-toggle collapsed"
                                data-toggle="collapse" data-parent="#accordionDiv"
                                href="#collapseThree">陌生人</a>
                        </div>
                        <div id="collapseThree" class="accordion-body collapse">
                            <div class="accordion-inner" id="momogrouplist">
                                <ul id="momogrouplistUL" class="chat03_content_ul"></ul>
                            </div>
                        </div>
                    </div>
					<div id='em-cr' class="accordion-group">
                        <div class="accordion-heading">
                            <a id="accordion4" class="accordion-toggle collapsed"
                                data-toggle="collapse" data-parent="#accordionDiv"
                                href="#collapseFour">聊天室</a>
                        </div>
                        <div id="collapseFour" class="accordion-body collapse">
                            <div class="accordion-inner" id="chatRoomList">
                                <ul id="chatRoomListUL" class="chat03_content_ul"></ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="rightTop" style="height: 78px;"></div>
        <!-- 聊天页面 -->
        <div class="chatRight">
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
                    <a class="chat02_title_btn ctb04" title="导出聊天记录" onclick="showMsg()" href="#" type="data"></a>
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
// $ChatId = $_GET['chatid'];
//var_dump($chatid);
//var_dump("wrong!!!");
$i=20;
switch($i){
    case 10://获取token
        $token=$h->getToken();
        var_dump($token);
        break;
    case 11://创建单个用户
        var_dump($h->createUser("zhangsan","123456"));
        break;
    case 12://创建批量用户
        var_dump($h->createUsers(array(
            array(
                "username"=>"zhangsan",
                "password"=>"123456"
            ),
            array(
                "username"=>"lisi",
                "password"=>"123456"
            )
        )));
        break;
    case 13://重置用户密码
        var_dump($h->resetPassword("zhangsan","123456"));
        break;
    case 14://获取单个用户
        var_dump($h->getUser("admin"));
        break;
    case 15://获取批量用户---不分页(默认返回10个)
        var_dump($h->getUsers());
        break;
    case 16://获取批量用户----分页
        $cursor=$h->readCursor("userfile.txt");
        var_dump($h->getUsersForPage(10,$cursor));
        break;
    case 17://删除单个用户
        var_dump($h->deleteUser("zhangsan"));
        break;
    case 18://删除批量用户
        var_dump($h->deleteUsers(2));
        break;
    case 19://修改昵称
        var_dump($h->editNickname("zhangsan","小B"));
        break;
    case 20://添加好友------400
//        $h->addFriend("admin",$ChatId);
        $h->addFriend($ChatId,"admin");
//        var_dump($h->addFriend("admin",$ChatId));
        break;
    case 21://删除好友
        var_dump($h->deleteFriend("zhangsan","lisi"));
        break;
    case 22://查看好友
        var_dump($h->showFriends("zhangsan"));
        break;
    case 23://查看黑名单
        var_dump($h->getBlacklist("zhangsan"));
        break;
    case 24://往黑名单中加人
        $usernames=array(
            "usernames"=>array("wangwu","lisi")
        );
        var_dump($h->addUserForBlacklist("zhangsan",$usernames));
        break;
    case 25://从黑名单中减人
        var_dump($h->deleteUserFromBlacklist("zhangsan","lisi"));
        break;
    case 26://查看用户是否在线
        var_dump($h->isOnline("zhangsan"));
        break;
    case 27://查看用户离线消息数
        var_dump($h->getOfflineMessages("admin"));
        break;
    case 28://查看某条消息的离线状态
        var_dump($h->getOfflineMessageStatus("zhangsan","77225969013752296_pd7J8-20-c3104"));
        break;
    case 29://禁用用户账号----
        var_dump($h->deactiveUser("zhangsan"));
        break;
    case 30://解禁用户账号-----
        var_dump($h->activeUser("zhangsan"));
        break;
    case 31://强制用户下线
        var_dump($h->disconnectUser("zhangsan"));
        break;
    case 32://上传图片或文件
        var_dump($h->uploadFile("./resource/up/pujing.jpg"));
        //var_dump($h->uploadFile("./resource/up/mangai.mp3"));
        //var_dump($h->uploadFile("./resource/up/sunny.mp4"));
        break;
    case 33://下载图片或文件
        var_dump($h->downloadFile('01adb440-7be0-11e5-8b3f-e7e11cda33bb','Aa20SnvgEeWul_Mq8KN-Ck-613IMXvJN8i6U9kBKzYo13RL5'));
        break;
    case 34://下载图片缩略图
        var_dump($h->downloadThumbnail('01adb440-7be0-11e5-8b3f-e7e11cda33bb','Aa20SnvgEeWul_Mq8KN-Ck-613IMXvJN8i6U9kBKzYo13RL5'));
        break;
    case 35://发送文本消息
        $from='admin';
        $target_type="users";
        //$target_type="chatgroups";
        $target=array("zhangsan","lisi","wangwu");
        //$target=array("122633509780062768");
        $content="Hello HuanXin!";
        $ext['a']="a";
        $ext['b']="b";
        var_dump($h->sendText($from,$target_type,$target,$content,$ext));
        break;
    case 36://发送透传消息
        $from='admin';
        $target_type="users";
        //$target_type="chatgroups";
        $target=array("zhangsan","lisi","wangwu");
        //$target=array("122633509780062768");
        $action="Hello HuanXin!";
        $ext['a']="a";
        $ext['b']="b";
        var_dump($h->sendCmd($from,$target_type,$target,$action,$ext));
        break;
    case 37://发送图片消息
        $filePath="./resource/up/pujing.jpg";
        $from='admin';
        $target_type="users";
        $target=array("zhangsan","lisi");
        $filename="pujing.jpg";
        $ext['a']="a";
        $ext['b']="b";
        var_dump($h->sendImage($filePath,$from,$target_type,$target,$filename,$ext));
        break;
    case 38://发送语音消息
        $filePath="./resource/up/mangai.mp3";
        $from='admin';
        $target_type="users";
        $target=array("zhangsan","lisi");
        $filename="mangai.mp3";
        $length=10;
        $ext['a']="a";
        $ext['b']="b";
        var_dump($h->sendAudio($filePath,$from="admin",$target_type,$target,$filename,$length,$ext));
        break;
    case 39://发送视频消息
        $filePath="./resource/up/sunny.mp4";
        $from='admin';
        $target_type="users";
        $target=array("zhangsan","lisi");
        $filename="sunny.mp4";
        $length=10;//时长
        $thumb='https://a1.easemob.com/easemob-demo/chatdemoui/chatfiles/c06588c0-7df4-11e5-932c-9f90699e6d72';
        $thumb_secret='wGWIyn30EeW9AD1fA7wz23zI8-dl3PJI0yKyI3Iqk08NBqCJ';
        $ext['a']="a";
        $ext['b']="b";
        var_dump($h->sendVedio($filePath,$from="admin",$target_type,$target,$filename,$length,$thumb,$thumb_secret,$ext));
        break;
    case 40://发文件消息

        break;
    case 41://获取app中的所有群组-----不分页（默认返回10个）
        var_dump($h->getGroups());
        break;
    case 42:////获取app中的所有群组--------分页
        $cursor=$h->readCursor("groupfile.txt");
        var_dump($h->getGroupsForPage(2,$cursor));
        break;
    case 43://获取一个或多个群组的详情
        $group_ids=array("1445830526109","1445833238210");
        var_dump($h->getGroupDetail($group_ids));
        break;
    case 44://创建一个群组
        $options ['groupname'] = "group001";
        $options ['desc'] = "this is a love group";
        $options ['public'] = true;
        $options ['owner'] = "zhangsan";
        $options['members']=Array("fengpei","lisi");
        var_dump($h->createGroup($options));
        break;
    case 45://修改群组信息
        $group_id="124113058216804760";
        $options['groupname']="group002";
        $options['description']="修改群描述";
        $options['maxusers']=300;
        var_dump($h->modifyGroupInfo($group_id,$options));
        break;
    case 46://删除群组
        $group_id="124113058216804760";
        var_dump($h->deleteGroup($group_id));
        break;
    case 47://获取群组中的成员
        $group_id="122633509780062768";
        var_dump($h->getGroupUsers($group_id));
        break;
    case 48://群组单个加人------
        $group_id="122633509780062768";
        $username="lisi";
        var_dump($h->addGroupMember($group_id,$username));
        break;
    case 49://群组批量加人
        $group_id="122633509780062768";
        $usernames['usernames']=array("wangwu","lisi");
        var_dump($h->addGroupMembers($group_id,$usernames));
        break;
    case 50://群组单个减人
        $group_id="122633509780062768";
        $username="test";
        var_dump($h->deleteGroupMember($group_id,$username));
        break;
    case 51://群组批量减人-----
        $group_id="122633509780062768";
        //$usernames['usernames']=array("wangwu","lisi");
        $usernames='wangwu,lisi';
        var_dump($h->deleteGroupMembers($group_id,$usernames));
        break;
    case 52://获取一个用户参与的所有群组
        var_dump($h->getGroupsForUser("zhangsan"));
        break;
    case 53://群组转让
        $group_id="122633509780062768";
        $options['newowner']="lisi";
        var_dump($h->changeGroupOwner($group_id,$options));
        break;
    case 54://查询一个群组黑名单用户名列表
        $group_id="122633509780062768";
        var_dump($h->getGroupBlackList($group_id));
        break;
    case 55://群组黑名单单个加人-----
        $group_id="122633509780062768";
        $username="lisi";
        var_dump($h->addGroupBlackMember($group_id,$username));
        break;
    case 56://群组黑名单批量加人
        $group_id="122633509780062768";
        $usernames['usernames']=array("lisi","wangwu");
        var_dump($h->addGroupBlackMembers($group_id,$usernames));
        break;
    case 57://群组黑名单单个减人
        $group_id="122633509780062768";
        $username="lisi";
        var_dump($h->deleteGroupBlackMember($group_id,$username));
        break;
    case 58://群组黑名单批量减人
        $group_id="122633509780062768";
        $usernames['usernames']=array("wangwu","lisi");
        var_dump($h->deleteGroupBlackMembers($group_id,$usernames));
        break;
    case 59://创建聊天室
        $options ['name'] = "chatroom001";
        $options ['description'] = "this is a love chatroom";
        $options ['maxusers'] = 300;
        $options ['owner'] = "zhangsan";
        $options['members']=Array("man","lisi");
        var_dump($h->createChatRoom($options));
        break;
    case 60://修改聊天室信息
        $chatroom_id="124121390293975664";
        $options['name']="chatroom002";
        $options['description']="修改聊天室描述";
        $options['maxusers']=300;
        var_dump($h->modifyChatRoom($chatroom_id,$options));
        break;
    case 61://删除聊天室
        $chatroom_id="124121390293975664";
        var_dump($h->deleteChatRoom($chatroom_id));
        break;
    case 62://获取app中所有的聊天室
        var_dump($h->getChatRooms());
        break;
    case 63://获取一个聊天室的详情
        $chatroom_id="124121939693277716";
        var_dump($h->getChatRoomDetail($chatroom_id));
        break;
    case 64://获取一个用户加入的所有聊天室
        var_dump($h->getChatRoomJoined("zhangsan"));
        break;
    case 65://聊天室单个成员添加--
        $chatroom_id="124121939693277716";
        $username="zhangsan";
        var_dump($h->addChatRoomMember($chatroom_id,$username));
        break;
    case 66://聊天室批量成员添加
        $chatroom_id="124121939693277716";
        $usernames['usernames']=array('wangwu','lisi');
        var_dump($h->addChatRoomMembers($chatroom_id,$usernames));
        break;
    case 67://聊天室单个成员删除
        $chatroom_id="124121939693277716";
        $username="zhangsan";
        var_dump($h->deleteChatRoomMember($chatroom_id,$username));
        break;
    case 68://聊天室批量成员删除
        $chatroom_id="124121939693277716";
        //$usernames['usernames']=array('zhangsan','lisi');
        $usernames='zhangsan,lisi';
        var_dump($h->deleteChatRoomMembers($chatroom_id,$usernames));
        break;
    case 69://导出聊天记录-------不分页
        $ql="select+*+where+timestamp>1435536480000";
        var_dump($h->getChatRecord($ql));
        break;
    case 70://导出聊天记录-------分页
        $ql="select+*+where+timestamp>1435536480000";
        $cursor=$h->readCursor("chatfile.txt");
        //var_dump($h->$cursor);
        // var_dump($cursor);
        var_dump($h->getChatRecordForPage($ql,2,$cursor));
        break;
}
?>
</body>
</html>
