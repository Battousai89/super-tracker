<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\TimeTrack
 *
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $explanation
 * @property Carbon $date
 * @property Carbon $spent_time
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereUserId($value)
 * @method static Builder|Project whereTaskId($value)
 * @method static Builder|Project whereExplanation($value)
 * @method static Builder|Project whereDate($value)
 * @method static Builder|Project whereSpentTime($value)
 */
class TimeTrack extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'explanation',
        'date',
        'spent_time',
        'user_id',
        'task_id'
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
     * Пользователь
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Задача
     * @return BelongsTo
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
