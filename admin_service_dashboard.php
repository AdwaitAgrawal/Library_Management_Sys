<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="mystyles.css">
    </head>
    <!-- <style>
        .innerright,label {
    color: #C8DBBE;
    font-weight:bold;
}
.container,
.row,
.imglogo {
    margin:auto;
}
.tableChange{
    display:flex;
    justify-content:center;
    item-align:center;
    margin-top:10px;
}


.transparent{
    text-align: center;
    background-color: rgba(10, 10, 10, 0.77);
}
body{
    display: block;
    background-image: url("images/background.jpg");
    background-size: 100%;
}

.innerdiv {
    text-align: center;
    /* width: 500px; */
    margin: 100px;
}
input{
    margin-left:20px;
}
.leftinnerdiv {
    float: left;
    width: 25%;
    height: 450px;
    padding: 10px;
}

.rightinnerdiv {
    float: right;
    width: 75%;
}

.innerright {
    background-color: rgba(10,10,10,0.77);
    height: 450px;
    padding: 15px;
}

.greenbtn {
    background-color: #A47E3B;
    color: white;
    width: 95%;
    height: 40px;
    margin-top: 8px;
    font-weight:bold;
}

.greenbtn,
a {
    text-decoration: none;
    color: black;
    font-size: large;
}

th{
    color: #C8DBBE;
}
td{
    text-align:left;
    color: #C8DBBE;
}
td, a{
    text-align:left;
    color:#C8DBBE;
}
    </style> -->
    <body>

    <?php
   include("data_class.php");

$msg="";

   if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
 }

if($msg=="done"){
    echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
}
elseif($msg=="fail"){
    echo "<div class='alert alert-danger' role='alert'>Fail</div>";
}

    ?>



        <div class="container">
        <div class="innerdiv">
            <div class="row level"></div>
            <div class="leftinnerdiv transparent">
                <Button class="greenbtn"> ADMIN</Button>
                <Button class="greenbtn" onclick="openpart('addbook')" >ADD BOOK</Button>
                <Button class="greenbtn" onclick="openpart('bookreport')" > BOOK REPORT</Button>
                <Button class="greenbtn" onclick="openpart('bookrequestapprove')"> BOOK REQUESTS</Button>
                <Button class="greenbtn" onclick="openpart('addperson')"> ADD STUDENT</Button>
                <Button class="greenbtn" onclick="openpart('studentrecord')"> STUDENT REPORT</Button>
                <Button class="greenbtn"  onclick="openpart('issuebook')"> ISSUE BOOK</Button>
                <Button class="greenbtn" onclick="openpart('issuebookreport')"> ISSUE REPORT</Button>
                <a href="index.php"><Button class="greenbtn" > LOGOUT</Button></a>
            </div>

            <div class="rightinnerdiv">   
            <div id="bookrequestapprove" class="innerright portion transparent" style="display:none">
            <Button class="greenbtn" >BOOK REQUEST APPROVE</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->requestbookdata();
            $recordset=$u->requestbookdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  
            padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
              "<td>$row[1]</td>";
              "<td>$row[2]</td>";

                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";
               // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                 $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="addbook" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
            <Button class="greenbtn" >ADD NEW BOOK</Button>
            <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
            <div class="tableChange">
                <table>
                    <tr>
                        <td><label>Book Name : </label></td>
                        <td><input type="text" name="bookname"/></td>
                    </tr>
                    <tr>
                        <td><label>Detail : </label></td>
                        <td><input  type="text" name="bookdetail"/></td>
                    </tr>
                    <tr>
                        <td><label>Author : </label></td>
                        <td><input type="text" name="bookaudor"/></td>
                    </tr>
                    <tr>
                        <td><label>Publication :</label></td>
                        <td><input type="text" name="bookpub"/></td>
                    </tr>
                    <tr>
                        <td>Branch:</td>
                        <td><input type="radio" name="branch" value="other"/>IT
                        <input type="radio" name="branch" value="BSIT"/>CSE
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <!-- style="margin-left:80px"> -->
                    <td><input type="radio" name="branch" value="BSCS"/>EXTC
                    <input type="radio" name="branch" value="BSSE"/>OTHER</td>
                </tr>
                <tr>
                    <td><label>Price:</label></td>
                    <td><input  type="number" name="bookprice"/></td>
                </tr>
                <tr>
                    <td><label>Quantity:</label></td>
                    <td><input type="number" name="bookquantity"/></td>
                </tr>
                <tr>
                    <td><label>Book Photo:</label></td>
                    <td><input  type="file" name="bookphoto"/></td>
                </tr>
            </table>
            
        </div>
        <br><input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>


            <div class="rightinnerdiv">   
            <div id="addperson" class="innerright portion" style="display:none">
            <Button class="greenbtn" >ADD Person</Button>
            <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
            <label>Name:</label><input type="text" name="addname"/>
            </br>
            <label>Pasword:</label><input type="pasword" name="addpass"/>
            </br>
            <label>Email:</label><input  type="email" name="addemail"/></br>
            <label for="typw">Choose type:</label>
            <select name="type" >
                <option value="student">student</option>
                <option value="teacher">teacher</option>
            </select>

            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="studentrecord" class="innerright portion" style="display:none">
            <Button class="greenbtn" >Student RECORD</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  
            padding: 8px;'> Name</th><th>Email</th><th>Type</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                // $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="issuebookreport" class="innerright portion" style="display:none">
            <Button class="greenbtn" >Issue Book Record</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->issuereport();
            $recordset=$u->issuereport();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  
            padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[4]</td>";
                // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

<!--             

issue book -->
            <div class="rightinnerdiv">   
            <div id="issuebook" class="innerright portion" style="display:none">
            <Button class="greenbtn" >ISSUE BOOK</Button>
            <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
            <label for="book">Choose Book:</label>
            <select name="book" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->getbookissue();
            $recordset=$u->getbookissue();
            foreach($recordset as $row){

                echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
        
            }            
            ?>
            </select>

            <label for="Select Student">:</label>
            <select name="userselect" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();
            foreach($recordset as $row){
               $id= $row[0];
                echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
            }            
            ?>
            </select>
<br>
            Days<input type="number" name="days"/>

            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="bookdetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
            
            <Button class="greenbtn" >BOOK DETAIL</Button>
</br>
<?php
            $u=new data;
            $u->setconnection();
            $u->getbookdetail($viewid);
            $recordset=$u->getbookdetail($viewid);
            foreach($recordset as $row){

                $bookid= $row[0];
               $bookimg= $row[1];
               $bookname= $row[2];
               $bookdetail= $row[3];
               $bookauthour= $row[4];
               $bookpub= $row[5];
               $branch= $row[6];
               $bookprice= $row[7];
               $bookquantity= $row[8];
               $bookava= $row[9];
               $bookrent= $row[10];

            }            
?>

            <img width='150px' height='150px' style=':1px solid #3333border33; float:left;margin-left:20px' src="uploads/<?php echo $bookimg?> "/>
            </br>
            <p style="color:black"><u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
            <p style="color:black"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
            <p style="color:black"><u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthour ?></p>
            <p style="color:black"><u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
            <p style="color:black"><u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
            <p style="color:black"><u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
            <p style="color:black"><u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
            <p style="color:black"><u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>


            </div>
            </div>



            <div class="rightinnerdiv">   
            <div id="bookreport" class="innerright portion" style="display:none">
            <Button class="greenbtn" >BOOK RECORD</Button>
            <?php
            $u=new data;
            $u->setconnection();
            $u->getbook();
            $recordset=$u->getbook();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th class ='otheruser'style='
            padding: 8px;'>Book Name</th><th class ='otheruser'>Price</th><th class ='otheruser'>Qnt</th><th class ='otheruser'>Available</th><th class ='otheruser'>Rent</th></th><th class ='otheruser'>View</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[9]</td>";
                $table.="<td>$row[10]</td>";
                $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-secondary'>View BOOK</button></a></td>";
                // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>



        </div>
        </div>
        

     
        <script>
        function openpart(portion) {
        var i;
        var x = document.getElementsByClassName("portion");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        document.getElementById(portion).style.display = "block";  
        }
        </script>
    </body>
</html>