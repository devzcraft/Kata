<?php

namespace TennisGame;

class TennisGame3 implements TennisGame
{
    private int $player2Point = 0;
    private int $player1Point = 0;
    private const PLAYER_POINTS = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty',
    ];
    private const EQUAL_POINTS_SCORE = [
        0 => 'Love-All',
        1 => 'Fifteen-All',
        2 => 'Thirty-All',
        3 => 'Deuce',
    ];
    private const THRESHOLD = 3;

    public function __construct(private string $player1Name, private string $player2Name)
    {
    }

    public function getScore(): string
    {
        if ($this->arePointsEqual($this->player1Point, $this->player2Point)) {
            return $this->getEqualScore($this->player1Point);
        }

        if ($this->player1Point < 4 && $this->player2Point < 4) {

            $player1PointName = $this->getPlayerPoint($this->player1Point);
            $player2PointName = $this->getPlayerPoint($this->player2Point);

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

    private function getPlayerPoint(int $playersPoints): string
    {
        return $playersPoints < self::THRESHOLD
            ? self::PLAYER_POINTS[$playersPoints]
            : self::PLAYER_POINTS[self::THRESHOLD];
    }

    private function getEqualScore(int $playerPoint): string
    {
        return $playerPoint < self::THRESHOLD
            ? self::EQUAL_POINTS_SCORE[$playerPoint]
            : self::EQUAL_POINTS_SCORE[self::THRESHOLD];
    }

    private function arePointsEqual(int $player1Point, int $player2Point): bool
    {
        return $player1Point === $player2Point;
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
