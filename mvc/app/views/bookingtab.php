<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Booking List</h1>
    
    <ul>
        <?php foreach ($Bookings as $Booking){ ?>
            <li><?= $Booking['date']. "-------". $Booking['customer_id'] . "   ". "-----" . $Booking['hotel_id'] ."--".  $Booking['ticket_id']  ?> <a href="updata?id=<?php echo $Booking['id'] ?>">updata</a> </li>
        <?php }   ?>
    </ul>

   
</body>
</html>