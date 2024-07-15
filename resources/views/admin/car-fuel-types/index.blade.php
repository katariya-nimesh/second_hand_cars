@extends('layouts.admin')

@section('content')
    <h2>Car Fuel Types</h2>
    <a href="{{ route('car-fuel-types.create') }}" class="button edit">Create New Car Fuel Type</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fuel Type</th>
                <th>Transmission</th>
                <th>Car Varient</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carFuelTypes as $fuelType)
                <tr>
                    <td>{{ $fuelType->id }}</td>
                    <td>{{ $fuelType->fuel_type }}</td>
                    <td>{{ $fuelType->transmission }}</td>
                    <td>{{ optional($fuelType->carVariant)->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('car-fuel-types.edit', $fuelType->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('car-fuel-types.destroy', $fuelType->id) }}" method="POST" style="display:inline;">
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
