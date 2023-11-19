<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpdataBooking</title>
</head>
<body>

<form method="post" action="updata?id=<?php echo $Booking['id'] ?>">
         <input type="text" name="customer_id" value="<?php echo $customer_id ?>" required>
         <input type="text" name="ticket_id" value="<?php echo $ticket_id ?>" placeholder="customer_id" required>
         <input type="text" name="hotel_id" placeholder="hotel_id" value="<?php echo $hotel_id ?>" required>
         <input type="text" name="date" placeholder="date" value="<?php echo $date ?>" required>
        <button type="submit" name="edit">Updata Booking</button>
    </form>
</body>
</html>