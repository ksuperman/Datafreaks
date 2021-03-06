<?php

function getCountOfPlacedOrder()
{
    global $user_order;
    $count = 0;
    if (isset($user_order)){
        $count = count($user_order);
        if (!isset($count)) {
            $count = 0;
        }
    }
    echo $count;
}

function getCountOfPendingOrder()
{
    global $uid;
    $count = 0;
    if(isset($uid)){
        $sql_statement = "SELECT COUNT(*) as OrderCount FROM `orders` WHERE STATUS = 'Pending' AND USERID = :uid";
        $params = array(':uid' => $uid);
        $orderCount = queryForSingleRow($sql_statement, $params);
        $count = $orderCount['OrderCount'];
        if(empty($count)) {
            $count = 0;
        }
    }
    echo $count;
}

function getItemCountInShoppingCart()
{
    $count = 0;
    global $shopping_cart_items;
    if (isset($shopping_cart_items)){
        $count = count($shopping_cart_items);
        if (!isset($count)) {
            $count = 0;
        }
    }
    echo $count;
}

function createUserAddressBlock()
{
    global $user_addr;
    if (isset($user_addr)){
        foreach ($user_addr as $key => $value) {
            $index = $key + 1;
            $first = '';
            if ($index == 1) {
                $first = "in";
            }
            echo "<div class=\"panel panel-default\">
                <div class=\"panel-heading\">
                    <h4 class=\"panel-title\">
                        <a data-toggle=\"collapse\" data-parent=\"#address_accordion\" href=\"#collapse$index\">Address
                            #$index</a>
                    </h4>
                </div>
                <div id=\"collapse$index\" class=\"panel-collapse collapse $first \">
                    <div class=\"panel-body\">
                        <div class=\"row\">
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>Unit Number</label>
                                    <p class=\"form-control-static\"> {$value->getUNITNUMBER()}</p>
                                </div>
                            </div>
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>Street Name</label>
                                    <p class=\"form-control-static\">{$value->getSTREETNAME()}</p>
                                </div>
                            </div>
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>City</label>
                                    <p class=\"form-control-static\">{$value->getCITY()}</p>
                                </div>
                            </div>
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>County</label>
                                    <p class=\"form-control-static\">{$value->getCOUNTRY()}</p>
                                </div>
                            </div>
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>State</label>
                                    <p class=\"form-control-static\">{$value->getSTATE()}</p>
                                </div>
                            </div>
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>Zipcode</label>
                                    <p class=\"form-control-static\">{$value->getZIPCODE()}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
        echo "
        <div class='addAddressButton'>
            <button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#addNewAddress\">
                Add New Address
            </button>
        </div>
        <!-- Modal -->
        <div class=\"modal fade\" id=\"addNewAddress\" tabindex=\"-1\" role=\"dialog\"
             aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\">
                <form role=\"form\" action=\"./content_helpers/add_new_address.php\" method=\"post\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                                    aria-hidden=\"true\">&times;</button>
                            <h4 class=\"modal-title\" id=\"myModalLabel\">Add New Address</h4>
                        </div>
                        <div class=\"modal-body\">
                            <fieldset>
                                <div class=\"form-group input-group\">
                                    <input type=\"text\" class=\"form-control\"
                                           placeholder=\"Unit Number\" name=\"unitnumber\">
                                    <span class=\"input-group-addon\">Unit Number</span>
                                </div>
                                <div class=\"form-group input-group\">
                                    <input type=\"text\" class=\"form-control\"
                                           placeholder=\"Street Name\" name=\"streetname\">
                                    <span class=\"input-group-addon\">Street Name</span>
                                </div>
                                <div class=\"form-group input-group\">
                                    <input type=\"text\" class=\"form-control\"
                                           placeholder=\"City\" name=\"city\">
                                    <span class=\"input-group-addon\">City</span>
                                </div>
                                <div class=\"form-group input-group\">
                                    <input type=\"text\" class=\"form-control\"
                                           placeholder=\"County\" name=\"county\">
                                    <span class=\"input-group-addon\">County</span>
                                </div>
                                <div class=\"form-group input-group\">
                                    <input type=\"text\" class=\"form-control\"
                                           placeholder=\"state\" name=\"state\">
                                    <span class=\"input-group-addon\">State</span>
                                </div>
                                <div class=\"form-group input-group\">
                                    <input type=\"text\" class=\"form-control\"
                                           placeholder=\"Zipcode\" name=\"zipcode\">
                                    <span class=\"input-group-addon\">Zipcode</span>
                                </div>
                            </fieldset>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">
                                Close
                            </button>
                            <button type=\"submit\" class=\"btn btn-primary\">Update Changes
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>";
    }
}

function createUserPaymentBlock()
{
    global $user_payment;

    if (isset($user_payment)){
        foreach ($user_payment as $key => $value) {
            $index = $key + 1;
            $first = '';
            if ($index == 1) {
                $first = "in";
            }
            echo "<div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <h4 class=\"panel-title\">
                    <a data-toggle=\"collapse\" data-parent=\"#paymentAcc\" href=\"#payment$index\">Payment
                        Method #$index</a>
                </h4>
            </div>
            <div id=\"payment$index\" class=\"panel-collapse collapse $first\">
                <div class=\"panel-body\">
                    <div class=\"panel-body\">
                        <div class=\"row\">
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>Name On Card</label>
                                    <p class=\"form-control-static\">{$value->getFULLNAME()}</p>
                                </div>
                            </div>
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>Card Number</label>
                                    <p class=\"form-control-static\">{$value->getCARDNUMBER()}</p>
                                </div>
                            </div>
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>PIN/CVV</label>
                                    <p class=\"form-control-static\">{$value->getPINCVV()}</p>
                                </div>
                            </div>
                            <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                                <div class=\"form-group\">
                                    <label>Expire Date</label>
                                    <p class=\"form-control-static\">{$value->getEXPDATE()}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        echo "
        <div class='addAddressButton'>
            <button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#addNewPayment\">
                Add New Payment
            </button>
        </div>
        <!-- Modal -->
        <div class=\"modal fade\" id=\"addNewPayment\" tabindex=\"-1\" role=\"dialog\"
             aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\">
                <form role=\"form\" action=\"./content_helpers/add_new_payment.php\" method=\"post\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\"
                                    aria-hidden=\"true\">&times;</button>
                            <h4 class=\"modal-title\" id=\"myModalLabel\">Add New Payment</h4>
                        </div>
                        <div class=\"modal-body\">
                            <fieldset>
                                <div class=\"form-group\">
                                    <label>Card Type</label>
                                    <select class=\"form-control\" name='type'>
                                        <option>Credit Card</option>
                                        <option>Debit Card</option>
                                    </select>
                                </div>
                                <div class=\"form-group input-group\">
                                    <input type=\"text\" class=\"form-control\"
                                           placeholder=\"Full Name\" name=\"FULLNAME\">
                                    <span class=\"input-group-addon\">Street Name</span>
                                </div>
                                <div class=\"form-group input-group\">
                                    <input type=\"text\" class=\"form-control\"
                                           placeholder=\"Card Number\" name=\"CARDNUMBER\">
                                    <span class=\"input-group-addon\">CARDNUMBER</span>
                                </div>
                                <div class=\"form-group input-group\">
                                    <input type=\"text\" class=\"form-control\"
                                           placeholder=\"PIN/CVV\" name=\"PIN_CVV\">
                                    <span class=\"input-group-addon\">PIN/CVV</span>
                                </div>
                                <div class=\"form-group input-group\">
                                    <input type=\"date\" class=\"form-control\"
                                           placeholder=\"Expiry Date\" name=\"EXPDATE\">
                                    <span class=\"input-group-addon\">Expiry Date</span>
                                </div>
                            </fieldset>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">
                                Close
                            </button>
                            <button type=\"submit\" class=\"btn btn-primary\">Update Changes
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>";
    }
}

function createUserPhoneNumberBlock()
{
    global $aid;

    $sql_statement = "SELECT * FROM `phonenumber` WHERE ACCOUNTID = :aid";
    $params = array(':aid' => $aid);
    $result_set = queryForMultipleRows($sql_statement, $params);
    if (isset($result_set)){
        foreach ($result_set as $key => $value) {
            $phone_num = "+" . $value['COUNTRYCODE'] . " (" . $value['AREACODE'] . ") " . $value['NUMBER'];
            echo
            "<div class=\"form-group input-group\">
            <span class=\"input-group-addon\"><i class=\"fa fa-phone fa-1x\"></i></span>
            <input type=\"text\" class=\"form-control\" placeholder=\"Phone Number\" value=\"$phone_num\">
        </div>";
        }
    }
}

function createUserOrdersBlock()
{
    global $user_order;
    if (isset($user_order)) {
        foreach ($user_order as $key => $value) {

            $address = $value->getSTREETNAME() . ",  Apartment " . $value->getUNITNUMBER() . ", " . $value->getCITY() . ", " . $value->getSTATE() . " - " . $value->getZIPCODE();

            echo
            "<div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <h4 class=\"panelHeading\"><i class=\"fa fa-truck fa-fw \"></i>Order #{$value->getORDERID()}</h4>
            </div>
            <div class=\"panel-body\">
                <div class=\"row\">
                    <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                        <div class=\"form-group\">
                            <label>Order Status</label>
                            <p class=\"form-control-static\">{$value->getSTATUS()}</p>
                        </div>
                    </div>
                    <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                        <div class=\"form-group\">
                            <label>Order Date</label>
                            <p class=\"form-control-static\">{$value->getORDERDATE()}</p>
                        </div>
                    </div>
                    <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                        <div class=\"form-group\">
                            <label><i class=\"fa fa-credit-card fa-fw \"></i> Payment Mode</label>
                            <p class=\"form-control-static\">{$value->getTYPE()}</p>
                        </div>
                    </div>
                    <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                        <div class=\"form-group\">
                            <label><i class=\"fa fa-home fa-fw\"></i>Delivery Address</label>
                            <p class=\"form-control-static\">$address</p>
                        </div>
                    </div>
                    <div class=\"col-lg-3 col-md-6 col-sm-6 col-xs-6\">
                        <div class=\"form-group\">
                            <label><i class=\"fa fa-credit-card fa-fw\"></i>Card Number</label>
                            <p class=\"form-control-static\">{$value->getCARDNUMBER()}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"panel-footer\">
                <a href='./orderConfirmation.php?orderid={$value->getORDERID()}'>
                    <button class=\"btn btn-info\">
                        View Order Details
                    </button>
                </a>
            </div>
        </div>";
        }
    }
}

function displayUserDetailsUpdateStatus()
{
    if (isset($_REQUEST['update'])) {
        $updateCount = (int) $_REQUEST['update'];
        if($updateCount > 0) {
           echo
           "<div class=\"alert alert-success alert-dismissable alert-floating\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    User Details updated successfully.
             </div>
            ";
        } else {
            echo
            "<div class=\"alert alert-danger alert-dismissable alert-floating\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    User Details not updated!!! Please try again.
             </div>
            ";
        }
    }
}