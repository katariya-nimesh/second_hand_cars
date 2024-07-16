@extends('layouts.admin')

@section('content')
    <h2>Car Registration Years</h2>
    <a href="{{ route('car-registration-years.create') }}" class="button edit">Create New Registration Year</a>
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
                        <a href="{{ route('car-registration-years.edit', $year->id) }}" class="button edit">Edit</a>
                        <form action="{{ route('car-registration-years.destroy', $year->id) }}" method="POST" style="display:inline;">
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
