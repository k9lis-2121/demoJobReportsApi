@extends('layouts.app')

@section('content')
    <div class="dark:bg-gray-800">
        <div class="max-w-sm mx-auto">

            <style>
                .dark-button {
                    background-color: #2d3b4e;
                    color: #fff;
                    padding: 10px 20px;
                    border-radius: 5px;
                    border: none;
                    font-size: 16px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }

                .dark-button:hover {
                    background-color: #555;
                }
            </style>

                <a href="workers/import" type="submit" class="dark-button">Import Workers</a>
            <table class="min-w-full divide-y divide-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-400 dark:bg-gray-800">
                @foreach ($workers as $worker)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $worker->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $worker->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('body-class', 'dark')
