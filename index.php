<?php
    include 'conn.php';
    if (isset($_REQUEST["add"]) && isset($_REQUEST["pid"])) {
        
        // $sql = "INSERT INTO cart(pid, qty) values($_REQUEST[pid], $_REQUEST[qty])";
        // $sql = "SELECT qty FROM cart WHERE pid=$_REQUEST[pid]";
        // $result = mysqli_query($conn, $sql);

        // if(mysqli_num_rows($result) > 0){
        //     // $row = mysqli_fetch_row($result);
        //     $sql = "UPDATE cart SET qty=qty+$_REQUEST[qty] WHERE pid=$_REQUEST[pid]";
        //     $result = mysqli_query($conn, $sql);
        // } else {
            $sql = "SELECT totalqty FROM product WHERE id=$_REQUEST[pid]";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            if( $_REQUEST['qty'] > $row[0]){

                echo "Not available";
                die();
            } else {
            $sql = "INSERT INTO cart(pid, qty) values($_REQUEST[pid], $_REQUEST[qty])";
            $result = mysqli_query($conn, $sql);

            $sql = "UPDATE product set totalqty=totalqty-$_REQUEST[qty] WHERE id=$_REQUEST[pid]";
            $result = mysqli_query($conn, $sql);
            echo "<script>
            alert('Item Added');
            window.location.href='.';
            </script>";
             }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h2><a href="cart.php">Cart: <?php $sql = "SELECT COUNT(id) FROM cart"; $result = mysqli_query($conn, $sql); $row = mysqli_fetch_row($result); echo $row[0]; ?></a></h2>
    <hr>
    <table border="1">
        <tr>
            <td>Name</td>
            <td>Detail</td>
            <td>Price</td>
            <td>Total Quantity</td>

            <td>Quantity</td>
            <td>Add To Cart</td>
        </tr>
        
            <?php
            $sql = "SELECT * FROM product";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_row($result)){
        
                    echo "<form method=POST action=.>";
                    echo "<tr>";
                    echo "<td>$row[1]</td>";
                    echo "<td>$row[2]</td>";
                    echo "<td>$row[4]</td>";
                    echo "<td>$row[5]</td>";

                    echo "<td>
                                <select name=qty id=>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                </select>
                            </td>";
                            echo "<td><input type=submit name=add value='Add To Cart'></td>";
                            echo "</tr>";
                            echo "<input type=hidden name=pid value=$row[0]>";
                    echo "</form>";
                }
            }
            ?>
    </table>
    <label id="msg"></label>
    
</body>
</html>