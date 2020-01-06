<?php
include_once("../backend/item.php");
include_once("../backend/discount.php");

function generateTableBody($POSTData)
{
    for ($i = 0; $i < count($POSTData["items"]); $i++)
    {
        $item = getItemByID($POSTData["items"][$i])[0];
        $discount = !empty($POSTData["discount"][$i]) ? getDiscountByID($POSTData["discount"][$i])[0] : array("discount_name" => "-", "discount_percentage" => "");
        echo "<tr>
                <td>".$item["item_name"]."</td>
                <td>".$item["item_size"]."</td>
                <td>".$discount["discount_name"]." ".$discount["discount_percentage"]."</td>
                <td>Rp. ".$item["item_price"]."</td>
            </tr>";
    }
}

?>