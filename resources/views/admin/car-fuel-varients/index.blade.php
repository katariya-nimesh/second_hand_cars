@extends('layouts.admin')

@section('content')
    <h2>Car Fuel Varients</h2>
    <a href="{{ route('car-fuel-varients.create') }}" class="button edit">Create New Car Fuel Varient</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Fuel Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carFuelVarients as $varient)
                <tr>
                    <td>{{ $varient->id }}</td>
                    <td>{{ $varient->name }}</td>
                    <td>{{ $varient->car_fuel_type->fuel_type }}</td>
                    <td>
                        <a href="{{ route('car-fuel-varients.edit', $varient->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('car-fuel-varients.destroy', $varient->id) }}" method="POST" style="display:inline;">
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
