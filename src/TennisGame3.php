<?php

namespace TennisGame;

class TennisGame3 implements TennisGame
{
    private int $player2Point = 0;
    private int $player1Point = 0;

    public function __construct(private string $player1Name, private string $player2Name)
    {
    }

    public function getScore(): string
    {
        if ($this->arePointsEqual()) {
            return $this->getEqualScore();
        }

        if ($this->player1Point < 4 && $this->player2Point < 4) {

            $player1PointName = $this->getPlayerScore($this->player1Point);
            $player2PointName = $this->getPlayerScore($this->player2Point);

            return "{$player1PointName}-{$player2PointName}";
        }

        $leader = $this->playerIsWinning();

        return $this->isGameOver()
            ? "Win for {$leader}"
            : "Advantage {$leader}";
    }

    private function isGameOver(): bool
    {
        return ($this->player1Point - $this->player2Point) * ($this->player1Point - $this->player2Point) !== 1;
    }

    private function playerIsWinning(): string
    {
        return $this->player1Point > $this->player2Point ? $this->player1Name : $this->player2Name;
    }

    private function getPlayerScore(int $playersPoints): string
    {
        return match ($playersPoints) {
            0 => 'Love',
            1 => 'Fifteen',
            2 => 'Thirty',
            default => 'Forty',
        };
    }

    private function getEqualScore(): string
    {
        return match ($this->player1Point) {
            0 => "Love-All",
            1 => "Fifteen-All",
            2 => "Thirty-All",
            default => "Deuce",
        };
    }

    private function arePointsEqual(): bool
    {
        return $this->player1Point === $this->player2Point;
    }


    public function wonPoint(string $playerName): void
    {
        if ($playerName === $this->player1Name) {
            $this->player1Point++;
        } else {
            $this->player2Point++;
        }
    }

}
