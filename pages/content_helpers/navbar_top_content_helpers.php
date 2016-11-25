<?php

function getUserShoppingCartItems()
{
    global $user_shopping_cart, $shopping_cart_items;
    foreach ($shopping_cart_items as $key => $value) {
        $index = $key + 1;
        $first = '';
        if ($index == 1) {
            $first = "in";
        }
        echo
        "<li>
            <a href=\"#\">
                <div>
                    <img style=\"height: 50px; width: 50px;\"
                         src=\"{$value->getIMG()}\">
                    {$value->getNAME()}
                    <span class=\"pull-right text-muted small\">Qty : {$value->getQUANTITY()}</span>
                </div>
            </a>
        </li>
        <li class=\"divider\"></li>
        ";
    }
}