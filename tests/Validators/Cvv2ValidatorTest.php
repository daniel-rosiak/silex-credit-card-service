<?php
namespace Tests\Validators;

use App\Validators\Cvv2Validator;


class Cvv2ValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new Cvv2Validator();
    }

    public function testPositive()
    {
        $this->assertEquals(true, $this->validator->validate('1532'));
        $this->assertEquals(true, $this->validator->validate('457'));
        $this->assertEquals(true, $this->validator->validate('456'));
    }

    public function testNegative()
    {
        $this->assertEquals(false, $this->validator->validate('131232'));
        $this->assertEquals(false, $this->validator->validate('asdasd'));
        $this->assertEquals(false, $this->validator->validate('12'));
    }

}