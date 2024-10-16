@props(['menu'])

<div class="border border-gray-200 rounded-lg overflow-hidden shadow-lg">
    <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
    <div class="p-4">
        <h2 class="text-xl font-semibold">{{ $menu->name }}</h2>
        <p class="text-gray-700 mt-2">{{ $menu->description }}</p>
        <p class="text-gray-500 mt-2">Category: {{ $menu->category->name }}</p>
        <div class="mt-4 text-right">
            <span class="text-lg font-bold text-green-500">${{ $menu->price }}</span>
        </div>

        <!-- Add to Cart Button -->
        <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Add to Cart</button>
        </form>
    </div>
</div>
