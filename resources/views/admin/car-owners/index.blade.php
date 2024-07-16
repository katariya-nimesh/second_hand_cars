@extends('layouts.admin')

@section('content')
    <h2>Car Owners</h2>
    <a href="{{ route('car-owners.create') }}" class="button edit">Create New Car Owner</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carOwners as $owner)
                <tr>
                    <td>{{ $owner->id }}</td>
                    <td>{{ $owner->name }}</td>
                    <td>
                        <a href="{{ route('car-owners.edit', $owner->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('car-owners.destroy', $owner->id) }}" method="POST" style="display:inline">
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
