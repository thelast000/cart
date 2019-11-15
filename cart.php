<?php

include 'conn.php';
if (isset($_REQUEST["remove"]) && isset($_REQUEST["id"])) {
    $sql = "DELETE FROM cart WHERE id=$_REQUEST[id]";
    mysqli_query($conn, $sql);
}

$sql = "SELECT product.name, product.detail, product.price, cart.qty, (product.price * cart.qty) as total, cart.id FROM product, cart WHERE product.id = cart.pid";
$result = mysqli_query($conn, $sql);



?>
<a href=".">Home</a>
<hr>
<table border="1">
    <tr>
        <td>Name</td>
        <td>Detail</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>Total</td>
        <td>Remove</td>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_row($result)) {
            #print_r($row);
            echo "<form method=POST action=cart.php>";
            echo "<tr>";
            echo "<td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
            echo "<td>$row[3]</td>";
            echo "<td>$row[4]</td>";
            echo "<td><input type=submit name=remove value='Remove'></td>";
            echo "</tr>";
            echo "<input type=hidden name=id value=$row[5]>";
            echo "</form>";
        }
    }
    ?>
</table>
<?php
    $sql = "SELECT SUM(product.price * cart.qty) as 'Sub Total' FROM product, cart WHERE product.id = cart.pid";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_row($result);
        echo "<h1>Sub Total:$row[0]</h1>";
    }
?>