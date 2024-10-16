<x-layout>
    <div class="container mx-auto px-4 py-16">

        <!-- Search and Categorization Form -->
        <form method="GET" action="{{ route('menu.index') }}" class="mb-6">
            <div class="flex space-x-4">
                <!-- Search -->
                <input type="text" name="search" value="{{ request()->search }}" placeholder="Search menu..."
                    class="w-full p-2 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200">

                <!-- Categories Filter -->
                <select name="category_id" class="p-2 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Submit Button -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Filter
                </button>
            </div>
        </form>

        <!-- Menu Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($menus as $menu)
                <x-menu-card :menu="$menu" />
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $menus->withQueryString()->links() }}
        </div>
    </div>
</x-layout>
