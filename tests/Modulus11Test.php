<?php
declare(strict_types=1);

namespace Tervis\Algorithms\Tests;

use PHPUnit\Framework\TestCase;
use Tervis\Algorithms\Modulus11;

/**
 * @author Mika Tervonen <mtervonen80@gmail.com>
 */
class Modulus11Test extends TestCase
{
    protected $withCheckDigit1 = '1234.56.78903';
    protected $withoutCheckDigit1 = '1234.56.7890';
    protected $theCheckDigit1 = '3';

    protected $withCheckDigit2 = '036522X';
    protected $withoutCheckDigit2 = '036522';
    protected $theCheckDigit2 = 'X';

    public function testValidate()
    {
        $this->assertTrue(Modulus11::validate($this->withCheckDigit1));
        $this->assertTrue(Modulus11::validate($this->withCheckDigit2));
    }

    public function testCalculate()
    {
        $this->assertSame($this->theCheckDigit1, Modulus11::calculate($this->withoutCheckDigit1));
        $this->assertSame($this->theCheckDigit2, Modulus11::calculate($this->withoutCheckDigit2));
    }

    public function testAppendCheckDigit()
    {
        $appended = Modulus11::create($this->withoutCheckDigit1);
        $this->assertSame($this->withoutCheckDigit1 . $this->theCheckDigit1, $appended);
        $this->assertTrue(Modulus11::validate($appended));

        $appended = Modulus11::create($this->withoutCheckDigit2);
        $this->assertSame($this->withoutCheckDigit2 . $this->theCheckDigit2, $appended);
        $this->assertTrue(Modulus11::validate($appended));
    }

    public function testCustomFactors()
    {
        $this->assertTrue(Modulus11::validate('11223346'));
        $this->assertTrue(Modulus11::validate('1705833214', [2, 5, 4, 9, 8, 1, 6, 7, 3]));
        $this->assertTrue(Modulus11::validate('1705833214', ['2', '5', '4', '9', '8', '1', '6', '7', '3']));
        $this->assertSame('3', Modulus11::calculate('1705833214'));
    }
}