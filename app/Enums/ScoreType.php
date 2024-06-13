<?php

namespace App\Enums;

enum ScoreType: string
{
    case ExactScore = 'exact_score';
    case GoalDifference = 'goal_difference';
    case Winner = 'winner';
    case Loser = 'loser';

    public function icon(): string
    {
        return match ($this) {
            self::ExactScore => 'heroicon-o-hand-thumb-up',
            self::GoalDifference => 'heroicon-o-face-smile',
            self::Winner => 'heroicon-o-face-frown',
            self::Loser => 'heroicon-o-hand-thumb-down',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::ExactScore => 'text-euro-lightest',
            self::GoalDifference => 'text-euro',
            self::Winner => 'text-euro',
            self::Loser => 'text-euro-dark',
        };
    }
}
