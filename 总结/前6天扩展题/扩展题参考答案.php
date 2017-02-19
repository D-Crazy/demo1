<?php
//输出图下图案（其中的行数可以由一个变量$n来控制，
//以下假设$n = 4；其中输出的空格请使用“&ensp;”）：

$n = 7;
define("KONGGE","&ensp;");

//
echo "<p>图形A：<br />";
for($i = 1; $i <= $n; ++$i){
	for($j = 1; $j <= $n; ++$j){
		echo "*";
	}
	echo "<br />";
}

echo "<p>图形B：<br />";
for($i = 1; $i <= $n; ++$i){
	for($j = 1; $j <= $i; ++$j){
		echo "*";
	}
	echo "<br />";
}

echo "<p>图形C：<br />";
for($i = 1; $i <= $n; ++$i){
	for($j = 1; $j <= 2*$i-1; ++$j){
		echo "*";
	}
	echo "<br />";
}

echo "<p>图形D：<br />";
for($i = 1; $i <= $n; ++$i){
	for($k = 1; $k <= $n-$i; ++$k){
		echo KONGGE;
	}
	for($j = 1; $j <= 2*$i-1; ++$j){
		echo "*";
	}
	echo "<br />";
}


echo "<p>图形E：<br />";
for($i = 1; $i <= $n; ++$i){
	for($k = 1; $k <= $n-$i; ++$k){
		echo KONGGE;
	}
	for($j = 1; $j <= 2*$i-1; ++$j){
		if($j == 1 || $j == 2*$i-1){//是第一个或最后一个
			echo "*";
		}
		else{
			echo KONGGE;
		}
	}
	echo "<br />";
}

echo "<p>图形F：<br />";
for($i = 1; $i <= $n; ++$i){
	for($k = 1; $k <= $n-$i; ++$k){
		echo KONGGE;
	}
	for($j = 1; $j <= 2*$i-1; ++$j){
		if($i == $n){//是最后一行
			echo "*";
		}
		else{
			if($j == 1 || $j == 2*$i-1){//是第一个或最后一个
				echo "*";
			}
			else{
				echo KONGGE;
			}
		}
	}
	echo "<br />";
}


echo "<p>图形G：<br />";
for($i = 1; $i <= $n; ++$i){
	for($k = 1; $k <= $n-$i; ++$k){
		echo KONGGE;
	}
	for($j = 1; $j <= 2*$i-1; ++$j){
		if($j == 1 || $j == 2*$i-1){//是第一个或最后一个
			echo "*";
		}
		else{
			echo KONGGE;
		}
	}
	echo "<br />";
}
for($i = $n-1; $i >= 1; --$i){
	for($k = 1; $k <= $n-$i; ++$k){
		echo KONGGE;
	}
	for($j = 1; $j <= 2*$i-1; ++$j){
		if($j == 1 || $j == 2*$i-1){//是第一个或最后一个
			echo "*";
		}
		else{
			echo KONGGE;
		}
	}
	echo "<br />";
}


/*
百钱百鸡问题：
已知：公鸡5元一只，母鸡3元一只，小鸡一元3只。现用100元钱买了100只鸡，
问：公鸡母鸡小鸡各几只？——请考虑尽可能高效的方法。
*/
/*
分析：
	假设1只公鸡，1只母鸡，1只小鸡，算算：总数和总价，发现不对！
	假设1只公鸡，1只母鸡，2只小鸡，算算：总数和总价，发现不对！
	假设1只公鸡，1只母鸡，3只小鸡，算算：总数和总价，发现不对！
	.........
	假设1只公鸡，2只母鸡，1只小鸡，算算：总数和总价，发现不对！
	假设1只公鸡，2只母鸡，2只小鸡，算算：总数和总价，发现不对！
	................
	假设2只公鸡，1只母鸡，1只小鸡，算算：总数和总价，发现不对！
	假设2只公鸡，1只母鸡，2只小鸡，算算：总数和总价，发现不对！
	.......................
	假设100只公鸡，100只母鸡，100只小鸡，算算：总数和总价，发现不对！
	这种思路，就称为：穷举思路，穷举思想，它适合于这种场合的问题：
		问题的答案可能没有很直接的逻辑推理结论，但可以将所有“可能答案”
		都罗列出来，并且具有一定的规律！
*/
//原始思路：（穷举的演示）：
$c = 0;
for($gongji = 0; $gongji <= 100; ++$gongji){
	for($muji = 0; $muji <= 100; ++$muji){
		for($xiaoji = 0; $xiaoji<=100; ++$xiaoji){

			$shuliang = $gongji + $muji + $xiaoji;	//计算总数
			$zongjia = $gongji*5 + $muji*3 + $xiaoji/3;//计算总价
			if($shuliang == 100 && $zongjia == 100){
				echo "<br />公鸡为：$gongji, 母鸡为：$muji, 小鸡为：$xiaoji";
			}
			++$c;	//代表进行计算的次数
		}
	}
}
echo "<br />总计算次数：$c";


//优化1：
$c = 0;
for($gongji = 0; $gongji <= 100/5; ++$gongji){//考虑公鸡的价格
	for($muji = 0; $muji <= 100/3; ++$muji){//考虑母鸡鸡的价格
		//for($xiaoji = 0; $xiaoji<=100; ++$xiaoji){
			$xiaoji = 100 - $gongji - $muji;//一旦确定公鸡母鸡数量，小鸡数量也可以确定了！

			//$shuliang = $gongji + $muji + $xiaoji;	//计算总数
			$zongjia = $gongji*5 + $muji*3 + $xiaoji/3;//计算总价
			if($zongjia == 100){
				echo "<br />公鸡为：$gongji, 母鸡为：$muji, 小鸡为：$xiaoji";
			}
			++$c;	//代表进行计算的次数
		//}
	}
}
echo "<br />总计算次数：$c";

//优化2：
$c = 0;
for($gongji = 0; $gongji <= 100/5; ++$gongji){//考虑公鸡的价格
	for($muji = 0; $muji <= (100-$gongji*5)/3; ++$muji){//考虑母鸡鸡的价格，以及公鸡所花掉的钱
		//for($xiaoji = 0; $xiaoji<=100; ++$xiaoji){
			$xiaoji = 100 - $gongji - $muji;//一旦确定公鸡母鸡数量，小鸡数量也可以确定了！

			//$shuliang = $gongji + $muji + $xiaoji;	//计算总数
			$zongjia = $gongji*5 + $muji*3 + $xiaoji/3;//计算总价
			if($zongjia == 100){
				echo "<br />公鸡为：$gongji, 母鸡为：$muji, 小鸡为：$xiaoji";
			}
			++$c;	//代表进行计算的次数
		//}
	}
}
echo "<br />总计算次数：$c";

//优化3：
$c = 0;
for($gongji = 0; $gongji <= 100/5; ++$gongji){//考虑公鸡的价格
	for($muji = 0; $muji <= (100-$gongji*5)/3; ++$muji){//考虑母鸡鸡的价格，以及公鸡所花掉的钱
		//for($xiaoji = 0; $xiaoji<=100; ++$xiaoji){
			$xiaoji = 100 - $gongji - $muji;//一旦确定公鸡母鸡数量，小鸡数量也可以确定了！
			if($xiaoji % 3 != 0){
				continue;	//考虑小鸡的数量应该是3的倍数，价钱才能“取整”
			}

			//$shuliang = $gongji + $muji + $xiaoji;	//计算总数
			$zongjia = $gongji*5 + $muji*3 + $xiaoji/3;//计算总价
			if($zongjia == 100){
				echo "<br />公鸡为：$gongji, 母鸡为：$muji, 小鸡为：$xiaoji";
			}
			++$c;	//代表进行计算的次数
		//}
	}
}
echo "<br />总计算次数：$c";
?>

<?php
/*
〉〉，
输出如下错误代号（系统常量），及对应十进制值和二进制值（16位）；
——有本事你不看提示：
所有错误代号："E_ERROR", "E_WARNING", "E_PARSE", "E_NOTICE", "E_CORE_ERROR", "E_CORE_WARNING", "E_COMPILE_ERROR", "E_COMPILE_WARNING", "E_USER_ERROR", "E_USER_WARNING", "E_USER_NOTICE","E_STRICT","E_ALL"
*/

$arr = array("E_ERROR", "E_WARNING", "E_PARSE", "E_NOTICE", "E_CORE_ERROR", "E_CORE_WARNING", "E_COMPILE_ERROR", "E_COMPILE_WARNING", "E_USER_ERROR", "E_USER_WARNING", "E_USER_NOTICE","E_STRICT","E_ALL");

function zhuanhuan($n){
	$s = decbin($n);	//转换为2进制数字字符串
	$s = str_pad($s, 16, "0", STR_PAD_LEFT);//填充字符串
	$s = str_replace("1", "<font color='red'>1</font>", $s);
	return $s;
}
echo "<table border='1'>";
foreach($arr as $key => $value){
	echo "<tr>";
		echo "<td>$value</td>";
		echo "<td>" .  constant($value)  . "</td>";
		echo "<td>" .  zhuanhuan( constant($value) )  . "</td>";
	echo "</tr>";
}
	echo "<tr>";
		echo "<td>E_ALL | E_STRICT</td>";
		echo "<td>" .  (E_ALL | E_STRICT)  . "</td>";
		echo "<td>" .  zhuanhuan( E_ALL | E_STRICT )  . "</td>";
	echo "</tr>";
echo "</table>";

/*
写一个表单，可以输入一个数字，提交后判断该数字是否是一个“素数”。
如果是，就输出“数字xx是素数”，否则就输出“数字xx不是素数”。
提示：素数的概念（含义）是：只能被1和它自己本身整除——在大于1的整数范围内。
*/
if( !empty($_POST['n']) ){
	$n = $_POST['n'];
	$c = 0;	//用于记录能被整除的个数！——计数
	for($i = 1; $i <= $n; ++$i){
		if($n % $i == 0){
			$c++;	//计数，就是数能整除的个数
		}
	}
	if($c == 2){
		echo "{$n}是素数";
	}
	else{
		echo "{$n}不是素数";
	}
}
?>

<?php
/*
〉〉，
利用上一道题的逻辑思路，写一个函数，该函数能够判断一个数字是否是一个素数
（是就返回true，否则就返回false）。再利用该函数，输出2-200之间的所有素数。
*/
function panduan($n){
	$c = 0;	//用于记录能被整除的个数！——计数
	for($i = 1; $i <= $n; ++$i){
		if($n % $i == 0){
			$c++;	//计数，就是数能整除的个数
		}
	}
	if($c == 2){
		return true;
	}
	else{
		return false;
	}
}
echo "2-200之间的素数有：";
for($i = 2; $i<=200; ++$i){
	if(	 panduan($i) == true ){
		echo "{$i} ";
	}
}

//扩展一个函数的思想：写一个函数，判断某个年份是否是闰年：
function runnian($n){
	if($n % 4 == 0 && $n % 100 != 0 || $n % 400 == 0){
		//echo "{$n}是闰年";	//这种写法不符合题意
		return true;
	}
	else{
		//echo "{$n}不是闰年";	//这种写法不符合题意
		return false;
	}
}

/*
〉〉（选做），
写2个函数，分别可以求得两个正整数的最大公约数和最小公倍数。
提示：
最大公约数就是能够同时整除该两个数的最大的那个。比如24和36的最大公约数是12
最小公倍数就是能够同时被该两个数整除的最小的那个。比如24和36的最小公倍数是72
*/
//最大公约数

function yueshu($m,$n){
	for($i=$m;$i>=1;$i--){
		if($m==$n){
			return $m;
		}
		if($m%$i==0 && $n%$i==0){
			return $i;
		}
	}
}
echo "最大公约数：" . yueshu(12,24) . "<br />";

//最小公倍数

function gongbeishu($m,$n){
	for($i=1;$i>=1;$i++){
		if($i%$m==0 && $i%$n==0){
			return $i;
		}
	}
}
echo "最小公倍数：" . gongbeishu(24,36) . "<br />";

/*
〉〉，
写一个函数，该函数可以将给定的任意个数的参数以指定的字符串串接起来成为一个长的字符串。该函数带2个或2个以上参数，其中第一个参数是用于将其他参数进行串联的连接字符串。比如调用该函数：
chuanlian(“-”, “ab”, “cd”, 123);	//得到结果为字符串：”ab-cd-123”
*/
function chuanlian(){
	$arr = func_get_args();	//获得所有实参。
	$s1 = $arr[0];		//用作串接符
	$len = count($arr);	//获取数组的长度；
	$str = "";			//用于存储串联之后的结果。
	for($i = 1; $i<$len; ++$i){
		if( $i == $len-1 ){	//如果是最后一项
			$str .= $arr[$i];
		}
		else{
			$str .= $arr[$i] . $s1;
		}
	}
	return $str;
}
$str = chuanlian('-', "ab", "cd", 123);
echo "<hr />串联后结果为：$str";

/*使用递归法和递推法（迭代法）求n的阶层（n为任意给定的大于等于1的整数）。*/
//递归思想     1*2*3*4*5*6
echo "<br />";
function jiechen($n)
{
	if($n==1)
	{
		return 1;
	}
	$jieguo = $n * jiechen($n-1);
	return $jieguo;
}
$v1 = jiechen(6);
echo $v1."<br />";


//递推思想
// 1*2*3*4*5*6
$n=6;
$qian = 1;
for($i=2;$i<=$n;$i++)
{
	$jieguo = $qian * $i;
	$qian = $jieguo;
}
echo $jieguo."<br />";


/*
〉〉，
数列如下：【1】，【2】，3，6，9，18，27… ，求第20项的值是多少？
（注意，规律就是第n个数是第n-2个数的3倍，已知第一个是1，第二个是2）。
*/
//方法2：递归：
function shulie1($n){
	if($n == 1){
		return 1;
	}
	else if($n == 2){
		return 2;
	}
	else{
		$re = shulie1($n-2)*3;
		return $re;
	}
}

$v1 = shulie1(20);
echo "<hr />20项是" . $v1;



//方法2：递推：
function shulie2($n){
	$qian1 = 1;
	$qian2 = 2;
	for($i = 3; $i <= $n; ++$i){
		$result = $qian1*3;
		$qian1 = $qian2;
		$qian2 = $result;
	}
	return $result;
}
$v2 = shulie2(20);
echo "<hr />20项是" . $v2;

/*
猴子吃桃问题：
有一堆桃子，猴子第一天吃了其中的一半，并再多吃了一个！
以后每天猴子都吃其中的一半，然后再多吃一个。
当到第十天时，想再吃时（即还没吃），发现只有1个桃子了。
问题：最初共多少个桃子？
分析：
天		数量
10		1
9		(1+1)*2=4
8		(4+1)*2=10
7		(10+1)*2=22
。。。。。。
第n天   （第n+1天的个数+1）*2
（可用递归法和递推法完成）
*/
echo "<hr />";

//方法1：递归：
function taozi1($n){
	if($n == 10){
		return 1;
	}
	else{
		$re = (taozi1($n+1) + 1) * 2;  $re = (taozi($n+1))
		return $re;
	}
}
echo "<br />第1天桃子数为：" . taozi1(1);
echo "<br />第4天桃子数为：" . taozi1(4);

//方法2：递推：
function taozi2($n){
	$qian = 1;	//代表第10天的；
	for($i = 9; $i>=$n; --$i){
		$result = ($qian + 1) * 2;
		$qian = $result;
	}
	return $result;
}
echo "<br />第1天桃子数为：" . taozi2(1);
echo "<br />第4天桃子数为：" . taozi2(4);
?>

<?php

/*求此数组的平均值：*/
$a3 = array(
	array(11,12, 13),
	array(21,22,23, 24, 25),
	array(31,32,33, 35),
	array(41,42,43)
);
$len = count($a3);
$sum = 0;
$count = 0;
for($i=0;$i<$len;$i++)
{
	$len1 = count($a3[$i]);
	for($j=0;$j<$len1;$j++)
	{
		$sum += $a3[$i][$j];
		$count++;
	}
}
echo "平均值为：".($sum/$count)."<br />";


/**********一个“不整齐”数字数组，如下所示，求其平均值；*************/
/********************* 提示：使用递归； **********************/

$a3 = array(
	1,
	array(21,22,23, 24, 25),
	3,
	array( 41, 42, 43，array(50,  51,  52) )
);

$c = 0; //统计个数
$num = 0; //求和

/*****************第一种******************/
function arr($arr){
	global $c;
	global $num;
	foreach($arr as $v){
		if(is_array($v)){
			arr($v);
		}else{
			$num += $v;
			$c++;
		}
	}
}
/*******************第二种******************/

$c = 0; //统计个数
$num = 0; //求和
function arr($arr){
	global $c;
	global $num;
	foreach($arr as $v){
		if(is_numeric($v)){
			$num += $v;
			$c++;
		}
		if(is_array($v)){
			arr($v);
		}
	}
}
arr($a3); //调用函数
echo "平均值为：" . $num/$c . "<br />";


/* 求一个整数数组中的最小的奇数，如果没有奇数，则直接输出“没有奇数”，否则输出该数。 */

$a = array(11, 13,  1,  8,  9, 33);
$jishu_arr = array();	//空数组，准备用于存放所有奇数
foreach($a as $key => $value){
	if($value % 2 == 1){
		$jishu_arr[] = $value;
	}
}
if(count($jishu_arr) == 0){
	echo "没有奇数！";
}
else{//否则，就是有奇数
	//然后才去找其中的最小值；
	$min = $jishu_arr[0];
	foreach($jishu_arr as $v){
		if($v < $min){
			$min = $v;
		}
	}
	echo "最小奇数为：$min";
}

/*请写一个函数，函数带一个参数（作为数组），函数的功能是找出该数组中的“第二大值”（即函数会返回一个值，此值是该数组的第二大的数值）。*/

function f2($arr){
	global $max;
	$max = $arr[0];	//最大值
	$s_max = $arr[1]; //第二大值
	$pos = 0;  //记录第二大值下标
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]>$max){
			$s_max = $max;
			$max = $arr[$i];
			$pos = $i;
		}
		else if($arr[$i]<$max && $arr[$i]>$s_max){
			$s_max = $arr[$i];
			$pos = $i;
		}
	}
	return $s_max;
}


if(f2($arr1)===$max){
	echo "没有第二大值";
}else{
	echo f2($arr1);
}

?>

<?php

/*冒泡排序*/
/*
规律描述：
１，假设数组的数据有ｎ个。
２，要进行比较的“趟数”为ｎ－１；
３，每一趟要比较的数据个数都比前一趟少一个，第一趟要比较ｎ个（即比较ｎ－１次）
４，每一次比较，如果发现“左边数据”大于“右边数据”，就对这两者进行交换位置。
*/
echo "<br/>排序之前："; print_r($a);
//一顿排序。。。。。
$n = count($a);	//个数
for($i = 0; $i < $n - 1; ++$i){	//这就是n-1趟
	for($k = 0; $k < $n-$i-1; ++$k){//该趟要比较的次数
		//这里，也可以把$k当做下标来使用：
		if($a[$k] > $a[$k+1] ){
			$t = $a[$k];
			$a[$k] = $a[$k+1];
			$a[$k+1] = $t;
		}
	}
}
echo "<br/>排序之后："; print_r($a);


$n = count($arr);
for($i=0;$i<$n-1;$i++){
	for($j=0;$j<$j-$i-1;$j++){
		if($arr[$k]>$arr[$k+1]){
			$tmp = $arr[$k];
			$arr[$k] = $arr[$k+1];
			$arr[$k+1] = $tmp;
		}
	}
}

/*选择排序*/
/*
规律描述：
１，假设数组的数据有ｎ个。
２，要进行查找最大值单元并进行交换的“趟数”为ｎ－１；
3，每一趟都要求出“剩余数据”中的最大值单元，并且，剩余数据的数量每一趟都少1个，第一趟有n个。
4，每一趟找出最大值单元后，都要进行交换：最大值单元，跟剩余数据中的最后一个单元交换。
*/
echo "<br/>排序之前："; print_r($a);
//一顿排序。。。。。
$n = count($a);
for($i = 0; $i < $n - 1; ++$i){//趟数
	//每一趟开始找其中的最大值单元：
	$max = $a[0];	//找最大值先要取得第一项的值
	$pos = 0;		//找最大值的下标，也要先取得第一项的下标
	for($k = 0; $k < $n-$i; ++$k){
		//这里，$k也可以理解为下标
		if($a[$k] > $max){
			$max = $a[$k];
			$pos = $k;
		}
	}
	//前面一定可以获得最大值及其所在下标：即最大值单元
	//然后开始i进行交换：
	$t = $a[$pos];	//最大值的单元
	$a[$pos] = $a[$n-$i-1];//$n-$i-1就是剩余数据中的最后一个单元的下标！
	$a[$n-$i-1] = $t;
}
echo "<br/>排序之后："; print_r($a);

?>


<?php

/*1，输出1-100之间的所有能被3整除但不能被7整数的数；*/
for($i=1;$i<=100;$i++)
{
	if($i%3==0 && $i%7!=0)
	{
		echo $i." ";
	}
}
echo "<br />";

/*2，写一个函数，该函数可以输出1-100之间的所有能被3整除但不能被7整数的数；*/
function f1($n)
{
	if($n%3==0 && $n%7!=0)
	{
		return $n;
	}
}
for($n=1;$n<=100;$n++)
{
	$v1 = f1($n);
	echo $v1." ";
}

/*3，写一个函数，该函数可以求出1-100之间的所有能被3整除但不能被7整数的数的和；*/
echo "<br />";
$sum = 0;
function f2($n)
{
	if($n%3==0 && $n%7!=0)
	{
		return $n;
	}
}
for($n=1;$n<=100;$n++)
{
	$v1 = f2($n);
	$sum += $v1;
}
echo $sum . "<br />";

/*4，写一个函数，该函数可以求出任意给定的2个数之间的所有能被3整除但不能被7整数的数的和*/
echo "<br />";

function f3($s1,$s2)
{
	function f4($n)
	{
		if($n%3==0 && $n%7!=0)
		{
			return $n;
		}
	}
	$sum = 0;
	for($n=$s1;$n<=$s2;$n++)
	{
		$v1 = f4($n);
		$sum += $v1;
	}
	return $sum;
}
$v2 = f3(1,100);
echo $v2 . "<br />";

/*5，写一个页面表单，该表单可以输入2个数，并提交后可以求出这2个数之间的所有能被3整除但不能被7整除的数的和（显示出来）。*/
if(!empty($_POST))
{
	$d1 = $_POST['d1'];
	$d2 = $_POST['d2'];
	function f5($s1,$s2)
	{
		function func($n)
		{
			if($n%3==0 && $n%7!=0)
			{
				return $n;
			}
		}
		$sum = 0;
		for($n=$s1;$n<=$s2;$n++)
		{
			$v1 = func($n);
			$sum += $v1;
		}
		return $sum;
	}

	echo f5($d1,$d2);
}
else
{
	$d1 = "";
	$d2 = "";
}
?>

<!--HTML表单部分-->
<form method="post" action="">
	<input type="text" name="d1">
	<input type="text" name="d2">
	<input type="submit" value="提交">
</form>