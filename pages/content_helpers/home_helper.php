<?php
/**
 * Created by PhpStorm.
 * User: Parteek
 * Date: 11/25/2016
 * Time: 11:39 AM
 */

include_once("../objects/catalogProduct.php");

if (isset($_GET['pageNumber'])) {
    echo "this is" . $_GET['pageNumber'];
}else{
    $pageNumber = 1;
}

if (isset($_GET['category'])) {
    echo "this is" . $_GET['category'];
    $category = $_GET['category'];
}

if (isset($_GET['total'])) {
    echo "this is" . $_GET['total'];
    $total = $_GET['total'];
}

function getAllCategory()
{
    global $db_pdo;
    $sql_statement = "SELECT DISTINCT Category FROM `catalog` WHERE 1";
    $category_list = queryForMultipleRows($sql_statement, null);
    $checkFirst = true;
    foreach ($category_list as $key => $value) {
        $sanitizeCategory = str_replace(' ', '_', $value["Category"]);
        if(!isset($_GET['category'])){
            if ($checkFirst) {
                echo "<li class=\"active\"><a href=\"#$sanitizeCategory\" data-toggle=\"tab\">$sanitizeCategory</a>
              </li>";
                $checkFirst = false;
            } else {
                echo "<li><a href=\"#$sanitizeCategory\" data-toggle=\"tab\">$sanitizeCategory</a>
                </li>";
            }
        }
        else{
            if($_GET['category']==$value["Category"]){
                echo "<li class=\"active\"><a href=\"#$sanitizeCategory\" data-toggle=\"tab\">$sanitizeCategory</a>
              </li>";
            }
            else{
                echo "<li><a href=\"#$sanitizeCategory\" data-toggle=\"tab\">$sanitizeCategory</a>
                </li>";
            }
        }
    }
    echo "</ul><div class=\"tab-content\">";
    $checkFirst = true;
    foreach ($category_list as $key => $value) {
        $sanitizeCategory = str_replace(' ', '_', $value["Category"]);
        if (!isset($_GET['category']))
        {
            if ($checkFirst) {
                echo "<div class=\"tab-pane fade in active\" id=$sanitizeCategory>
                        <h4>$sanitizeCategory</h4>";
                getProductsForCategory($value["Category"], 0, 8);
                echo "</div>";
                $checkFirst = false;
            } else {
                echo "<div class=\"tab-pane fade\" id=$sanitizeCategory>
                        <h4>$sanitizeCategory</h4>";
                getProductsForCategory($value["Category"], 0, 8);
                echo "</div>";
            }
        }
        else{
            if($_GET['category'] == $value["Category"]){
                $pageNumber = $_GET['pageNumber'];
                $start = $pageNumber*8-8;
                echo "<div class=\"tab-pane fade in active\" id=$sanitizeCategory>
                        <h4>$sanitizeCategory</h4>";
                getProductsForCategory($value["Category"], $start, 8);
                echo "</div>";
            }
            else{
                echo "<div class=\"tab-pane fade\" id=$sanitizeCategory>
                        <h4>$sanitizeCategory</h4>";
                getProductsForCategory($value["Category"], 0, 8);
                echo "</div>";
            }
        }
    }
}

function getProductsForCategory($category, $start, $limit)
{
    global $db_pdo;
   // $limit1 = $pageNumber * $limit;
    //$start = $limit1 - $limit;
    $sql_statement = "SELECT p.id as id, p.catalogid as catalogid, c.category as category, p.name as name, p.img as image, p.price as price ,p.description as description  FROM product p, catalog c WHERE p.catalogid = c.id AND c.category = :category limit :start,8;";
    if (isset($db_pdo)) {
        $db_pdo = getPDOObject();
    }
    logErrorToConsole("category name is  -- !!!" . var_export($category, true));
    $sql = $db_pdo->prepare($sql_statement);

    $sql->bindParam(":category", $category, PDO::PARAM_STR);
    $sql->bindParam(":start", $start, PDO::PARAM_INT);
    $sql->execute();
    $product_list = $sql->fetchAll(PDO::FETCH_CLASS, "catalogProduct");
    logErrorToConsole("Get Product List " . var_export($sql, true) . " ; " . var_export($product_list, true));
    if (sizeof($product_list) != 0) {
        foreach ($product_list as $key => $value) {
            $encodedCat =   urlencode($value->getCategory());
            echo
            "<div class=\"col-sm-3\">
            <article class=\"col-item\">
                <div class=\"photo\">
                    <div class=\"options-cart-round\">
                    <form action=\"./content_helpers/addcart_helper.php\" name=\"yourForm\" id=\"theForm\" method=\"post\">
                      <input type=\"hidden\" name=\"action\" value=\"submit\" />
                      <input type=\"hidden\" name=\"pageNumber\" value={$_GET['pageNumber']} />
                      <input type=\"hidden\" name=\"category\" value=$encodedCat />
                      <input type=\"hidden\" name=\"total\" value={$_GET['total']} />
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
        $numberOfPages = round($total / 8);
        if($total/8>$numberOfPages){
            $numberOfPages = $numberOfPages+1;
        }
        echo "<h1> $total - round($numberOfPages)</h1> <nav aria-label=\"...\">
                <ul class=\"pagination\">
                <li class=\"disabled\"><a href=\"#\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
        $first = true;
        $index = 1;
        while ($numberOfPages > 0) {
            if (!isset($_GET['category'])) {
                if ($first) {
                    echo "  <li class=\"active\"><a href=\"home.php?pageNumber=$index&category=$category&total=$total\">$index <span class=\"sr-only\">(current)</span></a></li>";
                } else {
                    echo "  <li><a href=\"home.php?pageNumber=$index&category=$category&total=$total\">$index</a></li>";
                }
            }
            else{
                if($_GET['pageNumber'] == $index){
                    echo "  <li class=\"active\"><a href=\"home.php?pageNumber=$index&category=$category&total=$total\">$index <span class=\"sr-only\">(current)</span></a></li>";
                }
                else{
                    echo "  <li><a href=\"home.php?pageNumber=$index&category=$category&total=$total\">$index</a></li>";
                }
            }
            $first = false;
            $numberOfPages--;
            $index++;

        }
        echo "</ul>
         </nav>";
    }
}
