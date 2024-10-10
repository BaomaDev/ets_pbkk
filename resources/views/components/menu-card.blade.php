@props(['menu'])

<div class="border border-gray-200 rounded-lg overflow-hidden shadow-lg">
    <img src="{{ $menu['image'] }}" alt="{{ $menu['name'] }}" class="w-full h-48 object-cover">
    <div class="p-4">
        <h2 class="text-xl font-semibold">{{ $menu['name'] }}</h2>
        <p class="text-gray-700 mt-2">{{ $menu['description'] }}</p>
        <div class="mt-4 text-right">
            <span class="text-lg font-bold text-green-500">${{ $menu['price'] }}</span>
        </div>
    </div>
</div>
