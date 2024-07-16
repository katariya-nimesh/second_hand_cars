@extends('layouts.admin')

@section('content')
    <h2>Car Brands</h2>
    <a href="{{ route('car-brands.create') }}" class="button">Create New Car Brand</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carBrands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        @if($brand->image)
                            <img src="{{ $brand->image }}" alt="{{ $brand->name }}" width="100">
                        @else
                            No image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('car-brands.edit', $brand->id) }}" class="button">Edit</a>
                        <form action="{{ route('car-brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
