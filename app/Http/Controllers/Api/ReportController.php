<?php
/**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportStoreRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $week = $request->query('week', 1);
        $reports = Report::byWeek($week)
            ->with('worker:id,name')
            ->select('*', DB::raw('(TIMESTAMPDIFF(hour, start_work, end_work)) AS hours_worked'))
            ->paginate(100);
        $work_start = '2022-01-01';
        return view('reports.index', compact('reports', 'week', 'work_start'));
    }

    /**
     * @OA\Post(
     *     path="/api/reports",
     *     summary="Create a new report",
     *     description="Store a newly created resource in storage.",
     *     tags={"Reports"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="worker_id", type="string"),
     *             @OA\Property(property="start_work", type="string"),
     *             @OA\Property(property="end_work", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Report successfully updated",
     *         @OA\JsonContent(ref="#/components/schemas/ReportResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Report not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     )
     * )
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportStoreRequest $request)
    {
        $created_report = Report::create($request->validated());

        return new ReportResource($created_report);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $workerId)
    {
        $week = $request->query('week', 1);
        $reports = Report::byWeek($week)
            ->with('worker:id,name')
            ->select('*', DB::raw('(TIMESTAMPDIFF(hour, start_work, end_work)) AS hours_worked'))
            ->where('worker_id', $workerId)
            ->paginate(100);
        $work_start = '2022-01-01';
        return view('reports.index', compact('reports', 'week', 'work_start', 'workerId'));

    }


    /**
     * @OA\Put(
     *     path="/api/reports/{id}",
     *     summary="Update the specified resource in storage",
     *     description="Update the specified resource in storage.",
     *     tags={"Reports"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *         @OA\Property(property="worker_id", type="integer"),
     *         @OA\Property(property="start_work", type="string", example="'2023-05-22 02:52:57'"),
     *         @OA\Property(property="end_work", type="string", example="'2023-05-22 03:52:57'")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Report successfully updated",
     *         @OA\JsonContent(ref="#/components/schemas/ReportResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     )
     * )
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(ReportStoreRequest $request, string $id)
    {
        $updated_report = Report::where('worker_id', $id)
            ->where('start_work', $request->input('start_work'))
            ->update($request->validated());
        return new ReportResource(Report::findOrFail($id));
    }

}
