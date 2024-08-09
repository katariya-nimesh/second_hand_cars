@extends('layouts.admin')

@section('content')
    <h2>Car Registration Years</h2>
    <a href="{{ route('create-registration-years') }}" class="button edit">Create New Registration Year</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Year</th>
                <th>Car Brand</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carRegistrationYears as $year)
                <tr>
                    <td>{{ $year->id }}</td>
                    <td>{{ $year->year }}</td>
                    <td>{{ $year->car_brand->name }}</td>
                    <td>
                        <a href="{{ route('edit-registration-years', $year->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('delete-registration-years',['id' => $year->id]) }}" method="POST" style="display:inline;">
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
