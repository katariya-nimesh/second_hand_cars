@extends('layouts.admin')

@section('content')
    <h2>Car Variant Types</h2>
    <a href="{{ route('car-variant-types.create') }}" class="button edit">Create New Car Variant Type</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Car Fuel Variant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carVariantTypes as $variantType)
                <tr>
                    <td>{{ $variantType->id }}</td>
                    <td>{{ $variantType->name }}</td>
                    <td>{{ $variantType->car_fuel_varient->name }}</td>
                    <td>
                        <a href="{{ route('car-variant-types.edit', $variantType->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('car-variant-types.destroy', $variantType->id) }}" method="POST" style="display:inline;">
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
