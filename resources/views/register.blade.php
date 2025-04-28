@extends('layouts.app')

@section('content')
    <div class="max-w-lg w-full bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Registration</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" name="username" id="username" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>

                @error('username')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Phone Number</label>
                <input type="tel" name="phone" id="phone" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>

                @error('phone')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Register
                </button>
            </div>
        </form>
    </div>
@endsection
