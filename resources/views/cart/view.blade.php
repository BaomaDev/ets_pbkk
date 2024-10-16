<x-layout>
    <x-slot:title>My Cart</x-slot:title>

    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

        @if ($cart && $cart->items->count())
            <div class="space-y-4">
                @foreach ($cart->items as $item)
                    <div class="flex items-center justify-between border p-4">
                        <div>
                            <img src="{{ $item->menu->image }}" alt="{{ $item->menu->name }}" class="w-16 h-16 object-cover">
                            <h2>{{ $item->menu->name }}</h2>
                            <p>Quantity: {{ $item->quantity }}</p>
                        </div>
                        <div>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                <h2 class="text-lg font-bold">Total: ${{ number_format($cart->total_price, 2) }}</h2>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</x-layout>
