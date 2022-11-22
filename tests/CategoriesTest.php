<?php

namespace App\Tests;

use App\Entity\Categories;
use PHPUnit\Framework\TestCase;

class CategoriesTest extends TestCase
{
    public function testIsTrue()
    {
        $categories =new Categories();

        $categories->setNom('nom')
            ->setImage('image');


        $this->assertTrue($categories->getNom() === 'nom');
        $this->assertTrue($categories->getImage() === 'image');


        
    }

    public function testIsFalse()
    {
        $categories =new Categories();

        $categories->setNom('nom')
            ->setImage('image');


        $this->assertFalse($categories->getNom() === 'false');
        $this->assertFalse($categories->getImage() === 'false');

        
    }

    public function testIsEmpty()
    {
    $categories =new Categories();

    $categories->setNom('')
        ->setImage('');

    $this->assertEmpty($categories->getNom());
    $this->assertEmpty($categories->getImage());
    }
}