@extends('layouts.admin')

@section('content')
    <h2>Car Kilometer Ranges</h2>

    <a href="{{ route('create-kilometers') }}" class="button">Create New Range</a>

    @if ($carKilometers->isEmpty())
        <p>No car kilometer ranges found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Start Kilometer</th>
                    <th>End Kilometer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carKilometers as $carKilometer)
                    <tr>
                        <td>{{ $carKilometer->id }}</td>
                        <td>{{ $carKilometer->start_km }}</td>
                        <td>{{ $carKilometer->end_km }}</td>
                        <td>
                            <a href="{{ route('edit-kilometers', $carKilometer->id) }}" class="button edit">Edit</a>
                            <form action="{{ route('delete-kilometers', ['id' => $carKilometer->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="button delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
