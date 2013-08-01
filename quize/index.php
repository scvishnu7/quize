<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>1st CSIT Quize</title>
<style type="text/css">
@import url(style.css);
</style>
<script tpe="text/javascript">
       </script>
<?php
$qfrom = 0;
$qto = 10;
$roundname= "First (CSIT )";
$noq_on_r = 0;
$cur_q;
$cur_qes;
$cur_ans;
$ran = array();
$noq ;
$group = array();

$con = mysql_connect("localhost","root","") or die("Can't connect Database");
$db = mysql_select_db("quize") or die("Can't select database");



//Group Data fetch;
$raw_grp = array("A","B","C","D","E","F","G","H"); //temp array to use later

$query = "SELECT * FROM groups";
$res = mysql_query($query);
$no_groups = mysql_num_rows($res);
$cur_groups = array();
for($i=0;$i<$no_groups;$i++)
	$cur_groups[$i] = $raw_grp[$i]; //does it needs


 for($i=0;$i<$no_groups;$i++){
    if($_POST[$i]=='+1'){
       $query = "SELECT score from groups where Gid=$i";
       $res = mysql_query($query);
       $row = mysql_fetch_assoc($res);
       $no = $row['score'];
       $no ++;
       $query = "UPDATE groups set score=$no where Gid=$i";
        $res = mysql_query($query);
       	}
if($_POST[$i]=='+2'){
       $query = "SELECT score from groups where Gid=$i";
       $res = mysql_query($query);
       $row = mysql_fetch_assoc($res);
       $no = $row['score'];
       $no += 2 ;
       $query = "UPDATE groups set score=$no where Gid=$i";
        $res = mysql_query($query);
       	}
	}  





$query = "SELECT * FROM groups";
$res = mysql_query($query);
$i = 0;
$max_score = -1;
while($row = mysql_fetch_assoc($res) )
	{
	$group[$i]['id'] = $row['Gsymbol'];
	$group[$i]['name']=$row['Gname'];
	$group[$i]['score'] = $row['score'];
	if( ($max_score < $row['score']) && ($row['score']>0) )
          $max_score = $row['score'];
        
        $i++;
        
	}
 


$query = "SELECT * from nooq";
$res = mysql_query($query);
$row =mysql_fetch_assoc($res);
$noq_on_r = $row['noq'];    //current number of question in round
$qfrom = $row['qfrom'];
$qto = $row['qto'];
$roundname = $row['roundname'];
$start_g = $row['cur_g'];   //current group

if($_POST['answer'] == "Next Question")
{
$noq_on_r++;
$query = "UPDATE nooq set noq=$noq_on_r where noq=$noq_on_r-1";
$res = mysql_query($query);

if($start_g == $cur_groups[$no_groups-1] )
	$nextg ="A";
else
	{
	for($j=0;$j<$no_groups-1;$j++)
		if($start_g == $cur_groups[$j])
			break;
	$nextg = $cur_groups[$j+1];
	}

$query = "UPDATE nooq set cur_g=\"$nextg\" where cur_g = \"$start_g\"";
$start_g = $nextg;
$res = mysql_query($query);

}


function show_num($qfrom,$qto)
       {
        $rem_q = array();
       	$query = "SELECT * FROM qna where asked = 0 AND sn >= $qfrom and sn <= $qto ";
	$res = mysql_query($query);
	$noq = mysql_num_rows($res);
        $i=0;
      while($row = mysql_fetch_assoc($res))
                    $rem_q[$i++]=$row['sn'];
        
          for($i=0;$i<$noq;$i++)
{?>
    <input type="submit" class="qsel" name="but" value="<?php echo $rem_q[$i]; ?>" />
   
        <?php 
        
}
                       
}
?>
<script  type="text/javascript" src="newjavascript.js">
   
</script>
</head>
    <body>
<div id="wrapper">
<div id="banner">
  
First CSIT Inter College Quiz Mania - 2069 

</div> <!-- End of div banner -->
<div id="content">
<div id="cont1"> 

<div id="info">
<p>
<table><tr><td>Round </td><td> : <?php echo $roundname; ?></td</tr>
<tr><td>Q.No. </td><td> : <?php echo $noq_on_r; ?> </td</tr>
<tr><td>Asked To </td><td> : <?php echo $start_g; ?> </td</tr>
<tr><td>Passed </td><td> : <span id="Times" > 0 Times </span></td</tr>
<tr><td>Turn </td><td> : <span id="answaiting" ><?php echo $start_g; ?></span> </td</tr>
</table>
</p>
</div><!-- end of div info -->

<div id="clock">
    <input type="button" id="cntdwn" value="00" /> <br/>
    <br/>
<input type="button" name="start" onclick="Start()" value="Start" />
<input type="button" id="pr" name="resume" onclick="resume()" value="Pause" style="width:5em"/> 
<input type="button" name="clear" onclick="restore()" value="restore" />

</div> <!-- End of div clock -->

<div class="clear" > </div>

<div id="question" >
    <div id="Q" >Question </div>
    
    <div class="clear"> </div>
<p>
<?php
if($_POST['but']!=NULL){
$qno = $_POST['but'];
$query = "SELECT * FROM qna WHERE sn=$qno";
$res = mysql_query($query);
$row = mysql_fetch_assoc($res);
$cur_qes = $row['question'];
$cur_ans = $row['answer'];
$cur_q = $row['sn'];
$query = "UPDATE qna set asked = 1 where sn=$qno";
$res = mysql_query($query);
}
?> 
    <b><i><?php echo $cur_q; ?>) </b></i><span class="large"> <?php echo $cur_qes; ?> <br/><br/>
   </span>
      
    </div> <!-- end div question -->
 <div id="ans_pass">
      <form action="#" method="POST" >
      <a href="#answer" >Check Answer </a> <br/> 
<input class="fill_half" id="pas1" type="button" name="Pass" onclick="passed(<?php echo $no_groups; ?>)" value="Pass" />
<input class="fill_half" id="neq1" type="submit" name="answer" value="Next Question"  />
  </form> 
 </div>
</div>  <!-- End of div cont1 -->
<div id="score">
<b><u>Current Score</b></u><br/>

<table border="1">
<tr>
	<td>Grp</td>
	<td style="width:10em" >Collage </td>
	<td>Score </td>
        <td >Add</td>
</tr>
    
<?php 
echo "<form action=# method=POST>";

for($i=0;$i<$no_groups;$i++)
{
      ?>

    <tr style="<?php if($group[$i]['score']==$max_score) echo "  background:#cc98d5 ";?>"> 
        <?php
	foreach($group[$i] as $data) echo "<td>".$data."</td>";
        echo "<td><input type=submit name=$i value='+2' style=\"width:30px\" /> </td>";
        echo "<td><input type=submit name=$i value='+1' style=\"width:30px\" /> </td>";
        echo "</tr>";
}
echo "</form>";

?>
</table>
</div> <!-- end of div score -->

<div id="nos">
<form action="" method="post">
    <i><b> Question Numbers</b></i> <br/>
<?php
show_num($qfrom,$qto);
?>
</form>
</div>  <!-- End of div nos -->

</div> <!-- End of div content -->

<div clas="clear"></div>
<div id="footer">
   <p id="footnote"> Organized by : BSc. CSIT, ASCOL 2068-Batch.</p>
</div>

</div> <!-- End of div wrapper -->



<div id="answer">
   
    <b>Q.NO.: <i><?php echo $cur_q; ?> >>  </b></i> 
        <?php echo $cur_qes; ?><br/><br/>
    <b>Answer: </b> 
    <?php echo "  $cur_ans"; ?>

<br/><br/><a href="#wrapper"> Go back</a>    

</div>

</body>
</html>
