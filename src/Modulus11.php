<?php
declare(strict_types=1);

namespace Tervis\Algorithms;

/**
 * @author Mika Tervonen <mtervonen80@gmail.com>
 */
class Modulus11
{
    private const FACTORS = [2, 3, 4, 5, 6, 7];

    public static function validate(int|string $number, ?array $factors = null): bool
    {
        $number = (string)$number;
        list($partialNumber, $checkDigit) = str_split($number, strlen($number) - 1);

        return static::getChecksum($partialNumber, $factors) == $checkDigit;
    }

    /**
     * @param int|string $number
     * @param array|null $factors
     * @return string
     */
    private static function getChecksum(int|string $number, ?array $factors = null): string
    {
        $factors = $factors ? array_map('intval', $factors) : self::FACTORS;
        $number = preg_replace('/[^\wX]/', '', strtoupper((string)$number));
        $parts = array_reverse(str_split($number));
        $parts = array_map('intval', $parts);
        $sum = 0;
        for ($i = 0; $i < count($parts); $i++) {
            $factor = $factors[$i % count($factors)];
            $sum += ($parts[$i] * $factor);
        }

        $calculus = 11 - $sum % 11;

        return match ($calculus) {
            10 => 'X',
            default => (string)$calculus,
        };
    }

    public static function calculate(int|string $partial_number, ?array $factors = null): string
    {
        return static::getChecksum($partial_number, $factors);
    }

    public static function create($partial_number, ?array $factors = null): string
    {
        return $partial_number . static::getChecksum($partial_number, $factors);
    }
}