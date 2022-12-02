<?php

namespace Jdlcgarcia\Aoc2022\entities;

class RockPaperScissorsGame
{
    private const ROCK = 'A';
    private const PAPER = 'B';
    private const SCISSORS = 'C';

    private const RESPONSE_ROCK = 'X';
    private const RESPONSE_PAPER = 'Y';
    private const RESPONSE_SCISSORS = 'Z';

    private const SCORES = [
        self::ROCK => 1,
        self::PAPER => 2,
        self::SCISSORS => 3,
        self::RESPONSE_ROCK => 1,
        self::RESPONSE_PAPER => 2,
        self::RESPONSE_SCISSORS => 3,
    ];

    private const SCORE_OUTCOME_LOSE = 0;
    private const SCORE_OUTCOME_DRAW = 3;
    private const SCORE_OUTCOME_WIN = 6;

    private int $score = 0;

    public function addGame(string $attack, string $response): int
    {
        $gameScore = self::SCORES[$response];

        if ($this->victory($attack, $response)) {
            $gameScore += self::SCORE_OUTCOME_WIN;
        } elseif ($this->defeat($attack, $response)) {
            $gameScore += self::SCORE_OUTCOME_LOSE;
        } else {
            $gameScore += self::SCORE_OUTCOME_DRAW;
        }

        $this->score += $gameScore;

        return $gameScore;
    }

    private function victory(string $attack, string $response): bool
    {
        return match ($response) {
            self::RESPONSE_ROCK => $attack === self::SCISSORS,
            self::RESPONSE_SCISSORS => $attack === self::PAPER,
            self::RESPONSE_PAPER => $attack === self::ROCK
        };
    }

    private function defeat(string $attack, string $response): bool
    {
        return match ($response) {
            self::RESPONSE_ROCK => $attack === self::PAPER,
            self::RESPONSE_SCISSORS => $attack === self::ROCK,
            self::RESPONSE_PAPER => $attack === self::SCISSORS
        };
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }
}