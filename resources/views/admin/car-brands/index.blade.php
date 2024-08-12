@extends('layouts.admin')

@section('content')
<div style="display: flex;justify-content: space-between;">
    <h2>Car Brands</h2>
    <a style="padding: 12px 10px;margin: 12px;background-color:#4476FB; text-decoration:none;font-size: small;border-radius: 8px;" href="{{ route('create-brands') }}" class="button">Create New Car Brand</a>
</div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
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
                        <select name="select" id="select">
                            <option value="">Select</option>
                        </select>
                        {{-- <a href="{{ route('edit-brands', $brand->id) }}" class="button">Edit</a>
                        <form action="{{ route('delete-brands', [ 'id'=>$brand->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="button delete">Delete</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
