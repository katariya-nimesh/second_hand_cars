@extends('layouts.admin')

@section('content')
    <h2>Car Varients</h2>
    <a href="{{ route('car-varients.create') }}" class="button edit">Create New Car Varient</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Registration Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carVarients as $varient)
                <tr>
                    <td>{{ $varient->id }}</td>
                    <td>{{ $varient->name }}</td>
                    <td>{{ $varient->carRegistrationYear->year }}</td>
                    <td>
                        <a href="{{ route('car-varients.edit', $varient->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('car-varients.destroy', $varient->id) }}" method="POST" style="display:inline;">
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
