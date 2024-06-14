<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon $time_estimate
 * @property ?int $user_id
 * @property int $project_id
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereName($value)
 * @method static Builder|Project whereDescription($value)
 * @method static Builder|Project whereTimeEstimate($value)
 * @method static Builder|Project whereUserId($value)
 * @method static Builder|Project whereProjectId($value)
 */
class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'time_estimate',
        'project_id',
        'user_id'
    ];

    /**
     * timestamps
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Проект
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Исполнитель
     * @return BelongsTo
     */
    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Треки времени
     * @return HasMany
     */
    public function tracks(): HasMany
    {
        return $this->hasMany(TimeTrack::class);
    }
}
