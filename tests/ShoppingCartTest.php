<?php

use PHPUnit\Framework\TestCase;

class ShoppingCartTest extends TestCase
{
    public function testAddItem(): void
    {
        $cart = new ShoppingCart();
        $item = ['id' => 1, 'name' => 'Item 1', 'price' => 20.5, 'quantity' => 2];

        $cart->addItem($item);

        $this->assertCount(1, $cart->getItems());
        $this->assertEquals($item, $cart->getItems()[1]);
    }

    public function testRemoveItem(): void
    {
        $cart = new ShoppingCart();
        $item = ['id' => 1, 'name' => 'Item 1', 'price' => 20.5, 'quantity' => 2];
        $cart->addItem($item);

        $cart->removeItem($item['id']);

        $this->assertEmpty($cart->getItems());
    }

    public function testCalculateTotal(): void
    {
        $cart = new ShoppingCart();
        $item1 = ['id' => 1, 'name' => 'Item 1', 'price' => 20.5, 'quantity' => 2];
        $item2 = ['id' => 2, 'name' => 'Item 2', 'price' => 10.0, 'quantity' => 1];
        $cart->addItem($item1);
        $cart->addItem($item2);

        $expectedTotal = $item1['price'] * $item1['quantity'] + $item2['price'] * $item2['quantity'];

        $this->assertEquals($expectedTotal, $cart->calculateTotal());
    }

    public function testAddItemIncrementsQuantity(): void
    {
        $cart = new ShoppingCart();
        $item = ['id' => 1, 'name' => 'Item 1', 'price' => 20.5, 'quantity' => 2];
        $cart->addItem($item);

        // Adding the same item again should increment the quantity
        $cart->addItem($item);

        // Assert that the quantity is incremented
        $this->assertEquals(4, $cart->getItems()[1]['quantity']);
    }

    public function testAddItemWithExistingIdUpdatesQuantity(): void
    {
        $cart = new ShoppingCart();
        $item1 = ['id' => 1, 'name' => 'Item 1', 'price' => 20.5, 'quantity' => 2];
        $item2 = ['id' => 1, 'name' => 'Item 1', 'price' => 20.5, 'quantity' => 3];
        $cart->addItem($item1);

        // Adding an item with the same ID should update the quantity
        $cart->addItem($item2);

        // Assert that the quantity is updated
        $this->assertEquals(5, $cart->getItems()[1]['quantity']);
    }

    public function testRemoveNonExistingItem(): void
    {
        $cart = new ShoppingCart();
        $item = ['id' => 1, 'name' => 'Item 1', 'price' => 20.5, 'quantity' => 2];
        $cart->addItem($item);

        // Try to remove a non-existing item
        $cart->removeItem(2);

        // Assert that the item is still in the cart
        $this->assertCount(1, $cart->getItems());
    }

    public function testCalculateTotalWithEmptyCart(): void
    {
        $cart = new ShoppingCart();

        // Assert that the total is 0 when the cart is empty
        $this->assertEquals(0.0, $cart->calculateTotal());
    }
}
