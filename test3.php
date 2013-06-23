<?
$teacher = array("老张","28","讲师");
$student = array(
array("小李","19","计算机"),
array("小高","19","计算机"),
array("小浩","18","计算机"),
array("小呆","20","计算机"),
array("小王","19","计算机")
);
//使用list读取数组
list($tname,$tage,$tjob) = $teacher;
echo "姓名:".$teacher."年龄：".$tage."职业：".$tjob;

//使用each返回数组的键/值对
$kv = each($student);
echo "<pre>";
print_r($kv);
echo "</pre>";

//使用list(),each()配合while读取二维数组并转化为表格
$table = "<table border='1'><tr><th>姓名</th><th>年龄</th><th>专业</th></tr>";
//表格头部数据
while(list($key,$value) =each( $student))
{
  $table .="<tr><th>".$value[0]."</th><th>".$value[1]."</th><th>".$value[2]."</th></tr>";
}
echo $table;

for($i=0;i<count($student);i++)
{
  $table.= $student[0][0].$student0[][1];
}


foreach($student as $key=>$valu)
{
  $valu[0].$valu[1];
}
?>
/*总结：
1.list()函数是将一个一维数组的读取每个元素出来。
2.each()函数返回数组的键值对。
3.for(){}
4.foreach(){}
*/







