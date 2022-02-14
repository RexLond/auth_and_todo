@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Todo List
                </div>
                <div class="card-body">
                    <table style="table-layout: fixed" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Todos</th>
                            <th style="width:63px"></th>
                            <th style="width:70px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($todos as $todo)
                            <tr>
                                <td class="pt-3"><span @if($todo->done) class="fst-italic text-decoration-line-through" style="color: gray" @else class="fw-bold" @endif>{{ $todo->content }}</span> </td>
                                <td>
                                    <form action="todo/{{ $todo->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if($todo->done)
                                            <button class="btn btn-sm btn-info" type="submit">Back</button>
                                        @else
                                            <button class="btn btn-sm btn-info" type="submit">Done</button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <form action="todo/{{ $todo->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Write something a bit.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <form action="{{ route('todo.store') }}" method="POST">
                        @csrf
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="pt-3"><input style="width: 100%" class="text-black" placeholder=" Write something a bit." type="text" id="todo" name="todo"> </td>
                                    <td style="width: 133px"> <button style="width: 118px; margin-top:6px" class="btn btn-sm btn-primary" type="submit">Add</button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
