<!DOCTYPE html>
<html>
<head>

    <?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include('FetchApp/API/AccountDetail.php');

    include('FetchApp/API/EnumEmulator.php');
    include('FetchApp/API/Currency.php');
    include('FetchApp/API/FetchApp.php');
    include('FetchApp/API/FileDetail.php');
    include('FetchApp/API/Order.php');
    include('FetchApp/API/OrderDownload.php');
    include('FetchApp/API/OrderItem.php');
    include('FetchApp/API/OrderStatistic.php');
    include('FetchApp/API/OrderStatus.php');
    include('FetchApp/API/Product.php');
    include('FetchApp/API/ProductStatistic.php'); 

    include('FetchApp/API/APIWrapper.php');
    // include('FetchApp/API/FileType.php'); 

    use FetchApp\API\FetchApp;
    use FetchApp\API\OrderStatus;

    // Create a new FetchApp instance
    $fetch = new FetchApp();

    // Set the Authentication data (needed for all requests)
    $fetch->setAuthenticationKey($_POST['fetchapp_key']);
    $fetch->setAuthenticationToken($_POST['fetchapp_token']);

    try{
        // Let's grab our Orders!
        // $orders = $fetch->getOrders(); // Grabs all orders (potentially HUGE!)
                        // or
        $orders = $fetch->getOrders(OrderStatus::All, 20, 4); // Grabs orders of all types, 50 per page, page 4.
                        // or
        // $orders = $fetch->getOrders(OrderStatus::Expired); // Grabs all expired orders.
                        // or
        // $orders = $fetch->getOrders(OrderStatus::Open); // Grabs all open orders
    }
    catch (Exception $e){
        // This will occur on any call if the AuthenticationKey and AuthenticationToken are not set.
        echo $e->getMessage();
    }
    ?> 
    <style>
        table{
            text-align: left;
            border-collapse: collapse; 
        }
        th{
            border-bottom: 2px solid #ccc;
        }
        tr{

        }
        table td{
            border-bottom: 1px solid #ccc;
            display:table-cell;
        }
        table td, table th{
            padding: 10px;            
        }
    </style>   
</head>
<body>

<table>
    <tr>
        <th>
            Order ID
        </th>
        <th>
            Vendor ID
        </th>
        <th>
            First Name
        </th>
        <th>
            Last Name
        </th>
        <th>
            Email Address
        </th>
        <th>
            Total
        </th>
        <th>
            Currency
        </th>
        <th>
            Status
        </th>
        <th>
            Product Count
        </th> 
        <th>
            Download Count
        </th>
        <th>
            Expiration Date
        </th>
        <th>
            Download Limit
        </th>
        <th>
            Creation Date
        </th>                                                                                       
    </tr>
    <?php
        // Now let's print our results!
        foreach ($orders as $key=>$order) {
            echo "<tr>";
                echo "<td>".$order->getOrderID().PHP_EOL."</td>";
                echo "<td>".$order->getVendorID().PHP_EOL."</td>";
                echo "<td>".$order->getFirstName().PHP_EOL."</td>";
                echo "<td>".$order->getLastName().PHP_EOL."</td>"; 
                echo "<td>".$order->getEmailAddress().PHP_EOL."</td>";
                echo "<td>".$order->getTotal().PHP_EOL."</td>";
                echo "<td>".$order->getCurrency().PHP_EOL."</td>";
                echo "<td>".$order->getStatus().PHP_EOL."</td>";
                echo "<td>".$order->getProductCount().PHP_EOL."</td>";
                echo "<td>".$order->getDownloadCount().PHP_EOL."</td>";
                $expirationDate = $order->getExpirationDate();
                // Since ExpirationDate is a DateTime, we need to print it with a format.
                echo "<td>".$expirationDate->format('F j, Y').PHP_EOL."</td>";
                echo "<td>".$order->getDownloadLimit().PHP_EOL."</td>";
                // echo "<td>".$order->getCustom1().PHP_EOL."</td>";
                // echo "<td>".$order->getCustom2().PHP_EOL."</td>";
                // echo "<td>".$order->getCustom3().PHP_EOL."</td>";
                $creationDate = $order->getCreationDate();
                // Since CreationDate is a DateTime, we need to print it with a format.
                echo "<td>".$creationDate->format('F j, Y').PHP_EOL."</td>";
            echo "</tr>";
        }
    ?>
</table>
</body>
</html>
