<?php
namespace Tests\Validators;

use App\Validators\PhoneValidator;


class PhoneValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new PhoneValidator();
    }

    public function testPositive()
    {
        $this->assertEquals(true, $this->validator->validate('123456789'));
        $this->assertEquals(true, $this->validator->validate('12313213232'));
        $this->assertEquals(true, $this->validator->validate('(+48)132456789'));
    }

    public function testNegative()
    {
        $this->assertEquals(false, $this->validator->validate('123132132321'));
        $this->assertEquals(false, $this->validator->validate('23213213213232'));
        $this->assertEquals(false, $this->validator->validate('ewrewrwer'));
    }

}