@extends('layouts.admin')

@section('content')
    <h2>Car Fuel Varients</h2>
    <a href="{{ route('create-fuel-varients') }}" class="button edit">Create New Car Fuel Varient</a>
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
                        <a href="{{ route('edit-fuel-varients', $varient->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('delete-fuel-varients', ['id' => $varient->id]) }}" method="POST" style="display:inline;">
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
