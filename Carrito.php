<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Seleciona los productos que quieres comprar</h1>
    <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
    <h2>Producto 1</h2>
    <br>
    <h1>El precio del producto 1 es 1 dolar</h1>
    <br>
    <input type="submit" name="Prod1" value="Añadir al carrito">
    <br>
    <h2>Producto 2</h2>
    <br>
    <h1>El precio del producto 2 son 2 dolares</h1>
    <br>
    <input type="submit" name="Prod2" value="Añadir al carrito">
    <br>
    <h2>Producto 3</h2>
    <br>
    <h1>El precio del producto 3 son 3 dolares</h1>
    <br>
    <input type="submit" name="Prod3" value="Añadir al carrito">
    <br>
    <input type="submit" name="sumbit" value="Pagar">
    </form>
    <h2> El valor a pagar es: </h2>
    <?php
    $cont1 = 0;
    $cost1 = 1;
    $cont2 = 0;
    $cost2 = 2;
    $cont3 = 0;
    $cost3 = 3;
    $resultado = 0;
    if(isset($_POST['Prod1'])){
        $cont1 = $cont1 + 1;
        echo("Vas a comprar {$cont1} unidades del producto 1");
    }
    if(isset($_POST['Prod2'])){
        $cont2 = $cont2 + 1;
        echo("Vas a comprar {$cont2} unidades del producto 1");
    }
    if(isset($_POST['Prod3'])){
        $cont3 = $cont3 + 1;
        echo("Vas a comprar {$cont3} unidades del producto 1");
    }
    if(isset($_POST['sumbit'])){
        $resultado = ($cont1*$cost1) + ($cont2*$cost2) + ($cont3*$cost3);
        echo("El valor a pagar es: ");
        echo ($resultado);
    }
    ?>
</body>
</html>