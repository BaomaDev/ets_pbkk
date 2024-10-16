<x-layout>
    <div class="container mx-auto mt-[75px] p-4">
        <form action="{{ isset($menu) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf
            @if(isset($menu))
                @method('PUT') <!-- This is for the update method -->
            @endif

            <h2 class="text-2xl text-white mb-4">{{ isset($menu) ? 'Edit Menu' : 'Create Menu' }}</h2>

            <div class="mb-4">
                <label for="name" class="block text-gray-300">Menu Name</label>
                <input type="text" id="name" name="name" value="{{ $menu->name ?? old('name') }}" class="mt-1 block w-full p-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:border-blue-400 focus:ring focus:ring-blue-300">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-300">Description</label>
                <textarea id="description" name="description" class="mt-1 block w-full p-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:border-blue-400 focus:ring focus:ring-blue-300">{{ $menu->description ?? old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-300">Price</label>
                <input type="number" id="price" name="price" value="{{ $menu->price ?? old('price') }}" step="0.01" class="mt-1 block w-full p-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:border-blue-400 focus:ring focus:ring-blue-300">
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-300">Category</label>
                <select id="category_id" name="category_id" class="mt-1 block w-full p-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:border-blue-400 focus:ring focus:ring-blue-300">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($menu) && $menu->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition duration-200">
                {{ isset($menu) ? 'Update Menu' : 'Create Menu' }}
            </button>
        </form>

        <!-- Display all menus and edit/delete options -->
        <h3 class="text-2xl text-white mt-8">All Menus</h3>
        @if($menus->isEmpty())
            <p class="text-gray-400">No menus available. Please add a new one!</p>
        @else
            <ul class="mt-4 space-y-2">
                @foreach($menus as $menu)
                    <li class="flex justify-between items-center bg-gray-700 p-4 rounded-md shadow">
                        <span class="text-white">{{ $menu->name }} - ${{ number_format($menu->price, 2) }}</span>
                        <div class="space-x-2">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-blue-400 hover:underline">Edit</a>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layout>
