<?php

namespace App\Models;

use Filament\Panel;
use App\Models\Fixture;
use App\Enums\ScoreType;
use Illuminate\Support\Str;
// use Laravel\Sanctum\HasApiTokens;
// use Laravel\Jetstream\HasProfilePhoto;
use App\Services\ScoreService;
use Filament\Support\Colors\Color;
// use Laravel\Fortify\TwoFactorAuthenticatable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    // use HasApiTokens;
    use HasFactory;
    // use HasProfilePhoto;
    use Notifiable;
    // use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        // 'profile_photo_url',
        'display_name',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->email, [
            'admin@example.com',
            'budfrogfryer@gmail.com',
        ]);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function prediction(Fixture $fixture)
    {
        return $this->predictions()->where('fixture_id', $fixture->id)->first();
    }

    public function getScoreAttribute()
    {
        return resolve(ScoreService::class)->getUserScore($this);
    }

    /**
     * Get the user display_name
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function displayName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->nickname ?? $this->name,
        );
    }

    /**
     * Get the user nickname
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function nickname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => blank($value) ? null : $value,
        );
    }

    /**
     * Get the user display_name
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function predictionState(Fixture $fixture)
    {
        $prediction = $this->prediction($fixture);
        return resolve(ScoreService::class)->getPredictionStatus($prediction);
    }

    /**
     * Get the status of number of predictions
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function predictionStatus(): Attribute
    {
        $count = $this->predictions->count();
        $total = Fixture::count();

        return Attribute::make(
            get: fn ($value) => $count . ' / ' . $total,
        );
    }

    /**
     * Get the status of number of predictions
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function predictionStatusColor(): Attribute
    {
        $count = $this->predictions->count();
        $total = Fixture::count();

        return Attribute::make(
            get: fn ($value) => $count === $total ? Color::Green : Color::Red,
        );
    }

    /**
     * Get the status of number of predictions
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function missingPredictionsCount(): Attribute
    {
        $fixturesToPredict = Fixture::canPredict()->get();

        return Attribute::make(
            get: fn ($value) => $fixturesToPredict->filter(fn ($fixture) => !$fixture->userPrediction)->count(),
        );
    }

    public function getPredictionStatsAttribute()
    {
        $scoreService = new ScoreService();
        return $scoreService->getUserStats($this);
    }

    public function getLeaderboardSortAttribute()
    {
        $stats = $this->prediction_stats;

        return collect([
            Str::padLeft($this->score, 3, '0'),
            Str::padLeft(($stats->get(ScoreType::ExactScore->value)?->count() ?? 0), 2, '0'),
            Str::padLeft(($stats->get(ScoreType::GoalDifference->value)?->count() ?? 0), 2, '0'),
            Str::padLeft(($stats->get(ScoreType::Winner->value)?->count() ?? 0), 2, '0'),
            Str::padLeft(($stats->get(ScoreType::Loser->value)?->count() ?? 0), 2, '0'),
        ])->join('');
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=953044&background=eeeee4';
    }
}
