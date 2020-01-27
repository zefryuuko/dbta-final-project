<?php
include_once("../backend/item.php");
include_once("../backend/discount.php");

function generateTableBody($POSTData)
{
    for ($i = 0; $i < count($POSTData["items"]); $i++)
    {
        $item = getItemByID($POSTData["items"][$i])[0];
        $discount = !empty($POSTData["discounts"][$i]) ? getDiscountByID($POSTData["discounts"][$i])[0] : array("discount_name" => "-", "discount_percentage" => "");
        echo "<tr>
                <td>".$item["item_name"]."</td>
                <td>".$item["item_size"]."</td>
                <td>".$discount["discount_name"]." - ".$discount["discount_percentage"]."%</td>
                <td>Rp. ".(intval($item["item_price"]) - intval($item["item_price"]) * intval($discount["discount_percentage"]) / 100)."</td>
            </tr>";
    }
}

function calculateSum($POSTData)
{
    $sum = 0;
    for ($i = 0; $i < count($POSTData["items"]); $i++)
    {
        $item = getItemByID($POSTData["items"][$i])[0];
        $discount = !empty($POSTData["discounts"][$i]) ? getDiscountByID($POSTData["discounts"][$i])[0] : array("discount_name" => "-", "discount_percentage" => "");
        $sum += (intval($item["item_price"]) - intval($item["item_price"]) * intval($discount["discount_percentage"]) / 100);
    }
    echo "<th scope=\"col\" style=\" font-size: 22px; font-weight: bold;\">
            Rp. ".$sum."
          </th>";
}

?>