<html><head>
        <script type="text/javascript">
                function warn()
                {
                    var conf = confirm("Your action might create DEVATATING effect!!\nDo you want to proceed ?");
                if(!conf)
                    
                      document.getElementById("FactoryDD").value = "Dont Proceed"
                
                }
                </script>
        <style tyep="text/css">
            body{
                background: #ccc;
            }
            #wrapper{
                width: 760px;
                margin:auto;
                background: #dad5d5;
                padding:5px;
            
            }
            #greeting{
                width:100%;
                text-align: center;
                font-width:bold;
                font-size: 2em;
                padding-bottom: 10px;
            }
            #group{
                width:100%;
                            }
            #round{
                width:50%;
                float:left;
            }
			#round fieldset{
				min-height:197px;}
            #question fieldset{
            	
            	min-height:197px;
                
            }
            #viewq{
            float: left;
            width: 380px;
            }
            #viewq fieldset{
            min-height: 155px;
            }
            #chg_score{
            float: right;
            width: 380px;
           
            }
            #chg_score fieldset{
            min-height: 155px;
            }
			#chd_gs{
				width:150px;
				}
            .small{
                width:3em;
            }
        </style>
        
        <?php
      $con = mysql_connect('localhost','root','') or die("database connection failed.");
        $db = mysql_select_db('quize') or die('Database selction failed.');
      

    
         ?>
    </head>
    <body>
        <div id="wrapper" >
            
            <div id="greeting">
            Wel-Come Admin, Do carefull Editing....
           
            </div>
             <hr/>
         <div id="viewq">
               <fieldset >
            <legend> View QnA</legend>
        <form action="#" method="POST" >
            S.N.: <input type="text" name="sn" > <input type="submit" value="View" name="view" >
        <br/>
        <?php
        if($_POST['view']=="View")
        {
            $query = "SELECT * from qna where sn=$_POST[sn]";
            $res = mysql_query($query);
            $row = mysql_fetch_assoc($res);
            echo "Sn: ".$row['sn']."<br/>";
            echo "Ques : ".$row['question']."<br/>";
            echo "Ans  : ".$row['answer']."<br/>";
            echo "asked: ".$row['asked']."<br/>";
        }
                ?>
        </form>
      </fieldset>
      </div>
      
     <div id="chg_score" >
            <fieldset>
            <legend> Correct Score </legend>
            <form action="#" method="POST">
            <table><tr><td>Group(symbol)</td><td>: <input type="text" name="grpsymb" ></td></tr>
            <tr><td>Score</td><td>: <input type="text" name="score" ></td></tr>
            <tr><td></td><td align="center" >  <br/><input type="submit" id="chd_gs" name="chg_score" value="Change" ></td></tr> </table>
            </form>
            </fieldset>
       <?php
       if($_POST['chg_score'] == "Change" )
       {
       $GS = $_POST['grpsymb'];
       $sc = $_POST['score'];
       $query = "update groups set score=$sc where Gsymbol=\"$GS\"";
       $res = mysql_query($query);
       
       }
       ?>
        </div>
                 
        <div style="clear: both" > </div>
        <hr/>
            <div id="round">
                <fieldset >
            <legend> change Round data</legend>
        <form action="#" method="POST" >
       <table>
            <tr><td>Round name</td><td> : <input type="text" name="roundname" ></td></tr>
            <tr><td>Question Start  </td><td> : <input type="text" name="qfrom" > </td></tr>
           <tr><td> Question End </td><td> : <input type="text" name ="qto" > </td></tr>
           <tr><td> Question No. </td><td> : <input type="text" name="noq" value="0" > </td></tr>
           <tr><td>Start group </td><td> : <input type ="text" name="cur_g" value="A" ></td></tr>
           <td><input type="submit" name="newRsubmit" value="Insert" > </td></tr>
       </table>     
        </form>
            <?php
            if($_POST['newRsubmit']=="Insert")
            {
            $query = "delete from nooq";
            $res = mysql_query($query);
            
                $roundname = $_POST['roundname'];
                $qfrom = $_POST['qfrom'];
                $qto = $_POST['qto'];
                $noq = $_POST['noq'];
                $cur_g = $_POST['cur_g'];
               
                $query = "insert into nooq values(\"$roundname\",$qfrom,$qto,$noq,\"$cur_g\")";
                $res = mysql_query($query);
           
      
            }
            
            ?>
            
        </fieldset>
            </div>    
         
            <div id="question">
                <fieldset >
            <legend> Insert new Question</legend>
        <form action="#" method="POST" >
            <table>
                <tr><td> SN. </td><td>: <input type="text" name="sn" ></td></tr>
            <tr><td>Ques </td><td>: <input type="text" name="ques" > </td></tr>
            <tr><td>Ans </td><td>: <input type="text" name="ans" > </td></tr>
            <tr><td><input type="submit" name="newQsubmit" value="Insert" ></td></tr>
            </table>
        </form>
            <?php
            
            if($_POST['newQsubmit'] == "Insert" )
            {
            $sn = $_POST['sn'];
            $ques = $_POST['ques'];
            $ans = $_POST['ans'];
            
            $query = "delete from qna where sn=$sn";
            $res = mysql_query($query);
            $query = "insert into qna values($sn,\"$ques\",\"$ans\",0)";
            $res = mysql_query($query);
            }
            ?>
            
        </fieldset>
            </div>
        <div id="clear" style="clear:both"> </div>
             <hr/>
          <div id="group">
        <fieldset >
            <legend> change group data</legend>
        <form action="#" method="POST" >
            <?php
            echo "Gid : <input type=text name='Gid'  class=small  value=$i>";
            echo " Grp $i: <input type=text name='Gname' >";
            echo " Grp symb : <input type=text name='Gsymbol'  > ";
            echo " Score : <input type=text name='score' class=small value=0>";
            echo "<br/>";
           
             ?>
            <br/><input type="submit" name="newGsubmit" value="Insert" >
        </form>
            <?php
            if($_POST['newGsubmit']=="Insert"){
                        
                $gid = $_POST['Gid'];
                $gname = $_POST['Gname'];
                $gsymb = $_POST['Gsymbol'];
                $score = $_POST['score'];
            
            $query = "delete from groups where Gid=$gid";
            $res = mysql_query($query);
            
                $query = "insert into groups values($gid,\"$gname\",\"$gsymb\",$score)";
            
            $row = mysql_query($query);
                        
            }
            ?>
          </fieldset> 
        </div> <div id="clear" style="clear:both"> </div>
             <hr/>
            <div id="clearall">
                <fieldset >
            <legend> clear all</legend>
        <form action="#" method="POST" >
            <input type="submit" name="ClearQasked" value="Clear Question Data" >
            <input type ="submit" name="ClearGdata" value="Clear Group Data" >
            <input type="submit" name="ClearRdata" value="Clear Round Data"><br/><br/>
        <input type="submit"   name="FactoryDS" value="Clean All Except qna Database">
<input type="submit" name="FactoryDD" id="FactoryDD" value="Factory Default" onClick="warn()"><br/>
 <?php
 function clearqd(){
                $query = "update qna set asked=0";
                $res = mysql_query($query);  
        }          
 function cleargd(){
     $query = "update groups set score=0";
     $res = mysql_query($query);
        }
 function clearrd()
 {
     
                 $query = "update nooq set noq=1";
                 $res = mysql_query($query);
                 $query = "update nooq set cur_g='A'";
                 $res = mysql_query($query);
 }
 function cleanall()
 {
     clearqd();
               $query = "delete from groups";
               $res = mysql_query($query);
               $query = "delete from nooq";
               $res = mysql_query($query);
 }
            if($_POST['ClearQasked']=="Clear Question Data")
                clearqd();            
            if($_POST['ClearGdata']=="Clear Group Data")
                 cleargd();
            if($_POST['ClearRdata']=="Clear Round Data")
                 clearrd();   
           if($_POST['FactoryDS']=="Clean All Except qna Database")
                cleanall();
           if($_POST['FactoryDD'] =="Factory Default")
           {
               cleanall();
               $query = "delete from qna";
               $res = mysql_query($query);
           }
            
            ?>
        </form>
        </fieldset>
            </div>
            
        </div>
    </body>  
</html>
