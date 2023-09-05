<?php
session_start();

require_once("./php/CreateDb.php");
require_once("./php/component.php");

$db = new CreateDb("Productdb", "ProductosF");

if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('El producto fue eliminado')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!--Bootstrap 5 CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="./css/style.css">

</head>

<body class="bg-light">

    <?php
    require_once("./php/header.php");
    ?>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>Carrito</h6>
                    <hr>
                    <?php

                    $total = 0;
                    if (isset($_SESSION['cart'])) {
                        $product_id = array_column($_SESSION['cart'], 'product_id');

                        $result = $db->getData();
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($product_id as $id) {
                                if ($row['id'] == $id) {
                                    cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['product_description'], $row['id']);
                                    $total = $total + (int)$row['product_price'];
                                }
                            }
                        }
                    } else {
                        echo "<h5>Cart is Empty</h5>";
                    }

                    ?>



                    <div class="col-md-5">


                    </div>
                </div>
            </div>

            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

                <div class="pt-4">
                    <h6>Detalles de la compra</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Precio ($count items)</h6>";
                            } else {
                                echo "<h6>Precio (0 Elementos)</h6>";
                            }
                            ?>
                            <h6>Costo Envio</h6>
                            <hr>
                            <h6><b>Impuestos</b></h6>

                        </div>
                        <div class="col-md-6">
                            <h6>$<?php echo $total; ?></h6>
                            <h6 class="text-success">GRATIS</h6>
                            <hr>
                            <h6>$<?php
                                    echo $total;
                                    ?></h6>
                        </div>
                    </div>
                </div>





            </div>
        </div>





        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>