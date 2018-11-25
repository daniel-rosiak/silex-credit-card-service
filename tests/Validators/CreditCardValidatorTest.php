<?php
namespace Tests\Validators;

use App\Validators\CreditCardValidator;


class CreditCardValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new CreditCardValidator();
    }

    public function testPositive()
    {
        $this->assertEquals(true, $this->validator->validate('49927398716'));
        $this->assertEquals(true, $this->validator->validate('4111111111111111'));
    }

    public function testNegative()
    {
        $this->assertEquals(false, $this->validator->validate('49927398717'));
        $this->assertEquals(false, $this->validator->validate('4111111111111112'));
        $this->assertEquals(false, $this->validator->validate('sadasdad'));
    }

}