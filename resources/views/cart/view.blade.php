<x-layout>
    <x-slot:title>Your Cart</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white mb-6">Your Cart</h1>

        @if ($cart && $cart->items->count())
            <div class="space-y-4">
                @foreach ($cart->items as $item)
                    <div class="flex items-center justify-between bg-gray-800 text-white p-4 rounded-lg shadow">
                        <div class="flex items-center">
                            <img src="{{ $item->menu->image }}" alt="{{ $item->menu->name }}" class="w-16 h-16 object-cover rounded">
                            <div class="ml-4">
                                <h2 class="text-lg font-bold">{{ $item->menu->name }}</h2>
                                <p class="text-sm">Quantity: {{ $item->quantity }}</p>
                                <p class="text-sm">Price: ${{ number_format($item->menu->price, 2) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <!-- Decrease Quantity -->
                            <form action="{{ route('cart.update', ['id' => $item->id, 'action' => 'decrease']) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-lg">
                                    <i class="fas fa-minus"></i> 
                                </button>
                            </form>
                            <!-- Increase Quantity -->
                            <form action="{{ route('cart.update', ['id' => $item->id, 'action' => 'increase']) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded-lg">
                                    <i class="fas fa-plus"></i> 
                                </button>
                            </form>
                            <!-- Remove item -->
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-lg">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-between items-center bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-bold text-white">Total: ${{ number_format($cart->total_price, 2) }}</h2>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-lg shadow">
                        Checkout
                    </button>
                </form>
            </div>
        @else
            <p class="text-white">Your cart is empty.</p>
        @endif
    </div>
</x-layout>
