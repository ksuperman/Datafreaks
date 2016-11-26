<?php
/**
 * Created by PhpStorm.
 * User: Parteek
 * Date: 11/25/2016
 * Time: 11:39 AM
 */

include_once("../objects/catalogProduct.php");

function getAllCategory()
{
    global $db_pdo;
    $sql_statement = "SELECT DISTINCT Category FROM `catalog` WHERE 1";
    $category_list = queryForMultipleRows($sql_statement, null);
    $checkFirst = true;
    foreach ($category_list as $key => $value) {
        $sanitizeCategory = str_replace(' ', '_', $value["Category"]);
        if ($checkFirst) {
            echo "<li class=\"active\"><a href=\"#$sanitizeCategory\" data-toggle=\"tab\">$sanitizeCategory</a>
              </li>";
            $checkFirst = false;
        } else {
            echo "<li><a href=\"#$sanitizeCategory\" data-toggle=\"tab\">$sanitizeCategory</a>
                </li>";
        }
    }
    echo "</ul><div class=\"tab-content\">";
    $checkFirst = true;
    foreach ($category_list as $key => $value) {
        $sanitizeCategory = str_replace(' ', '_', $value["Category"]);
        if ($checkFirst) {
            echo "<div class=\"tab-pane fade in active\" id=$sanitizeCategory>
                        <h4>$sanitizeCategory</h4>";
            getProductsForCategory($value["Category"],0,8);
            echo "</div>";
            $checkFirst = false;
        } else {
            echo "<div class=\"tab-pane fade\" id=$sanitizeCategory>
                        <h4>$sanitizeCategory</h4>";
            getProductsForCategory($value["Category"],0,8);
            echo "</div>";
        }
    }
}

function getProductsForCategory($category, $pageNumber, $limit)
{
    global $db_pdo;
    $limit1 = $pageNumber * $limit;
    $start = $limit1 - $limit;
    $sql_statement = "SELECT p.id as id, p.catalogid as catalogid, c.category as category, p.name as name, p.img as image, p.price as price ,p.description as description  FROM product p, catalog c WHERE p.catalogid = c.id AND c.category = :category limit 0,8;";
    if (isset($db_pdo)) {
        $db_pdo = getPDOObject();
    }
    logErrorToConsole("category name is  -- !!!" . var_export($category, true));
    $sql = $db_pdo->prepare($sql_statement);

    $sql->bindParam(":category", $category, PDO::PARAM_STR);
    $sql->execute();
    $product_list = $sql->fetchAll(PDO::FETCH_CLASS, "catalogProduct");
    logErrorToConsole("Get Product List " . var_export($sql, true) . " ; " . var_export($product_list, true));
    if (sizeof($product_list) != 0) {
        foreach ($product_list as $key => $value) {
            echo
            "<div class=\"col-sm-3\">
            <article class=\"col-item\">
                <div class=\"photo\">
                    <div class=\"options-cart-round\">
                    <form action=\"./content_helpers/addcart_helper.php\" name=\"yourForm\" id=\"theForm\" method=\"post\">
                      <input type=\"hidden\" name=\"action\" value=\"submit\" />
                        <button type=\"submit\" name=\"submit\" value={$value->getId()} class=\"btn btn-default\" id=\"{$value->getId()}\" title=\"Add to cart\">
                            <span class=\"fa fa-shopping-cart\"></span>
                        </button>
                        </form>
                    </div>
                    <a href=\"#\"> <img src={$value->getImage()} class=\"img-responsive\" alt=\"Product Image\" /> </a>
                </div>
                <div class=\"info\">
                    <div class=\"row\">
                        <div class=\"price-details col-md-8\">
                            <h1 class='truncateText'>{$value->getName()}</h1>
                            <span class=\"price-new \">$ {$value->getPrice()}</span>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        ";
        }
        getPagination($category);
    } else {
        echo "<h1> No Products Found </h1>";
    }
}

function getPagination($category){

    $sql_statement = "SELECT p.id as id, p.catalogid as catalogid, c.category as category, p.name as name, p.img as image, p.price as price ,p.description as description  FROM product p, catalog c WHERE p.catalogid = c.id AND c.category = :category;";

        $db_pdo = getPDOObject();

    $sql = $db_pdo->prepare($sql_statement);

    $sql->bindParam(":category", $category, PDO::PARAM_STR);
    $sql->execute();
    $product_list = $sql->fetchAll(PDO::FETCH_CLASS, "catalogProduct");
    $total = count($product_list);
    if($total>=8) {
        logErrorToConsole("Get Product List " . var_export($sql, true) . " ; " . var_export($product_list, true));
        $numberOfPages = round($total / 8) + 1;
        echo "<h1> $total - round($numberOfPages)</h1> <nav aria-label=\"...\">
                <ul class=\"pagination\">
                <li class=\"disabled\"><a href=\"#\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
        $first = true;
        $index = 1;
        while ($numberOfPages > 0) {
            if ($first) {
                echo "  <li class=\"active\"><a href=\"home.php?pageNumber=$index&category=$category\">$index <span class=\"sr-only\">(current)</span></a></li>";
            } else {
                echo "  <li><a href=\"home.php?pageNumber=$index&category=$category\">$index</a></li>";
            }
            $first = false;
            $numberOfPages--;
            $index++;
        }
        echo "</ul>
         </nav>";
    }
}
