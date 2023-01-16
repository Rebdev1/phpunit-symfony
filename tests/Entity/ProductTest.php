<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /*
     * Let's say that the business logic we want to enforce is:
     *  - itemReference (ITMREF) should start with the 3 first char of the itemCategory
     */

    public function testSetItemReferenceUseItemCategory(): void
    {
        // Setup
        $product = new Product();
        $product->setItemCategory('PAA');

        // Do something
        $product->setItemReference('0001');

        // Make assertions
        self::assertEquals('PAA0001', $product->getItemReference());
    }

    public function testSetItemReferenceOnlyUseTheFirst3CharactersOfItemCategory(): void
    {
        // Setup
        $product = new Product();
        $product->setItemCategory('ABCDE');

        // Do something
        $product->setItemReference('0001');

        // Make assertions
        self::assertEquals('ABC0001', $product->getItemReference());
    }

    public function testSetItemReferenceShouldThrowAnErrorWhenItemCategoryIsEmpty(): void
    {
        // Setup
        $product = new Product();

        // Expect something when...
        $this->expectError();
        $this->expectErrorMessage('itemCategory property must be defined to set the itemReference property.');

        // doing this
        $product->setItemReference('0001');
    }
}