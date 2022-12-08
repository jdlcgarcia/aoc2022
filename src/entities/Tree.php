<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Tree
{
    private int $height;
    private bool $visible;
    private int $scenicScore = 0;

    /**
     * @param int $height
     */
    public function __construct(int $height)
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @param bool $visible
     */
    public function setVisible(bool $visible): void
    {
        $this->visible = $visible;
    }

    /**
     * @return int
     */
    public function getScenicScore(): int
    {
        return $this->scenicScore;
    }

    /**
     * @param int $scenicScore
     */
    public function setScenicScore(int $scenicScore): void
    {
        $this->scenicScore = $scenicScore;
    }
}