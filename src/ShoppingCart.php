<?php


class ShoppingCart {
    private array $items;

    public function __construct() {
        $this->items = array();
    }

    public function addItem(array $item): void {
        if (isset($this->items[$item['id']])) {
            $this->items[$item['id']]['quantity'] += $item['quantity'];
        } else {
            $this->items[$item['id']] = $item;
        }
    }

    public function removeItem(int $itemId): void {
        if (isset($this->items[$itemId])) {
            unset($this->items[$itemId]);
        }
    }

    public function calculateTotal(): float {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}