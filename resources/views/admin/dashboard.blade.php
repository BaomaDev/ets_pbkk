<x-layout>
    <form action="{{ isset($menu) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}" method="POST">
        @csrf
        @if(isset($menu))
            @method('PUT') <!-- This is for the update method -->
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
    
        <div>
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($menu) && $menu->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <button type="submit">{{ isset($menu) ? 'Update' : 'Create' }}</button>
    </form>

    <!-- Display all menus and edit/delete options -->
    <h3>All Menus</h3>
    @if($menus->isEmpty())
        <p>No menus available. Please add a new one!</p>
    @else
        <ul>
            @foreach($menus as $menu)
                <li>
                    {{ $menu->name }} - ${{ $menu->price }}
                    <a href="{{ route('admin.menus.edit', $menu->id) }}">Edit</a>
                    <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</x-layout>
