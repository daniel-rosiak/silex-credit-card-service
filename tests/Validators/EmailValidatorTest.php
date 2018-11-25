<?php
namespace Tests\Validators;

use App\Validators\EmailValidator;


class EmailValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new EmailValidator();
    }

    public function testPositive()
    {
        $this->assertEquals(true, $this->validator->validate('danielrosiak@gmail.com'));
        $this->assertEquals(true, $this->validator->validate('test@test.pl'));
    }

    public function testNegative()
    {
        $this->assertEquals(false, $this->validator->validate('test@test@test.pl'));
        $this->assertEquals(false, $this->validator->validate('dasd.adada@gmail'));
        $this->assertEquals(false, $this->validator->validate('dasdadada'));
        $this->assertEquals(false, $this->validator->validate('213114234'));
    }

}