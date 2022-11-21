<?php

namespace App\Tests;

use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class ClientUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $client =new Client();

        $client->setNom('nom')
            ->setPrenom('prenom')
            ->setAdresse('adresse')
            ->setCp(59000)
            ->setVille('lille')
            ->setTelephone('telephone')
            ->setEmail('true@test.com')
            ->setRaisonSociale('Raison Sociale');

            $this->assertTrue($client->getNom() === 'nom');
            $this->assertTrue($client->getPrenom() === 'prenom');
            $this->assertTrue($client->getAdresse() === 'adresse');
            $this->assertTrue($client->getCp() === 59000);
            $this->assertTrue($client->getVille() === 'lille');
            $this->assertTrue($client->getTelephone() === 'telephone');
            $this->assertTrue($client->getEmail() === 'true@test.com');
            $this->assertTrue($client->getRaisonSociale() === 'Raison Sociale');
    }

    public function testIsFalse()
    {
        $client =new Client();

        $client->setNom('nom')
        ->setPrenom('prenom')
        ->setAdresse('adresse')
        ->setCp('59000')
        ->setVille('lille')
        ->setTelephone('telephone')
        ->setEmail('true@test.com')
        ->setRaisonSociale('Raison Sociale');

        $this->assertFalse($client->getNom() === 'false');
        $this->assertFalse($client->getPrenom() === 'false');
        $this->assertFalse($client->getAdresse() === 'false');
        $this->assertFalse($client->getCp() === 'false');
        $this->assertFalse($client->getVille() === 'false');
        $this->assertFalse($client->getTelephone() === 'false');
        $this->assertFalse($client->getEmail() === 'false@test.com');
        $this->assertFalse($client->getRaisonSociale() === 'false');
    }

    public function testIsEmpty()
    {
        $client =new Client();

        $client->setNom('')
        ->setPrenom('')
        ->setAdresse('')
        ->setCp(59000)
        ->setVille('')
        ->setTelephone('')
        ->setEmail('')
        ->setRaisonSociale('');
        
        $this->assertEmpty($client->getPrenom());
        $this->assertEmpty($client->getNom());
        $this->assertEmpty($client->getAdresse());
        $this->assertEmpty($client->getCp() === '');
        $this->assertEmpty($client->getVille());
        $this->assertEmpty($client->getTelephone());
        $this->assertEmpty($client->getEmail());
        $this->assertEmpty($client->getRaisonSociale());
    }
}