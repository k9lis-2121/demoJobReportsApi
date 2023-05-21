@extends('layouts.app')

@section('content')

<div class="flex items-center justify-start my-4">
    @if ($week > 1)
        @if(@isset($workerId))
            <a href="{{ url('/reports/'. $workerId.'?week='.$week - 1) }}" class="px-6 py-3 bg-gray-500 text-white font-bold rounded-md"><<</a>
        @else
        <a href="{{ route('reports.index', ['week' => $week - 1]) }}" class="px-6 py-3 bg-gray-500 text-white font-bold rounded-md"><<</a>
        @endif
    @endif

    @if ($week < now()->diffInWeeks($work_start) + 1)
            @if(@isset($workerId))
                <a href="{{ url('/reports/'. $workerId. '?week='.$week + 1) }}" class="ml-2 px-6 py-3 bg-gray-500 text-white font-bold rounded-md">>></a>
            @else
        <a href="{{ route('reports.index', ['week' => $week + 1]) }}" class="ml-2 px-6 py-3 bg-gray-500 text-white font-bold rounded-md">>></a>
            @endif
    @endif
</div>
<div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
        <div class="w-full lg:w-5/6">

            <table class="table-auto border-collapse w-full">
                <thead>
                <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                    <th class="px-4 py-2 bg-gray-200 ">{{ __('ID') }}</th>
                    <th class="px-4 py-2 bg-gray-200 ">{{ __('Worker ID') }}</th>
                    <th class="px-4 py-2 bg-gray-200">{{ __('Worker Name') }}</th>
                    <th class="px-4 py-2 bg-gray-200">{{ __('Work Start') }}</th>
                    <th class="px-4 py-2 bg-gray-200">{{ __('Work End') }}</th>
                    <th class="px-4 py-2 bg-gray-200">{{ __('Hours') }}</th>
                </tr>
                </thead>
                <tbody class="text-sm font-normal text-gray-700">

                @foreach ($reports as $report)
                    <tr class="border-b border-gray-200 py-10 bg-gray-800 dark:text-slate-400">
                        <td class="px-4 py-4 text-white ">{{ $report->id }}</td>
                        <td class="px-4 py-4 text-white ">{{ $report->worker_id }}</td>
                        <td class="px-4 py-4 text-white "><a href="/reports/{{$report->worker_id}}">{{ $report->worker->name }}</a></td>
                        <td class="px-4 py-4 text-white ">{{ $report->start_work }}</td>
                        <td class="px-4 py-4 text-white ">{{ $report->end_work }}</td>
                        <td class="px-4 py-4 text-white ">{{ $report->hours_worked }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection

@section('body-class', 'dark')
