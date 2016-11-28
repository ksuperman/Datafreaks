<?php
/**
 * Created by PhpStorm.
 * User: Parteek
 * Date: 11/25/2016
 * Time: 11:39 AM
 */


function getSearchResults()
{
    if (isset($_POST['searchText'])) {
        $searchText = $_POST['searchText'];
    } else {
        $searchText = "";
    }
    global $db_pdo;
    // $limit1 = $pageNumber * $limit;
    //$start = $limit1 - $limit;
    $sql_statement = "select * from product where name like '%" . $searchText . "%' ;";
    if (isset($db_pdo)) {
        $db_pdo = getPDOObject();
    }
    $sql = $db_pdo->prepare($sql_statement);
    $sql->execute();
    $product_list = $sql->fetchAll(PDO::FETCH_ASSOC);
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
                      <input type=\"hidden\" name=\"searchText\" value={$searchText} />
                        <button type=\"submit\" name=\"submit\" value={$value['ID']} class=\"btn btn-default\" id=\"{$value['ID']}\" title=\"Add to cart\">
                            <span class=\"fa fa-shopping-cart\"></span>
                        </button>
                        </form>
                    </div>
                    <a href=\"#\"> <img src={$value['IMG']} class=\"img-responsive image-size-fixed\" alt=\"Product Image\" /> </a>
                </div>
                <div class=\"info\">
                    <div class=\"row\">
                        <div class=\"price-details col-md-8\">
                            <h1 class='truncateText'>{$value['NAME']}</h1>
                            <span class=\"price-new \">$ {$value['PRICE']}</span>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        ";
        }
    } else {
        echo "<h1> No Products Found </h1>";
    }
}