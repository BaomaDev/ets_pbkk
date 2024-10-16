@props(['menu'])

<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="rounded-t-lg object-cover h-48 w-full" src="{{ $menu->image }}" alt="{{ $menu->name }}">
    </a>
    <div class="p-5">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $menu->name }}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($menu->description, 100) }}</p>
        <p class="mb-3 font-normal text-gray-500 dark:text-gray-300">Category: {{ $menu->category->name }}</p>
        <span class="text-lg font-bold text-green-500">${{ $menu->price }}</span>

        <!-- Add to Cart Button -->
        <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
            <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Add to Cart
            </button>
        </form>
    </div>
</div>
