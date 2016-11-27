<?php

function getUserShoppingCartItems()
{
    global $shopping_cart_items;
    if (isset($shopping_cart_items)) {
        foreach ($shopping_cart_items as $key => $value) {
            echo
            "<li>
            <a href=\"#\">
                <div class='productContainer'>
                    <img style=\"height: 50px; width: 50px;\"
                         src=\"{$value->getIMG()}\">
                    <div class='productName'>{$value->getNAME()}</div>
                    <span class=\"pull-right text-muted small\">Qty : {$value->getQUANTITY()}<br>Total : \${$value->getLineItemPrice()}</span>
                </div>
            </a>
        </li>
        <li class=\"divider\"></li>
        ";
        }
        echo
        "<li>
            <a class=\"text-center\" href=\"orders.php\">
                <strong>Go To Checkout</strong>
                <i class=\"fa fa-truck\"></i>
            </a>
        </li>";
    } else {
        echo
        "<li>
            <a href=\"./home.php\">
                <div class='productContainer'>
                <h2 style='text-align: center;'> There are no Items in the Cart</h2>
                    <img style=\"height: 50px; width: 50px;\"
                         src=\"http://www.tv-waldhof.de/images/shopping-cart-307772_640.png\">
                </div>
            </a>
        </li>
        <li class=\"divider\"></li>
        ";
    }
}