<html>
    <head>
        
        <style type="text/css">
             #question fieldset{
            	
            	min-height:197px;
                
            }
            </style>
    </head>
    <body>
        
        <?php
      $con = mysql_connect('localhost','root','') or die("database connection failed.");
        $db = mysql_select_db('quize2') or die('Database selction failed.');
       
         ?>
        
        
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
</body>
</html>
