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

    private const ROUND_END_LOSE = 'X';
    private const ROUND_END_DRAW = 'Y';
    private const ROUND_END_WIN = 'Z';

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

    private int $scoreA = 0;
    private int $scoreB = 0;

    public function addGame(string $attack, string $response): void
    {
        $this->calculateScoreA($attack, $response, self::SCORES[$response]);
        $this->calculateScoreB($attack, $response);
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
    public function getScoreA(): int
    {
        return $this->scoreA;
    }

    /**
     * @param string $attack
     * @param string $response
     * @param int $baseScore
     */
    public function calculateScoreA(string $attack, string $response, int $baseScore): void
    {
        if ($this->victory($attack, $response)) {
            $this->scoreA += $baseScore + self::SCORE_OUTCOME_WIN;
        } elseif ($this->defeat($attack, $response)) {
            $this->scoreA += $baseScore + self::SCORE_OUTCOME_LOSE;
        } else {
            $this->scoreA += $baseScore + self::SCORE_OUTCOME_DRAW;
        }
    }

    private function calculateScoreB(string $attack, string $result): void
    {
        $this->scoreB += match ($result) {
            self::ROUND_END_LOSE => self::SCORE_OUTCOME_LOSE + self::SCORES[$this->findLoser($attack)],
            self::ROUND_END_DRAW => self::SCORE_OUTCOME_DRAW + self::SCORES[$attack],
            self::ROUND_END_WIN => self::SCORE_OUTCOME_WIN + self::SCORES[$this->findWinner($attack)],
        };
    }

    private function findLoser(string $attack): string
    {
        return match ($attack) {
            self::ROCK => self::SCISSORS,
            self::PAPER => self::ROCK,
            self::SCISSORS => self::PAPER
        };
    }

    private function findWinner(string $attack): string
    {
        return match ($attack) {
            self::SCISSORS => self::ROCK,
            self::ROCK => self::PAPER,
            self::PAPER => self::SCISSORS,
        };
    }

    /**
     * @return int
     */
    public function getScoreB(): int
    {
        return $this->scoreB;
    }
}