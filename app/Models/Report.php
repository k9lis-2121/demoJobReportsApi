<?php
/**
 * @OA\Schema(
 *     schema="Report",
 *     required={"worker_id", "start_work", "end_work"},
 *     @OA\Property(
 *         property="id",
 *         description="The report's ID",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="worker_id",
 *         description="The worker's ID associated with the report",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="start_work",
 *         description="The start date and time of the work period",
 *         type="string",
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="end_work",
 *         description="The end date and time of the work period",
 *         type="string",
 *         format="date-time"
 *     )
 * )
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    protected $guarded = [];
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'start_work',
        'end_work'
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public static function scopeByWeek($query, $week)
    {
        $startOfWeek = now()->startOfWeek()->addWeeks(-$week + 1)->format('Y-m-d H:i:s');
        $endOfWeek = now()->endOfWeek()->addWeeks(-$week + 1)->format('Y-m-d H:i:s');

        return $query->whereBetween('start_work', [$startOfWeek, $endOfWeek])->orderBy('start_work', 'desc');;
    }

}
