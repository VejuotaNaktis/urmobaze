<?php
include "./Shops.php";

class ShopsController
{
    public static function index()
    {
        $shops = Shops::all();
        return $shops;
    }

    public static function show()
    {
        $Shops = Shops::find($_POST['id']);
        return $Shops;
    }

    public static function store()
    {
        if (
            empty($_POST['name']) || empty($_POST['sales_field']) || empty($_POST['accepts_card']) ||
            empty($_POST['items_quantity'])
        ) {
            $_SESSION['error'] = "
            fill in the fields";
        } else {
            session_unset();
            Shops::create();
        }
    }

    public static function edit()
    {
    }

    public static function update()
    {
        if (
            empty($_POST['name']) || empty($_POST['sales_field']) || empty($_POST['accepts_card']) ||
            empty($_POST['items_quantity'])
        ) {
            $_SESSION['error'] = "fill in the fields";
        } else {
            session_unset();

            $shop = new Shops();
            $shop->id = $_POST['id'];
            $shop->name = $_POST['name'];
            $shop->sales_field = $_POST['sales_field'];
            $shop->accepts_card = $_POST['accepts_card'];
            $shop->items_quantity = $_POST['items_quantity'];
            $shop->update();
        }
    }
    public static function destroy()
    {

        Shops::destroy($_POST['id']);
    }
}
