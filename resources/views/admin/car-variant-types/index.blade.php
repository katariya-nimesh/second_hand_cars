@extends('layouts.admin')

@section('content')
    <h2>Car Variant Types</h2>
    <a href="{{ route('create-variant-types') }}" class="button edit">Create New Car Variant Type</a>

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
                        <a href="{{ route('edit-variant-types', $variantType->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('delete-variant-types', [ 'id' => $variantType->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="button delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
