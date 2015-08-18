<?php
/*用错误代码表示最终的信息处理结果
 * $errorcode:
 * 0, 提交成功 其余为失败
 * 1, 禁止提交，IP被管理员屏蔽
 * 2, 提交过于频繁 基于IP池的判定
 * 3, 提供过于频繁，基于Cookie的判定
 * 4, 用户名为空
 * 5, 邮箱为空或者格式不正确
 * 6, 主要信息为空
 * 7, 数据库错误
 * 8, 其它错误
 */
$notice[0]['title']="Submit successfully!";
$notice[0]['body']="Submit successfully,We will contact you as soon as possible!";

$notice[1]['title']="Prohibit submission!";
$notice[1]['body']="Prohibit submission, Your IP has been banned Administrator!";


$notice[2]['title']="Submit Failed";
$notice[2]['body']="Your submission too frequently!";

$notice[3]['title']="Submit Failed";
$notice[3]['body']="Your submission too frequently!";

$notice[4]['title']="Submit Failed!";
$notice[4]['body']="Submit Failed, Please Input your name!";

$notice[5]['title']="Submit Failed!";
$notice[5]['body']="Submit Failed,Please Input Right Email Address!";

$notice[6]['title']="Submit Failed!";
$notice[6]['body']="Submit Failed,Please Input your Message!";

$notice[7]['title']="Submit Failed!";
$notice[7]['body']="Submit Failed, Database Error!";

$notice[8]['title']="Submit Failed!";
$notice[8]['body']="Submit Failed, Unknown error!";
?>
