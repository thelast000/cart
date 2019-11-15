<?php
    include "conn.php";

    $sql = "SELECT SUM(product.price * cart.qty) as 'Sub Total' FROM product, cart WHERE product.id = cart.pid";
    $result = mysqli_query($conn, $sql);
?>