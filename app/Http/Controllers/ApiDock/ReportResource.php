<?php

namespace App\Http\Controllers\ApiDoc;

use phpDocumentor\Reflection\Types\AggregatedType;

/**
 * Class ReportResource
 * @package App\ApiDoc
 * @OA\Schema(
 *     description="Success Report response",
 *     title="Report response"
 * )
 */
class ReportResource
{


    /**
     * @var integer
     * @OA\Property(type="integer", example="5")
     */
    public $worker_id;

    /**
     * @var string
     * @OA\Property(type="string", example="2023-05-21T20:00:12Z")
     */
    public $start_work;

    /**
     * @var string
     * @OA\Property(type="string", example="2023-05-21T20:00:12Z")
     */
    public $end_work;
}
