<?php
include 'config.php';
if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $toUser = $_POST['to'];
    $amnt = $_POST['amount'];

    $sql = "SELECT * from user_info where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from user_info where id=$toUser";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

if($amnt > $sql1['account_Balance'])
{
    echo '<script type="text/javascript">';
    echo ' alert("Insufficient Balance")';  
    echo '</script>';
}
else if($amnt == 0)
{
    echo "<script type='text/javascript'>alert('Enter Amount Greater than Zero');</script>";
}
else 
{     
    $newCredit = $sql1['account_Balance'] - $amnt;
    $sql = "UPDATE user_info set account_balance=$newCredit where id=$from";
    mysqli_query($conn,$sql);
    $newCredit = $sql2['account_Balance'] + $amnt;
    $sql = "UPDATE user_info set account_balance=$newCredit where id=$toUser";
    mysqli_query($conn,$sql);
    $sender = $sql1['firstname'];
    $receiver = $sql2['firstname'];
    $sql = "INSERT INTO records(`contributor_name`, `recipient_name`, `transferred_amount`) VALUES ('$sender','$receiver','$amnt')";
    $tns=mysqli_query($conn,$sql);
    if($tns)
    {
       echo "<script type='text/javascript'>
            alert('Transaction Successfull!');
            window.location='transaction.php';
            </script>";
    }
    $newCredit= 0;
    $amnt =0;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Bank/CSS/selecteduser.css">
    <title>Money Transfer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body style="background-color: #4158D0;    background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);">
<table>
    <div class="container divStyle">
        <h2>Transfer Credits</h2>
        <?php
            include 'config.php';
            $sid=$_GET['id'];
            $sql = "SELECT * FROM  user_info where id=$sid";
            $query=mysqli_query($conn,$sql);
            if(!$query)
            {
                echo "Error ".$sql."<br/>".mysqli_error($conn);
            }
            $rows=mysqli_fetch_array($query);
        ?>
        <form method="post" name="tcredit" class="tabletext" ><br/>    
        <div class="view">
            <table class="flat-table-1"  style="background: #336ca646;">
                <tr>  
                    <th>Name</th>
                    <td><?php echo $rows['firstname'] ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $rows['email_id'] ?></td>
                </tr>
                <tr>    
                    <th>Credits</th>
                    <td><?php echo $rows['account_Balance'] ?></td>
                </tr>
            </table>
        </div>
        <br/><br/><br/>
        <center><label>TO:</label>
        <select class=" form-control"   name="to" style="margin-bottom:20px; width: 300px;" >
            <option value="" disabled selected>Choose </option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM user_info where id!=$sid";
                $query=mysqli_query($conn,$sql);
                if(!$query)
                {
                    echo "Error ".$sql."<br/>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_array($query)) {
            ?>
            <option class="table text-center table-striped " value="<?php echo $rows['id'];?>" >
                <?php echo $rows['firstname'] ;?>
                <?php echo $rows['lastname'] ;?>
               (Balance: <?php echo $rows['account_Balance'] ;?>)
                <!--(Credits:
                <?php echo $rows['credits'] ;?> )-->
            </option>
            <?php
                }
            ?>
        </select>
        <label>AMOUNT:</label>
        <input type="number" id="amm" class="form-control" style="width: 300px;" name="amount" min="0" required  />  <br/><br/>
        <div class="text-center btn3" >
            <button class="button" name="submit" type="submit" id="myBtn" style="margin:8px;">Proceed</button>
        </div></center>        
        </form>
    </div>
<center><div >
	<a href="viewusers.php">
    <button class="button">Back</button>
	</a>
</div><br>
</body>
</html>