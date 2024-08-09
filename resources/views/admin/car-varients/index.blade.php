@extends('layouts.admin')

@section('content')
    <h2>Car Varients</h2>
    <a href="{{ route('create-varients') }}" class="button edit">Create New Car Varient</a>
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
                    <td>{{ $varient->car_registration_year->year }}</td>
                    <td>
                        <a href="{{ route('edit-varients', $varient->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('delete-varients', ['id' => $varient->id]) }}" method="POST" style="display:inline;">
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
