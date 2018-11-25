<?php
namespace Tests\Validators;

use App\Validators\DateValidator;


class DateValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new DateValidator();
    }

    public function testPositive()
    {
        $this->assertEquals(true, $this->validator->validate('12-45'));
        $this->assertEquals(true, $this->validator->validate('10-18'));
        $this->assertEquals(true, $this->validator->validate('10-19', ['min_date' => new \DateTime()]));
    }

    public function testNegative()
    {
        $this->assertEquals(false, $this->validator->validate('13-18'));
        $this->assertEquals(false, $this->validator->validate('12/18'));
        $this->assertEquals(false, $this->validator->validate('2016-12'));
        $this->assertEquals(false, $this->validator->validate('10-16', ['min_date' => new \DateTime()]));
        $this->assertEquals(false, $this->validator->validate('asdasd'));
    }

}