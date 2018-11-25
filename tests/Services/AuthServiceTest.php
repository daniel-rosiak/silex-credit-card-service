<?php
namespace Tests\Services;

use Silex\Application;
use App\Services\AuthService;


class AuthServiceTest extends \PHPUnit_Framework_TestCase
{
    private $service;

    public function setUp()
    {
        $app = new Application();
        require __DIR__ . '/../../resources/config/dev.php';
        $this->service = new AuthService($app["api.key"]);
    }

    public function testCreateSignature()
    {
        $this->assertEquals('d56fd2f7494a28074ab1cb1dc4a72d33c9157fb6', $this->service->createSignature([], 1485099591));

        $this->assertNotEquals('gfgfg', $this->service->createSignature([], 1485099591));
    }

}