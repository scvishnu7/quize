<html>
    <head>
     <style type="text/css">
           #viewq{
            float: left;
           width: 100%;
            }
            #viewq fieldset{
            min-height: 155px;
            }
         </style>
    </head>
    <body>
       <?php
      $con = mysql_connect('localhost','root','') or die("database connection failed.");
        $db = mysql_select_db('quize') or die('Database selction failed.');
        ?>
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
    </body>
</html>
