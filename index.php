<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>四六级成绩查询 | 青春在线</title>
    <link rel="stylesheet" href="./statics/css/weui.css">
    <link rel="stylesheet" href="./statics/css/style.css">
</head>
<body ontouchstart style="background-color: #f8f8f8;">
<div class="page_hd">
    <h1 class="page_title">四六级成绩查询</h1>
    <p class="page_desc">四六级成绩查询 | 青春在线</p>
</div>
<div class="page_bd page__bd_spacing">
<form action="res.php" method = 'post' name = "msgform">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">准考证号</label>
            </div>
            <div class="weui-cell__bd">
                <input type="number" class="weui-input" pattern="[0-9]{15}" placeholder="请输入15位笔试或口试准考证号" name="zkzh" >
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">姓名</label>
            </div>
            <div class="weui-cell__bd">
                <input type="text" class="weui-input" pattern="[\u4e00-\u9fa5]{2,4}" placeholder="姓名超过3个字，可只输入前3个" name="xm" id="name">
            </div>
        </div>
        <div class="weui-btn-area">
            <input type="submit" value="提交" class="weui-btn weui-btn_primary">
        </div>
    </div>
</form>
<div class="weui-footer weui-footer_fixed-bottom">
            <p class="weui-footer__links">
                <a href="http://www.youthol.cn/wechat" class="weui-footer__link">学生服务</a>
            </p>
            <p class="weui-footer__text">Copyright © 2018 青春在线</p>
        </div>
        </div>
</body>
</html>