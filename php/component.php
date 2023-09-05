<?php

function component($productname, $productprice, $productimg,  $productdescription, $productid)
{
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"index.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <p class=\"card-text\">
                                $productdescription
                            </p>
                            <h5>
                                <span class=\"price\">$$productprice</span>
                            </h5>

                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Añadir al Carrito <i class=\"fas fa-shopping-cart\"></i></button>
                            <input type='hidden' name='product_id' value='$productid'>
                            
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}

function cartElement($productimg, $productname, $productprice, $productdescription, $productid)
{
    $element = "
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
        <div class=\"border rounded\">
            <div class=\"row bg-white\">
                <div class=\"col-md-3 pl-0\">
                    <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid\">
                </div>
                <div class=\"col-md-6\">
                    <h5 class=\"pt-2\">$productname</h5>
                    <small class=\"text-secondary\">$productdescription</small>
                    <h5 class=\"pt-2\">$$productprice</h5>
                    <button type=\"submit\" class=\"btn btn-warning\">+ Lista de Deseos</button>
                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Eliminar</button>
                </div>
                <div class=\"col-md-3 py-5\">
                    <div>
                        <button type=\"button\" class=\"btn bg-light border rounded-circle subtract-from-cart\"><i class=\"fas fa-minus\"></i></button>
                        <input type=\"text\" name=\"quantity\" value=\"1\" class=\"form-control w-25 d-inline\">
                        <button type=\"button\" class=\"btn bg-light border rounded-circle add-to-cart\" data-price=\"$productprice\"><i class=\"fas fa-plus\"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    ";
    echo $element;
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
   
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addButtons = document.querySelectorAll(".add-to-cart");
        const subtractButtons = document.querySelectorAll(".subtract-from-cart");
        const quantityInputs = document.querySelectorAll("input[name='quantity']");
        const totalPriceElement = document.querySelector("#total-price");
        const taxPriceElement = document.querySelector("#tax-price");
        const totalWithTaxElement = document.querySelector("#total-with-tax");

        function updateTotals() {
            let total = 0;
            let itemCount = 0;
            
            quantityInputs.forEach(function (input, index) {
                const price = parseFloat(addButtons[index].getAttribute("data-price"));
                const quantity = parseInt(input.value);
                total += price * quantity;
                itemCount += quantity;
            });

            const tax = total * 0.19;
            const totalWithTax = total + tax;

            totalPriceElement.textContent = "$" + total.toFixed(2);
            taxPriceElement.textContent = "$" + tax.toFixed(2);
            totalWithTaxElement.textContent = "$" + totalWithTax.toFixed(2);
        }

        addButtons.forEach(function (addButton, index) {
            addButton.addEventListener("click", function () {
                quantityInputs[index].value = parseInt(quantityInputs[index].value) + 1;
                updateTotals();
            });
        });

        subtractButtons.forEach(function (subtractButton, index) {
            subtractButton.addEventListener("click", function () {
                if (quantityInputs[index].value > 1) {
                    quantityInputs[index].value = parseInt(quantityInputs[index].value) - 1;
                    updateTotals();
                }
            });
        });

        // Llama a updateTotals al cargar la página para inicializar los totales
        updateTotals();
    });
</script>

</body>
</html>

