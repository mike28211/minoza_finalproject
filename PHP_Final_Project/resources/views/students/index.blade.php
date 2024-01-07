@extends('students.layout')

@section('head')
<style>
    .dropdown-menu a:hover {
        background-color: #5F9EA0;
        color: #fff;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
    }

    .edit-button,
    .delete-button {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100px;
    }

    .edit-button {
        background-color: #5F9EA0;
        color: #fff;
    }

    .delete-button {
        background-color: #800000;
        color: #fff;
    }
</style>
@endsection

@section('navbar')
<div style="margin-right: 20px; margin-left: 35px; margin-top: 25px; margin-bottom: 25px; ">
    <span style="margin-right: 10px; font-size: 23px; font-weight: 600; color:#5F9EA0">List</span>
    <div class="dropdown" style="display: inline-block; ">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" margin-top: -10px; background-color:#5F9EA0; border-color: #5F9EA0;">
            Select
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addStudentModal">Create</a>
        </div>
    </div>
</div>
@endsection

@section('modals')
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #5F9EA0;">
                <h5 class="modal-title" id="addStudentModalLabel" style="color: #fff;">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #89CFF0;">
                <form action="{{ route('students.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade:</label>
                        <input type="text" class="form-control" id="grade" name="grade" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #5F9EA0; border-color: #5F9EA0;">Add Student</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<table class="table table-striped table-dark" style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
    <thead>
        <tr style="background-color:#5F9EA0;">
            <th scope="col" style="width: 20%;">ACTION</th>
            <th scope="col" style="width: 20%;">ID</th>
            <th scope="col" style="width: 20%;">NAME</th>
            <th scope="col" style="width: 20%;">GRADE</th>
        </tr>
    </thead>
    <tbody style="background-color:#89CFF0; ">
        @foreach ($students as $student)
        <tr>
            <td class="action-buttons">
                <button type="button" class="edit-button" data-toggle="modal" data-target="#editStudentModal{{ $student->id }}">Edit</button>
                <form action="{{ route('students.destroy', $student->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </td>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->grade }}</td>
        </tr>

        <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #5F9EA0;">
                        <h5 class="modal-title" id="editStudentModalLabel{{ $student->id }}" style="color: #fff;">Edit Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                            <span aria-hidden="true" style="color: #fff;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="background-color: #89CFF0;">
                        <form action="{{ route('students.update', $student->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="id">ID:</label>
                                <input type="text" class="form-control" id="id" name="id" value="{{ $student->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="grade">Grade:</label>
                                <input type="text" class="form-control" id="grade" name="grade" value="{{ $student->grade }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary" style="background-color:#5F9EA0; border-color: #5F9EA0;">Update Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>
@endsection