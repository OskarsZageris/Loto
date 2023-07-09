<?php
/*
function shippingCost($order) {
$totalWeight = 0;
    foreach ($order as $item) {
        $totalWeight += $item['weight'] * $item['quantity'];
    }
    if ($totalWeight < 1) {
        $shippingCost = 5;
        echo "<p>Your shipping cost is $shippingCost</p>";
    } else if ($totalWeight < 5) {
        $shippingCost = 10;
        echo "<p>Your shipping cost is $shippingCost</p>";
    } else if ($totalWeight < 20) {
        $shippingCost = 20;
        echo "<p>Your shipping cost is $shippingCost</p>";
    } else {
        $shippingCost = 50;
        echo "<p>Your shipping cost is $shippingCost</p>";
    }
    $orderTotal = 0;
    foreach ($order as $item) {
        $orderTotal += $item['price'] * $item['quantity'];
    }
    echo "<p>Your order total is $orderTotal</p>";
    echo "<p>Your total cost with shipping is " . ($orderTotal + $shippingCost) . "</p>";
}

The task here is to refactor this function to separate the calculation logic from the output formatting.
*/

class OrderProcessor {
    private const WEIGHT_LIMIT_1 = 1;
    private const WEIGHT_LIMIT_2 = 5;
    private const WEIGHT_LIMIT_3 = 20;
    private const COST_LIMIT_1 = 5;
    private const COST_LIMIT_2 = 10;
    private const COST_LIMIT_3 = 20;
    private const MAX_COST = 50;

    public function calculateShippingCost(array $order): int {
        $totalWeight = 0;
        foreach ($order as $item) {
            $totalWeight += $item['weight'] * $item['quantity'];
        }
        if ($totalWeight < self::WEIGHT_LIMIT_1) {
            $shippingCost = self::COST_LIMIT_1;
        } else if ($totalWeight < self::WEIGHT_LIMIT_2) {
            $shippingCost = self::COST_LIMIT_2;
        } else if ($totalWeight < self::WEIGHT_LIMIT_3) {
            $shippingCost = self::COST_LIMIT_3;
        } else {
            $shippingCost = self::MAX_COST;
        }
        return $shippingCost;
    }

    public function calculateOrderTotal(array $order): float {
        $orderTotal = 0;
        foreach ($order as $item) {
            $orderTotal += $item['price'] * $item['quantity'];
        }
        return $orderTotal;
    }

    public function processOrder(array $order): void {
        $shippingCost = $this->calculateShippingCost($order);
        $orderTotal = $this->calculateOrderTotal($order);
        $totalCost = $orderTotal + $shippingCost;
        $this->generateHTML($shippingCost, $orderTotal, $totalCost);
    }

//here data can be sent to html template and used there
    public function generateHTML(int $shippingCost, float $orderTotal, float $totalCost): void {
        echo "<p>Your shipping cost is $shippingCost</p>".PHP_EOL;
        echo "<p>Your order total is $orderTotal</p>".PHP_EOL;
        echo "<p>Your total cost with shipping is $totalCost</p>".PHP_EOL;
    }
}
//dummy test data
$orderProcessor = new OrderProcessor();
$order = [
    [
        'weight' => 2.5,
        'quantity' => 2,
        'price' => 10.0
    ],
    [
        'weight' => 1.0,
        'quantity' => 1,
        'price' => 20.0
    ],
    [
        'weight' => 5.0,
        'quantity' => 1,
        'price' => 30.0
    ]
];

$orderProcessor->processOrder($order);
/*
Output:
<p>Your shipping cost is 20</p>
<p>Your order total is 70</p>
<p>Your total cost with shipping is 90</p>
*/