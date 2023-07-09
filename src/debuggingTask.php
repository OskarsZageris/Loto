<?php
/*
class ShoppingCart {
    private $items;

    function __construct() {
        $this->items = array();
    }

    function addItem($item) {
        $this->items[$item["id"]] = $item;
    }

    function removeItem($itemId) {
        unset($this->items[$itemId]);
    }

    function calculateTotal() {
        $total = 0;
        foreach($this->items as $item) {
            $total += $item["price"];
        }
        echo "Total: $total";
    }

    function checkout() {
        $this->calculateTotal();
        $this->items = array();
    }
}

$cart = new ShoppingCart();
$cart->addItem(array("id" => 1, "name" => "Item 1", "price" => 20.5));
$cart->addItem(array("id" => 2, "name" => "Item 2", "price" => 10.0));
$cart->removeItem(3);
$cart->checkout();

Task is to debug following code, fix found bugs and provide example report on fixed issue
*/

class ShoppingCart2 {
    private array $items;

    public function __construct(array $items = []) {
        $this->items = $items;
    }

    public function addItem(array $item): void {
        $this->items[$item["id"]] = $item;
    }

    public function removeItem(int $itemId): void {
        if (isset($this->items[$itemId])) {
            unset($this->items[$itemId]);
            echo "Item with ID $itemId removed successfully." . PHP_EOL;
        } else {
            //here you can throw exception, if needed.
            echo "Item with ID $itemId not found in the cart." . PHP_EOL;
        }
    }

    public function calculateTotal(): float {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item["price"];
        }
        return $total;
    }

    public function checkout(): void {
        $total = $this->calculateTotal();
        echo "Total: $total" . PHP_EOL;
        $this->items = array();
    }
    public function getItems(): array {
        return $this->items;
    }

    public function setItems(array $items): void {
        $this->items = $items;
    }
}

$cart = new ShoppingCart2();
$cart->addItem(array("id" => 1, "name" => "Item 1", "price" => 20.5));
$cart->addItem(array("id" => 2, "name" => "Item 2", "price" => 10.0));
$cart->removeItem(3);
$cart->checkout();
/*
Bugs I have found:
removeItem method does not check if the item exists before attempting to remove it.
calculateTotal method does not return the calculated total, it directly echoes the result, so data can't be retrieved.
removeItem method has no feedback or information provided to indicate that the removal was successful.
missing typehints
$items is private, so need to add getItems and setItems methods to provide controlled access.
More of an improvement the constructor now accepts an optional $items parameter of type array,
allows you to initialize the cart with existing items if needed.
*/