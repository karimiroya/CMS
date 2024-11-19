@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Profile</h1>

        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">User Details</h2>
            <p class="text-gray-600 dark:text-gray-300 mt-4"><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p class="text-gray-600 dark:text-gray-300"><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p class="text-gray-600 dark:text-gray-300"><strong>Role:</strong> {{ Auth::user()->role->name }}</p>

        </div>

        <div class="mt-6">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="text-red-500 hover:underline">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
@endsection
