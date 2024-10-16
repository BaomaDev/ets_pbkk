<x-layout>
    <x-slot:title>Shopping Cart</x-slot:title>

    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (empty($cart))
            <p>Your cart is empty.</p>
        @else
            <ul>
                @foreach ($cart as $id => $item)
                    <li class="mb-4">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-20 h-20 inline-block">
                        <span>{{ $item['name'] }} ({{ $item['quantity'] }}) - ${{ $item['price'] }}</span>
                        <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layout>
