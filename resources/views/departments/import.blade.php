@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Import Departments</h2>
        <form action="{{ route('departments.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required>
            <button type="submit">Import</button>
        </form>
    </div>
@endsection
