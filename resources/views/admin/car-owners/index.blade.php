@extends('layouts.admin')

@section('content')
    <h2>Car Owners</h2>
    <a href="{{ route('create-owners') }}" class="button edit">Create New Car Owner</a>

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
                        <a href="{{ route('edit-owners', $owner->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('delete-owners', [ 'id' => $owner->id]) }}" method="POST" style="display:inline">
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
