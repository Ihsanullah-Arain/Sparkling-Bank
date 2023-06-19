<html>
<head>
  <link rel="stylesheet" href="../Bank/CSS/Transaction.css">
<title>Transaction Details</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>    

<body style="background-color: #4158D0;    background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);">
<table>
  <div>
	  <a href="index.php">
      <button class="button1">HOME</button>
	  </a>
  </div>
  <caption>Customer Details</caption>
  <thead>
    <tr style="background-color: #f8f8f84f;    border: 1px solid #8f398a;">
      <th scope="col">Customer Id</th>
      <th scope="col">Contributor</th>
      <th scope="col">Recipient</th>
      <th scope="col">Transferred Amount</th>        
    </tr>
  </thead>
  <tbody>
    <?php
    include 'config.php';
    $sql ="select * from records";
    $query =mysqli_query($conn, $sql);
    while($rows=mysqli_fetch_array($query)){
    ?>
    <tr>
    <td scope="row" data-label="Customer Id"><?php echo $rows['id'] ?></td>
    <td scope="row" data-label="Contributor"><?php echo $rows['contributor_name']; ?></td>
    <td scope="row" data-label="Recipient"><?php echo $rows['recipient_name']; ?></td>
    <td scope="row" data-label="Transferred Amount"><?php echo $rows['transferred_amount']; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
</body>
</html>