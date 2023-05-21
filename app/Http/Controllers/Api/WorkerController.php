<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkerStoreRequest;
use App\Http\Resources\WorkerResource;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workers = WorkerResource::collection(Worker::all());
        return view('workers/index')->with([
            'workers' => $workers
        ]);
    }

    public function import(){
        return view('workers/import');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkerStoreRequest $request)
    {
        $created_work = Worker::create($request->validated());

        return new WorkerResource($created_work);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new WorkerResource(Worker::findOrFail($id));
    }

    public function upload(Request $request)
    {
        $file = $request->file('csv_file'); // получаем файл из запроса

        if (!$file) {
            return view('workers/import')->with(['error' => 'Файл не найден'], 400);
        }

        if ($file->getClientOriginalExtension() !== 'csv') {
            return view('workers/import')->with(['error' => 'Неверный формат файла'], 400);
        }

        $path = $file->getPathname();
        $data = array_map('str_getcsv', file($path)); // читаем данные из файла

        foreach ($data as $row) {
            $name = $row[0];
            Worker::create(['name' => $name]); // создаем нового работника в базе данных
        }

        return view('workers/import')->with(['result' => 'Список рабочих успешно загружен']);
    }


}
