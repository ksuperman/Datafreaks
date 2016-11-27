CREATE DEFINER=`root`@`localhost` PROCEDURE `EXPORT_USER_SALES_TRANSACTION`()
  BEGIN

    # Declaring Variables and Cursors

    # Payment Variables

    DECLARE payment_rows_left INTEGER DEFAULT 1;

    DECLARE PAYMENT_TYPE VARCHAR(255);

    # Products Variables

    DECLARE product_rows_left INTEGER DEFAULT 1;

    DECLARE CatalogProductId INT(11);

    DECLARE NAME VARCHAR(255);

    DECLARE PRICE INT(11);

    DECLARE CATEGORY VARCHAR(255);

    # User Variables

    DECLARE user_rows_left INTEGER DEFAULT 1;

    DECLARE user_account_count INTEGER DEFAULT 1;

    DECLARE UserId INT(11);

    DECLARE AccountId INT(11);

    DECLARE CustomerName VARCHAR(255);

    DECLARE Email VARCHAR(255);

    DECLARE Address VARCHAR(255);

    DECLARE Zipcode INT(11);

    DECLARE Age INT(11);

    DECLARE DateOfBirth DATE;

    DECLARE Gender VARCHAR(255);

    # Order Variables

    DECLARE order_rows_left INTEGER DEFAULT 1;

    DECLARE OrderId INT(11);

    DECLARE OrderStatus VARCHAR(30);

    DECLARE OrderAddressStreet VARCHAR(20);

    DECLARE OrderAddressCity VARCHAR(30);

    DECLARE OrderAddressState VARCHAR(30);

    DECLARE OrderAddressPincode INT(11);

    DECLARE OrderAddressCountry VARCHAR(20);

    DECLARE OrderAmount INT(11);

    DECLARE FullDate DATE;

    DECLARE Date INT(11);

    DECLARE Month INT(11);

    DECLARE Year INT(11);

    # Sales Transaction Variables

    DECLARE sales_trans_rows_left INTEGER DEFAULT 1;

    DECLARE TransactionAmount INT(11);

    DECLARE TransactionQuantity INT(11);

    DECLARE OrderDateId INT(11);

    DECLARE UserAccountId INT(11);

    DECLARE PaymentId INT(11);

    DECLARE PaymentModeType VARCHAR(255);

    # Shopping Cart Variables

    DECLARE shopping_cart_rows_left INTEGER DEFAULT 1;

    DECLARE ShoppingCartId INT(11);

    DECLARE ShoppingCartStatus VARCHAR(255);

    DECLARE ShoppingCartAmount INT(11);

    # Shopping Cart Items

    DECLARE shopping_cart_items_left INTEGER DEFAULT 1;

    DECLARE CartItemQuantity INT(11);

    DECLARE CartItemAmount INT(11);

    # Declare Cursors

    DECLARE modeofpayment_cursor CURSOR FOR SELECT DISTINCT TYPE as PAYMENT_TYPE FROM datafreaks_prod.modeofpayment;

    DECLARE catalog_product_cursor CURSOR FOR SELECT p.ID as CatalogProductId, p.NAME, p.PRICE, c.CATEGORY FROM product p, catalog c WHERE p.CATALOGID = c.ID;

    DECLARE user_account_cursor CURSOR FOR SELECT u.ID as 'UserId', a.ID as 'AccountId', CONCAT(u.FIRSTNAME ,' ', u.MIDDLENAME ,' ', u.LASTNAME) as CustomerName, a.EMAIL as Email, CONCAT(addr.`UNITNUMBER` ,', ', addr.`STREETNAME` ,', ', addr.`CITY` ,', ', addr.`STATE` ,', ', addr.`COUNTRY`) AS Address, addr.ZIPCODE AS 'Zipcode', FLOOR(ABS(DATEDIFF(u.DOB, NOW()) / 365.25)) as Age, u.DOB as DateOfBirth FROM user u, account a LEFT OUTER JOIN address addr ON addr.ID = a.ADDRESSID WHERE a.USERID = u.ID;

    DECLARE order_cursor CURSOR FOR SELECT ord.ID AS OrderId, ord.STATUS AS OrderStatus, addr.STREETNAME as OrderAddressStreet, addr.CITY as OrderAddressCity, addr.STATE as OrderAddressState, addr.ZIPCODE as OrderAddressPincode, addr.COUNTRY as OrderAddressCountry,10 as OrderAmount, DATE(ord.ORDERDATE) as FullDate,DAYOFMONTH(ord.ORDERDATE) as Date,MONTH(ord.ORDERDATE) as Month,YEAR(ord.ORDERDATE) as Year FROM orders ord, address addr WHERE ord.ADDRESSID = addr.ID;

    DECLARE sales_transaction_cursor CURSOR FOR SELECT (prod.PRICE * oli.QUANTITY) as TransactionAmount,oli.QUANTITY as TransactionQuantity, oli.ORDERID as OrderId, oli.PRODUCTID as CatalogProductId, cat.CATEGORY as Category, prod.NAME as Name,DATE(ord.ORDERDATE) as FullDate, ord.USERID as USERID, mop.TYPE as PaymentModeType FROM orderlineitems oli, product prod, catalog cat, orders ord,modeofpayment mop  WHERE prod.ID = oli.PRODUCTID AND cat.ID = prod.CATALOGID AND ord.ID = oli.ORDERID AND mop.ID = ord.PAYMENTID;

    DECLARE shopping_cart_cursor CURSOR FOR SELECT ID as ShoppingCartId, STATUS as ShoppingCartStatus, 50 as ShoppingCartAmount FROM shoppingcart;

    DECLARE shopping_cart_item_cursor CURSOR FOR SELECT psc.QUANTITY AS CartItemQuantity, (psc.QUANTITY * p.PRICE) AS CartItemAmount, psc.PRODUCTID as CatalogProductId,p.NAME as Name,cat.CATEGORY as Category,psc.CARTID AS ShoppingCartId,sc.ACCOUNTID as AccountId FROM product_shoppingcart psc, product p,shoppingcart sc,catalog cat WHERE p.ID = psc.PRODUCTID AND sc.ID = psc.CARTID AND cat.ID = p.CATALOGID;

    # Processing Payment Modes

    SELECT "START ==> Mode of Payment";

    OPEN modeofpayment_cursor;

    BEGIN

      DECLARE CONTINUE HANDLER FOR NOT FOUND SET payment_rows_left = 0;

      payment_loop: LOOP

        FETCH modeofpayment_cursor INTO PAYMENT_TYPE;

        IF payment_rows_left = 0 THEN
          LEAVE payment_loop;
        END IF;

        call debug_msg(CONCAT("Payment Mode ==> ",PAYMENT_TYPE));

        START TRANSACTION;

        INSERT INTO `datafreaks_datawarehouse`.`ModeOfPayment` (`ModeOfPayment`.`PaymentModeType`) VALUES (PAYMENT_TYPE)
        ON DUPLICATE KEY UPDATE `ModeOfPayment`.`PaymentModeType` = VALUES(`ModeOfPayment`.`PaymentModeType`);

        COMMIT;

      END LOOP;

    END;

    CLOSE modeofpayment_cursor;

    SELECT "END ==> Mode of Payment";

    # Processing Catalog Products

    SELECT "START ==> Catalog Products";

    OPEN catalog_product_cursor;

    BEGIN

      DECLARE CONTINUE HANDLER FOR NOT FOUND SET product_rows_left = 0;

      product_loop: LOOP

        FETCH catalog_product_cursor INTO CatalogProductId, NAME, PRICE, CATEGORY;

        IF product_rows_left = 0 THEN
          LEAVE product_loop;
        END IF;

        call debug_msg(CONCAT("CatalogProductId ==> ",CatalogProductId,"NAME ==> ",NAME,"PRICE ==> ",PRICE,"CATEGORY ==> ",CATEGORY));

        START TRANSACTION;

        INSERT INTO `datafreaks_datawarehouse`.`CatalogProduct` (`CatalogProductId`,`Category`,`Name`,`Price`) VALUES (CatalogProductId, CATEGORY, NAME, PRICE)
        ON DUPLICATE KEY UPDATE `PRICE` = VALUES(PRICE),`CatalogProductId` = VALUES(CatalogProductId);

        COMMIT;

      END LOOP;

    END;

    CLOSE catalog_product_cursor;

    SELECT "END ==> Catalog Products";

    # Processing User Account

    SELECT "START ==> User Account";

    OPEN user_account_cursor;

    BEGIN

      DECLARE CONTINUE HANDLER FOR NOT FOUND SET user_rows_left = 0;

      user_acc_loop: LOOP

        FETCH user_account_cursor INTO UserId, AccountId, CustomerName, Email, Address, Zipcode, Age, DateOfBirth;

        IF user_rows_left = 0 THEN
          LEAVE user_acc_loop;
        END IF;

        IF user_account_count % 2 <> 0 THEN
          SET Gender = 'M';
        ELSE
          SET Gender = 'F';
        END IF;

        call debug_msg(CONCAT("UserId ==> ",UserId,"AccountId ==> ",AccountId,"CustomerName ==> ",CustomerName,"Email ==> ",Email,"Address ==> ",Address,"Zipcode ==> ",Zipcode,"Age ==> ",Age,"DateOfBirth ==> ",DateOfBirth));

        START TRANSACTION;

        INSERT INTO `datafreaks_datawarehouse`.`UserAccount`(`UserId`, `AccountId`, `CustomerName`, `Email`, `Address`, `Zipcode`, `Age`, `DateOfBirth`, `Gender`) VALUES (UserId, AccountId, CustomerName, Email,Address, Zipcode, Age, DateOfBirth, Gender)
        ON DUPLICATE KEY UPDATE `UserId` = VALUES(UserId),`AccountId` = VALUES(AccountId),`CustomerName` = VALUES(CustomerName),`Email` = VALUES(Email),`Address` = VALUES(Address),`Zipcode` = VALUES(Zipcode),`Age` = VALUES(Age),`DateOfBirth` = VALUES(DateOfBirth),`Gender` = VALUES(Gender);

        COMMIT;

        SET user_account_count := user_account_count + 1;

      END LOOP;

    END;

    CLOSE user_account_cursor;

    SELECT "END ==> User Account";

    # Processing Orders Table

    SELECT "START ==> Orders Processing";

    OPEN order_cursor;

    BEGIN

      DECLARE CONTINUE HANDLER FOR NOT FOUND SET order_rows_left = 0;

      order_loop: LOOP

        FETCH order_cursor INTO OrderId, OrderStatus, OrderAddressStreet, OrderAddressCity, OrderAddressState, OrderAddressPincode, OrderAddressCountry, OrderAmount, FullDate, Date, Month, Year;

        IF order_rows_left = 0 THEN
          LEAVE order_loop;
        END IF;

        SET OrderAmount = (1 + FLOOR(RAND() * 100) * OrderAmount);

        call debug_msg(CONCAT("OrderId ==> ",OrderId,";; OrderStatus ==> ",OrderStatus,";; OrderAddressStreet ==> ",OrderAddressStreet,";; OrderAddressPincode ==> ",OrderAddressPincode,";; OrderAmount ==> ",OrderAmount,";; FullDate ==> ",FullDate,";; Date ==> ",Date,";; Month ==> ",Month,";; Year ==> ",Year));

        START TRANSACTION;

        INSERT INTO `datafreaks_datawarehouse`.`Orders`(`OrderId`, `OrderStatus`, `OrderAddressStreet`, `OrderAddressCity`, `OrderAddressState`, `OrderAddressPincode`, `OrderAddressCountry`, `OrderAmount`) VALUES (OrderId, OrderStatus, OrderAddressStreet, OrderAddressCity, OrderAddressState, OrderAddressPincode, OrderAddressCountry, OrderAmount)
        ON DUPLICATE KEY UPDATE `OrderId` = VALUES(OrderId),`OrderStatus` = VALUES(OrderStatus),`OrderAddressStreet` = VALUES(OrderAddressStreet),`OrderAddressCity` = VALUES(OrderAddressCity),`OrderAddressState` = VALUES(OrderAddressState),`OrderAddressPincode` = VALUES(OrderAddressPincode),`OrderAddressCountry` = VALUES(OrderAddressCountry),`OrderAmount` = VALUES(OrderAmount);

        INSERT INTO `datafreaks_datawarehouse`.`OrderDate` (`FullDate`,`Date`,`Month`,`Year`) VALUES (`FullDate`,`Date`,`Month`,`Year`)
        ON DUPLICATE KEY UPDATE `FullDate` = VALUES(FullDate),`Date` = VALUES(Date),`Month` = VALUES(Month),`Year` = VALUES(Year);

        COMMIT;

        SET user_account_count := user_account_count + 1;

      END LOOP;

    END;

    CLOSE order_cursor;

    SELECT "END ==> Orders Processing";

    SELECT "START ==> Sales Transaction Processing";

    OPEN sales_transaction_cursor;

    BEGIN

      DECLARE CONTINUE HANDLER FOR NOT FOUND SET sales_trans_rows_left = 0;

      sales_transaction_loop: LOOP

        FETCH sales_transaction_cursor INTO TransactionAmount, TransactionQuantity, OrderId, CatalogProductId, Category, Name, FullDate, UserId, PaymentModeType;

        IF sales_trans_rows_left = 0 THEN
          LEAVE sales_transaction_loop;
        END IF;

        # Find the Catalog Product Id for the Product

        SET @CatalogProductId = CatalogProductId;

        SET @Category = Category;

        SET @Name = Name;

        SET @catalogProductSQL = 'SELECT `CatalogProductId` INTO @CatalogProductId  FROM `datafreaks_datawarehouse`.`CatalogProduct` WHERE `CatalogProductId` = ? AND `Category` = ? AND `Name` = ? LIMIT 1';

        PREPARE catalogProductStmt FROM @catalogProductSQL;

        EXECUTE catalogProductStmt USING @CatalogProductId, @Category, @Name;

        SET CatalogProductId = @CatalogProductId;

        call debug_msg(CONCAT("CatalogProductId ==> ",CatalogProductId));

        # Find the OrderDateId for Full Date Given

        SET @FullDate = FullDate;

        SET @OrderDateSQL = 'SELECT `OrderDateId` INTO @OrderDateId  FROM `datafreaks_datawarehouse`.`OrderDate` WHERE `FullDate` = ?';

        PREPARE OrderDateStmt FROM @OrderDateSQL;

        EXECUTE OrderDateStmt USING @FullDate;

        SET OrderDateId = @OrderDateId;

        call debug_msg(CONCAT("OrderDateId ==> ",OrderDateId));

        # Find the User AccountId from the UserID

        SET @UserId = UserId;

        SET @userAccountSQL = 'SELECT `UserAccountId` INTO @UserAccountId  FROM `datafreaks_datawarehouse`.`UserAccount` WHERE `UserId` = ?';

        PREPARE userAccountStmt FROM @userAccountSQL;

        EXECUTE userAccountStmt USING @UserId;

        SET UserAccountId = @UserAccountId;

        call debug_msg(CONCAT("UserAccountId ==> ",UserAccountId));

        # Find the Finding the PaymentID from the Payment Type

        SET @PaymentModeType = PaymentModeType;

        SET @PaymentModeSQL = 'SELECT `PaymentId` INTO @PaymentId FROM `datafreaks_datawarehouse`.`ModeOfPayment` WHERE `PaymentModeType` = ?';

        PREPARE PaymentModeStmt FROM @PaymentModeSQL;

        EXECUTE PaymentModeStmt USING @PaymentModeType;

        SET PaymentId = @PaymentId;

        call debug_msg(CONCAT("TransactionAmount ==> ",TransactionAmount,";;TransactionQuantity==>",TransactionQuantity,";;OrderId==>",OrderId,";;CatalogProductId==>",CatalogProductId,";;OrderDateId==>",OrderDateId,";;PaymentId==>",PaymentId,";;UserAccountId==>",UserAccountId));

        # Insert the Record in the Fact Table

        START TRANSACTION;

        INSERT INTO `datafreaks_datawarehouse`.`SalesTranaction`(`TransactionAmount`, `TransactionQuantity`, `OrderId`, `CatalogProductId`, `OrderDateId`, `PaymentId`, `UserAccountId`) VALUES (TransactionAmount, TransactionQuantity, OrderId, CatalogProductId, OrderDateId, PaymentId, UserAccountId)
        ON DUPLICATE KEY UPDATE `TransactionAmount` = VALUES(TransactionAmount),`TransactionQuantity` = VALUES(TransactionQuantity),`OrderId` = VALUES(OrderId),`CatalogProductId` = VALUES(CatalogProductId),`OrderDateId` = VALUES(OrderDateId),`PaymentId` = VALUES(PaymentId),`UserAccountId` = VALUES(UserAccountId);

        COMMIT;

        SET sales_trans_rows_left = 1;

      END LOOP;

    END;

    CLOSE sales_transaction_cursor;

    SELECT "END ==> Sales Transaction Processing";

    # Processing Orders Table

    SELECT "START ==> Shopping Cart Processing";

    OPEN shopping_cart_cursor;

    BEGIN

      DECLARE CONTINUE HANDLER FOR NOT FOUND SET shopping_cart_rows_left = 0;

      shopping_cart_loop: LOOP

        FETCH shopping_cart_cursor INTO ShoppingCartId, ShoppingCartStatus, ShoppingCartAmount;

        IF shopping_cart_rows_left = 0 THEN
          LEAVE shopping_cart_loop;
        END IF;

        SET ShoppingCartAmount = (1 + FLOOR(RAND() * 100) * ShoppingCartAmount);

        call debug_msg(CONCAT("ShoppingCartId ==> ",ShoppingCartId,";; ShoppingCartStatus ==> ",ShoppingCartStatus,";; ShoppingCartAmount ==> ",ShoppingCartAmount));

        START TRANSACTION;

        INSERT INTO `datafreaks_datawarehouse`.`ShoppingCart`(`ShoppingCartId`, `ShoppingCartAmount`, `ShoppingCartStatus`) VALUES (ShoppingCartId, ShoppingCartAmount, ShoppingCartStatus)
        ON DUPLICATE KEY UPDATE `ShoppingCartId` = VALUES(ShoppingCartId),`ShoppingCartAmount` = VALUES(ShoppingCartAmount),`ShoppingCartStatus` = VALUES(ShoppingCartStatus);

        COMMIT;

      END LOOP;

    END;

    CLOSE shopping_cart_cursor;

    SELECT "END ==> Shopping Cart Processing";

    # Processing Shopping Cart Items Table

    SELECT "START ==> Shopping Cart Item Processing";

    OPEN shopping_cart_item_cursor;

    BEGIN

      DECLARE CONTINUE HANDLER FOR NOT FOUND SET shopping_cart_items_left = 0;

      shopping_cart_items_loop: LOOP

        FETCH shopping_cart_item_cursor INTO CartItemQuantity, CartItemAmount, CatalogProductId, Name, Category, ShoppingCartId, AccountId;

        IF shopping_cart_items_left = 0 THEN
          LEAVE shopping_cart_items_loop;
        END IF;

        call debug_msg(CONCAT("CartItemQuantity ==> ",CartItemQuantity,";; CartItemAmount ==> ",CartItemAmount,";; CatalogProductId ==> ",CatalogProductId,";; Name ==> ",Name));

        # Find the Catalog Product Id for the Product

        SET @CatalogProductId = CatalogProductId;

        SET @Category = Category;

        SET @Name = Name;

        SET @catalogProductSQL = 'SELECT `CatalogProductId` INTO @CatalogProductId  FROM `datafreaks_datawarehouse`.`CatalogProduct` WHERE `CatalogProductId` = ? AND `Category` = ? AND `Name` = ? LIMIT 1';

        PREPARE catalogProductStmt FROM @catalogProductSQL;

        EXECUTE catalogProductStmt USING @CatalogProductId, @Category, @Name;

        SET CatalogProductId = @CatalogProductId;

        call debug_msg(CONCAT("CatalogProductId ==> ",CatalogProductId));

        #Find the User AccountId from the UserID

        SET @AccountId = AccountId;

        SET @shoppingCartItemSQL = 'SELECT `UserAccountId` INTO @UserAccountId  FROM `datafreaks_datawarehouse`.`UserAccount` WHERE `AccountId` = ?';

        PREPARE shoppingCartItemStmt FROM @shoppingCartItemSQL;

        EXECUTE shoppingCartItemStmt USING @AccountId;

        SET UserAccountId = @UserAccountId;

        call debug_msg(CONCAT("UserAccountId ==> ",UserAccountId));

        START TRANSACTION;

        INSERT INTO `datafreaks_datawarehouse`.`UserShoppingCart`(`CartItemQuantity`, `CartItemAmount`, `UserAccountId`, `ShoppingCartId`, `CatalogProductId`) VALUES (CartItemQuantity, CartItemAmount, UserAccountId, ShoppingCartId, CatalogProductId)
        ON DUPLICATE KEY UPDATE `CartItemQuantity` = VALUES(CartItemQuantity),`CartItemAmount` = VALUES(CartItemAmount),`UserAccountId` = VALUES(UserAccountId),`ShoppingCartId` = VALUES(ShoppingCartId),`CatalogProductId` = VALUES(CatalogProductId);

        COMMIT;

        SET shopping_cart_items_left = 1;

      END LOOP;

    END;

    CLOSE shopping_cart_item_cursor;

    SELECT "END ==> Shopping Cart Item Processing";

  END