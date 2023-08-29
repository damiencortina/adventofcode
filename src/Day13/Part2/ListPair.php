<?php

declare(strict_types=1);

namespace Day13\Part2;

class ListPair
{
    public function __construct(
        private readonly array $left,
        private readonly array $right
    )
    {
    }

    public function inputsAreInTheRightOrder(): ?bool
    {
        foreach ($this->left as $key => $left) {
            if (!array_key_exists($key, $this->right)) {
                return false;
            }
            $right = $this->right[$key];
            if ($left !== $right) {
                if (is_int($left) && is_int($right)) {
                    return (new IntegerPair($left, $right))->inputsAreInTheRightOrder();
                } else {
                    $isRightOrder = (new ListPair((array)$left, (array)$right))->inputsAreInTheRightOrder();
                    if (is_bool($isRightOrder)) {
                        return $isRightOrder;
                    }
                }
            }
        }
        if (count($this->right) === count($this->left)) {
            // In case the pair study did not reveal anything special
            // Null allows inspection of the parent pair to continue
            // (no impact with test data, but it changes the result with the default ones)
            return null;
        } else {
            return true;
        }
    }
}
