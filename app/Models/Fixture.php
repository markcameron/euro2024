<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Prediction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fixture extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $appends = [
        'started',
        'goals_home',
        'goals_away',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function userPrediction()
    {
        return $this->hasOne(Prediction::class)->whereUserId(Auth::user()->id);
    }

    public function scopeCanPredict($query)
    {
        return $query->where('can_predict', true);
    }

    public function goals()
    {
        return $this->hasMany(Event::class)
            ->goals()
            ->orderBy('time_elapsed');
    }

    protected function goalsHome(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->events()
                ->where('team_id', $this->home_team_id)
                ->goals()
                ->get(),
        );
    }

    protected function goalsAway(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->events()
                ->where('team_id', $this->away_team_id)
                ->goals()
                ->get(),
        );
    }

    /**
     * Get the Prediction detail URL
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function urlPrediction(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => route('predictions.show', $this->id),
        );
    }

    /**
     * Get the started state of the fixture
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function started(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->date->isBefore(now()),
        );
    }
}
