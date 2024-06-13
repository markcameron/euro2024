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
            self::ExactScore => 'heroicon-o-check-badge',
            self::GoalDifference => 'heroicon-o-arrows-right-left',
            self::Winner => 'heroicon-o-academic-cap',
            self::Loser => 'heroicon-o-x-mark',
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
