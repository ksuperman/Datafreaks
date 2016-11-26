<?php

function getUserShoppingCartItems()
{
    global $shopping_cart_items;
    if (isset($shopping_cart_items)) {
        foreach ($shopping_cart_items as $key => $value) {
            echo
            "<li>
            <a href=\"#\">
                <div>
                    <img style=\"height: 50px; width: 50px;\"
                         src=\"{$value->getIMG()}\">
                    {$value->getNAME()}
                    <span class=\"pull-right text-muted small\">Qty : {$value->getQUANTITY()}<br>Total : \${$value->getLineItemPrice()}</span>
                </div>
            </a>
        </li>
        <li class=\"divider\"></li>
        ";
        }
    }
}