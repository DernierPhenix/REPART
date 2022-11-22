<?php

namespace App\Tests;

use App\Entity\SousCategorie;
use PHPUnit\Framework\TestCase;

class SousCategorieUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $souscategorie =new SousCategorie();

        $souscategorie->setNom('nom');

        $this->assertTrue($souscategorie->getNom() === 'nom');


        
    }

    public function testIsFalse()
    {
        $souscategorie =new SousCategorie();

        $souscategorie->setNom('nom');

        $this->assertFalse($souscategorie->getNom() === 'false');

        
    }

    public function testIsEmpty()
    {
    $souscategorie =new SousCategorie();

    $souscategorie->setNom('');

    $this->assertEmpty($souscategorie->getNom());

    }
}