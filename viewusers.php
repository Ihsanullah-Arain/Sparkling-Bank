<html>
<head>
  <link rel="stylesheet" href="../Bank/CSS/User.css">
<title>User Details</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  </head>  

<body>
<?php
    require 'config.php';
    $query = "SELECT * FROM user_info";
    $result = mysqli_query($conn,$query);
?>
<table>
<div >
	<a href="index.php">
  <button class="button1">HOME</button>
	</a>
</div>
  <caption>Customer Details</caption>
  <thead>
    <tr>
      <th scope="col">Customer Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email Id</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Account Balance</th>
      <th scope="col">Operation</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($rows=mysqli_fetch_array($result)){
    ?>
    <tr>
    <td scope="row" data-label="Customer Id"><?php echo $rows['id'] ?></td>
    <td scope="row" data-label="First Name"><?php echo $rows['firstname']?></td>
    <td scope="row" data-label="Last Name"><?php echo $rows['lastname']?></td>
    <td scope="row" data-label="Email Id"><?php echo $rows['email_id']?></td>
    <td scope="row" data-label="Phone Number"><?php echo $rows['phone_number']?></td>
    <td scope="row" data-label="Account Balance"><?php echo $rows['account_Balance']?></td>
    <td><a href="selecteduser.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="button">Transfer</button></a></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
</body>
</html>