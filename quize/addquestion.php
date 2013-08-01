<html><head>
         <?php
        $con = mysql_connect('localhost','root','') or die("database connection failed.");
        $db = mysql_select_db('quize') or die('Database selction failed.');
         ?>
    </head>
    <body>
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
            $query = "insert into qna values($sn,\"$ques\",\"$ans\",0)";
            $res = mysql_query($query);
            }
            ?>
            
        </fieldset>
            </div>
    </body>
</html>