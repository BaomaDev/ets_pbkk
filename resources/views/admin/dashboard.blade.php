<!-- /views/admin/dashboard.blade.php -->
<x-layout>
    <x-slot:title>Admin Dashboard</x-slot:title>

    <h3>Manage Menus</h3>

    <!-- Create and Edit Form -->
    <form action="{{ isset($menu) ? route('admin.menus.update', $menu) : route('admin.menus.store') }}" method="POST">
        @csrf
        @if(isset($menu))
            @method('PUT')
        @endif

        <div>
            <label for="name">Menu Name</label>
            <input type="text" id="name" name="name" value="{{ $menu->name ?? old('name') }}">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ $menu->description ?? old('description') }}</textarea>
        </div>

        <div>
            <label for="price">Price</label>
            <input type="number" id="price" name="price" value="{{ $menu->price ?? old('price') }}" step="0.01">
        </div>

        <button type="submit">{{ isset($menu) ? 'Update' : 'Create' }}</button>
    </form>

    <!-- Menu List -->
    <h3>All Menus</h3>
    @if($menus->isEmpty())
        <p>No menus available. Please add a new one!</p>
    @else
        <ul>
            @foreach($menus as $menu)
                <li>
                    {{ $menu->name }} - ${{ $menu->price }}
                    <a href="{{ route('admin.menus.edit', $menu) }}">Edit</a>
                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</x-layout>
