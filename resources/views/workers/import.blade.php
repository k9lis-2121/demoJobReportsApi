@extends('layouts.app')

@section('content')

    <style>
        .bg-green-100 {
            background-color: #b8e1c2;
        }

        .text-green-700 {
            color: #2D3748;
        }

        .bg-red-100 {
            background-color: #e1a8a8;
        }

        .text-red-700 {
            color: #9B2C2C;
        }
    </style>
    <div class="container mx-auto px-4 py-12">
        <div class="bg-gray-800 rounded-lg shadow-lg p-6 mx-auto max-w-sm" style="max-width: 450px;">
            <h1 class="text-3xl font-bold mb-4 text-center text-white">Загрузить CSV файл</h1>

            @if (isset($result))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <strong class="font-bold">Успех!</strong>
                    <span class="block sm:inline">{{ $result }}</span>
                </div>
            @endif

            @if (isset($error))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <strong class="font-bold">Ошибка!</strong>
                    <span class="block sm:inline">{{ $error }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="csv_file" class="block text-gray-400 font-bold mb-2">Выберите CSV файл:</label>
                    <div class="relative">
                        <input type="file" name="csv_file" id="csv_file" class="appearance-none border rounded w-full py-2 px-3 text-gray-400 leading-tight focus:outline-none focus:shadow-outline">
                        <span class="absolute right-0 top-0 mt-2 mr-2"><i class="far fa-file-excel text-gray-500"></i></span> <!-- пример использования иконки Font Awesome -->
                    </div>

                    @error('csv_file')
                    <div class="bg-red-600 border border-red-700 text-red-100 px-4 py-3 rounded relative mt-4" role="alert">
                        <strong class="font-bold">Ошибка!</strong>
                        <span class="block sm:inline">{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg focus:outline-none focus:shadow-outline w-full" >Загрузить</button>
            </form>
        </div>
    </div>
@endsection

@section('body-class', 'dark')
