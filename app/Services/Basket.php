<?php

namespace App\Services;

use App\Product;
use Symfony\Component\HttpFoundation\Session\Session;

class Basket
{

    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getProducts()
    {
        return $this->session->get('basket', []);
    }

    public function add(Product $product, $quantity = 1)
    {
        $products = $this->getProducts();
        if (!array_key_exists($product->id, $products)) {
            $products[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 0
            ];
        }

        $products[$product->id]['quantity'] += $quantity;

        $this->session->set('basket', $products);
        return $this;
    }

    public function updateQuantity($id, $quantity)
    {
        $products = $this->getProducts();
        $products[$id]['quantity'] = $quantity;

        $this->session->set('basket', $products);
        return $this;
    }

    public function remove(Product $product)
    {
        $products = $this->getProducts();
        if (!array_key_exists($product->id, $products)) {
            throw new \Exception(sprintf('Produkt "%s" nie znajduje się w Twoim koszyku', $product->name));
        }

        unset($products[$product->id]);
        $this->session->set('basket', $products);
        return $this;
    }

    public function clear()
    {
        $this->session->remove('basket');
    }

    public function getPrice()
    {
        $price = 0;
        foreach ($this->getProducts() as $product) {
            $price += $product['price'] * $product['quantity'];
        }
        return $price;
    }

    public function getQuantity()
    {
        $quantity = 0;
        foreach ($this->getProducts() as $product) {
            $quantity += $product['quantity'];
        }
        return $quantity;
    }

}