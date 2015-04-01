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
    // use FetchApp\API\OrderStatus;


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
<h2>Success!</h2>
<table>
    <tr>
        <th>
            Product Name
        </th>
        <th>
            Product SKU
        </th>
        <th>
            Old Price
        </th>  
        <th>
            New Price
        </th>              
    </tr>
    <tr>
    <?php
        function processFetchApp(){
            // Create a new FetchApp instance
            $fetch = new FetchApp();

            // Set the Authentication data (needed for all requests)
            $fetch->setAuthenticationKey($_POST['fetchapp_key']);
            $fetch->setAuthenticationToken($_POST['fetchapp_token']);

            global $products;

            try{
                // Let's grab our Products!
                // $products = $fetch->getProducts(); // Grabs all products (potentially HUGE!)
                                // or
                $products = $fetch->getProducts(10000, 1); // Grabs products, 50 per page, page 4.
            }
            catch (Exception $e){
                // This will occur on any call if the AuthenticationKey and AuthenticationToken are not set.
                echo $e->getMessage();
            }

           foreach ($products as $product) {

                $old_price = $product -> getPrice();

                if($product->getPrice() == $_POST['old_price']){
                    try{
                        // $set_product = new FetchApp->getProduct($product->getSKU());
                        $product->setPrice($_POST['new_price']);

                        

                        $files = $product->getFiles();

                        // var_dump($product);

                        $response = $product->update($files, false);

                        // var_dump($response);
                    }
                    catch (Exception $e){
                        // This will occur on any call if the AuthenticationKey and AuthenticationToken are not set.
                        echo $e->getMessage();
                    }
                }

                $new_price = $product -> getPrice();


                echo "<tr>";
                    echo "<td>".$product->getName().PHP_EOL."</td>";  
                    echo "<td>".$product->getSKU().PHP_EOL."</td>";
                    echo "<td>".$old_price."</td>";
                    echo "<td><b>".$new_price."</b></td>";
                echo "</tr>"; 
            }       
        }
        // Now let's print our results!

        if(isset($_POST['process'])){
            processFetchApp();

        }

    ?>
</table>
</body>


</html>
