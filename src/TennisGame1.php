<?php

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    private int $player1Points = 0;
    private int $player2Points = 0;

    public function __construct(private string $player1Name, private string $player2Name)
    {
    }

    public function wonPoint(string $playerName): void
    {
        if ($this->player1Name == $playerName) {
            $this->player1Points++;
        } else {
            $this->player2Points++;
        }
    }

    public function getScore(): string
    {
        if ($this->player1Points === $this->player2Points) {
            return $this->getEqualScore();
        } elseif ($this->player1Points >= 4 || $this->player2Points >= 4) {
            return $this->getScoreForMoreThanThreePoints();
        }

        return $this->countScore();
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

    private function countScore(): string
    {
        $score = '';
        for ($i = 1; $i < 3; $i++) {
            if ($i == 1) {
                $tempScore = $this->player1Points;
            } else {
                $score .= "-";
                $tempScore = $this->player2Points;
            }
            switch ($tempScore) {
                case 0:
                    $score .= "Love";
                    break;
                case 1:
                    $score .= "Fifteen";
                    break;
                case 2:
                    $score .= "Thirty";
                    break;
                case 3:
                    $score .= "Forty";
                    break;
            }
        }

        return $score;
    }
}
