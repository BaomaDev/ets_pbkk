@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Welcome to Catering Service</h2>
    <p>Explore our menu and order your favorite dishes.</p>
</div>

<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Our Menu</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($menus as $menu)
            <x-menu-card :menu="$menu" />
        @endforeach
    </div>
@endsection
