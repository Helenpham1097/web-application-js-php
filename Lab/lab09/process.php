<?php
session_start();

$action = $_GET["action"];
$name = $_GET["name"];
$ISBN = $_GET["ISBN"];
$price = $_GET["price"];

if ($action == "Add")
{
    addBook($name, $ISBN, $price);
}
else
{
    removeBook($name, $ISBN, $price);
}

function addBook($name, $ISBN, $price)
{
    if (array_key_exists("cart-".$ISBN, $_SESSION))
    {
        $cart = $_SESSION["cart-".$ISBN];
        $cart["price"] += $price;
        $_SESSION["cart-".$ISBN] = $cart;
    }
    else
    {
        $_SESSION["cart-".$ISBN] = array("name" => $name, "price" => $price, "ISBN" => $ISBN);
    }

    echo json_encode($_SESSION["cart-".$ISBN]);
}

function removeBook($name, $ISBN, $price)
{
    if (array_key_exists("cart-".$ISBN, $_SESSION))
    {
        $cart = $_SESSION["cart-".$ISBN];
        $cart["price"] -= $price;
        $_SESSION["cart-".$ISBN] = $cart;

        if ($_SESSION["cart-".$ISBN]["price"] <= 0)
        {
            unset($_SESSION["cart-".$ISBN]);
        }

        echo json_encode($cart);
    }
}
?>