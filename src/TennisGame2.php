<?php

namespace TennisGame;

class TennisGame2 implements TennisGame
{
    private int $player1Points = 0;
    private int $player2Points = 0;

    public function __construct(private string $player1Name, private string $player2Name)
    {
    }

    public function getScore(): string
    {

        if ($this->player1Points === $this->player2Points) {
            return $this->getEqualScore();
        }

        if ($this->player1Points >= 4 || $this->player2Points >= 4) {
            return $this->getScoreForMoreThanThreePoints();
        }

        $player1Result = $this->getPlayerScore($this->player1Points);
        $player2Result = $this->getPlayerScore($this->player2Points);

        return "{$player1Result}-{$player2Result}";
    }

    private function getEqualScore(): string
    {
        return match ($this->player1Points) {
            0 => "Love-All",
            1 => "Fifteen-All",
            2 => "Thirty-All",
            default => "Deuce",
        };
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

    private function getScoreForMoreThanThreePoints(): string
    {
        $minusResult = $this->player1Points - $this->player2Points;

        if ($minusResult === 1) {
            return 'Advantage ' . $this->player1Name;
        } elseif ($minusResult === -1) {
            return 'Advantage ' . $this->player2Name;
        } elseif ($minusResult >= 2) {
            return 'Win for ' . $this->player1Name;
        }

        return 'Win for ' . $this->player2Name;
    }
    private function player1Won(): void
    {
        $this->player1Points++;
    }

    private function player2Won(): void
    {
        $this->player2Points++;
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === $this->player1Name) {
            $this->player1Won();
        } else {
            $this->player2Won();
        }
    }
}
