<?php
// 获取访问者ip
function getip(){
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $cip = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $cip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }elseif(!empty($_SERVER['REMOTE_ADDR'])){
    $cip = $_SERVER['REMOTE_ADDR'];
  }else{
    $cip = '';
  }
  return $cip;
}


function login_post($url,$header = array()) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); //重要，抓取跳转后数据
    curl_setopt($curl, CURLOPT_REFERER, 'http://www.chsi.com.cn/cet/');//重要，302跳转需要referer，可以在Request Headers找到 
    $result=curl_exec($curl);
    curl_close($curl);
    return $result;
}

$zh   = $_POST['zkzh'];
$name   = $_POST['xm'];
if(strlen($zh)!=15)//输入的数字不是15位，返回并提示
{
    echo "<script>alert('请输入15位准考证号！');history.go(-1);</script>";
    return;
}

$post = array(
    'zkzh'=>$zh,
    'xm'=>$name,
);
$post = http_build_query($post);//把键值对数组连成字符串变成url的参数形式
$url    = "http://www.chsi.com.cn/cet/query?".$post; //学信网查询四六级成绩地址

$client_ip = getip();
// 设置IP
$header = array(
  "CLIENT-IP: $client_ip",
  "X-FORWARDED-FOR: $client_ip"
);
$con2=login_post($url,$header); //模拟登陆

$arr = array();
$pattern = '/<td colspan="2">([\s\S]*)<\/td>/U';//正则匹配个人信息部分
preg_match_all($pattern,$con2, $arr);
if(sizeof($arr[1])==0)//如果匹配不到，说明输入数据有误，返回并报错
{
    echo "<script>alert('无法找到对应的分数，请确认您输入的准考证号及姓名无误！');history.go(-1);</script>";
    return;
}


$pattern = '/<span class="colorRed">([^<>]+)<\/span>/U';
$arr1 = array();
preg_match_all($pattern,$con2, $arr1);//正则匹配笔试总分数
$sum = intval($arr1[1][0]);


$pattern = '/<td>
                        
                        ([0-9]+)
                        
                    <\/td>/';
preg_match_all($pattern, $con2, $arr1);//正则匹配笔试的各项分数
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>四六级成绩查询 | 青春在线</title>
    <link rel="stylesheet" href="./statics/css/weui.css">
    <link rel="stylesheet" href="./statics/css/style.css">
</head>
<body ontouchstart style="background-color: #f8f8f8;">
<div class="page_hd" ontouchstart style="background-color: #f8f8f8;">
    <h1 class="page_title">四六级成绩查询</h1>
    <p class="page_desc">四六级成绩查询 | 青春在线</p>
</div>
<div class="page__bd" ontouchstart style="background-color: #f8f8f8;">
    <div>
        <div class="weui-cells__title">个人信息</div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>姓名</p>
                </div>
                <div class="weui-cell__ft"><?php echo $arr[1][0];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>学校</p>
                </div>
                <div class="weui-cell__ft"><?php echo $arr[1][1];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>考试级别</p>
                </div>
                <div class="weui-cell__ft"><?php echo $arr[1][2];?></div>
            </div>
        </div>
    </div>
    <div>
        <div class="weui-cells__title">笔试成绩</div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>准考证号</p>
                </div>
                <div class="weui-cell__ft"><?php echo $arr[1][3];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>总分</p>
                </div>
                <div class="weui-cell__ft"><?php echo $sum;?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>听力</p>
                </div>
                <div class="weui-cell__ft"><?php echo $arr1[1][0];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>阅读</p>
                </div>
                <div class="weui-cell__ft"><?php echo $arr1[1][1];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>写作和翻译</p>
                </div>
                <div class="weui-cell__ft"><?php echo $arr1[1][2];?></div>
            </div>
        </div>
    </div>
    <div>
        <div class="weui-cells__title">口试成绩</div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>准考证号</p>
                </div>
                <div class="weui-cell__ft"><?php echo $arr[1][4];?></div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>等级</p>
                </div>
                <div class="weui-cell__ft"><?php echo $arr[1][5];?></div>
            </div>
    </div>
    </div>
    <div class="icon-box">
            <div class="icon-box__ctn">
                <p class="icon-box__desc">注：查询结果仅供参考</p>
                <p class="icon-box__desc">一切结果以最终成绩单为准。</p>
            </div>
        </div>
            <div class="weui-footer">
            <p class="weui-footer__links">
                <a href="http://www.youthol.cn/wechat" class="weui-footer__link">学生服务</a>
            </p>
            <p class="weui-footer__text">Copyright © 2018 青春在线</p>
        </div>
</body>
</html>