@php
    use Illuminate\Support\Str;
@endphp

<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Our Menu</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($menus as $menu)
            <x-menu-card :menu="$menu" />
        @endforeach
    </div>
</x-layout>