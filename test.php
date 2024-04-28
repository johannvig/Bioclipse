<?php

/*
Injection SQL

Page Connection
Adresse Email : ' OR '1'='1' ou 'test' OR '1'='1'--@example.com'
Mot de Passe : (peut être n'importe quoi)

Page registration

*/


require 'vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/*
1- Installer Composer:  getcomposer.org
2- Initialiser Composer dans votre Projet: composer init
3- Installer PHPUnit: composer require --dev phpunit/phpunit
4- Installer GuzzleHttp: composer require guzzlehttp/guzzle
6- Exécuter les Tests dans le terminal: ./vendor/bin/phpunit test.php
*/

class RegistrationTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        // Création d'un client GuzzleHttp pour simuler un navigateur
        $this->client = new Client([
            'base_uri' => 'http://localhost', // Remplacez par l'URL de base de votre application XAMPP
            'http_errors' => false, // Pour ne pas lancer d'exceptions sur les codes d'erreur HTTP
        ]);
    }

    public function testEmptyFields()
    {
        try {
            $response = $this->client->request('POST', '/SAE3/lib/database/registration.php', [
                'form_params' => [
                    'name' => '',
                    'surname' => '',
                    'email' => '',
                    // Ajoutez tous les champs requis ici
                ]
            ]);

            $this->assertStringContainsString('Veuillez remplir tous les champs', $response->getBody());
        } catch (RequestException $e) {
            $this->fail("Exception lors de l'envoi de la requête : " . $e->getMessage());
        }
    }

    public function testInvalidEmail()
    {
        try {
            $response = $this->client->request('POST', '/SAE3/lib/database/registration.php', [
                'form_params' => [
                    'email' => 'invalidemail',
                    // Complétez avec les autres champs valides
                ]
            ]);

            $this->assertStringContainsString('email invalide', $response->getBody());
        } catch (RequestException $e) {
            $this->fail("Exception lors de l'envoi de la requête : " . $e->getMessage());
        }
    }

    public function testSuccessfulRegistration()
    {
        try {
            $response = $this->client->request('POST', '/SAE3/lib/database/registration.php', [
                'form_params' => [
                    'name' => 'John',
                    'surname' => 'Doe',
                    'email' => 'john.doe@example.com',
                    // Complétez avec les autres champs valides
                ]
            ]);

            $this->assertStringContainsString('Inscription réussie', $response->getBody());
        } catch (RequestException $e) {
            $this->fail("Exception lors de l'envoi de la requête : " . $e->getMessage());
        }
    }

    // Ajoutez d'autres méthodes de test si nécessaire
}
