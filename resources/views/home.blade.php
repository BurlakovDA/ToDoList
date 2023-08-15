@extends('layouts.app')

@section('content')
<div class="container bg-white shadow border rounded">

    <div class="container w-100 justify-content-center" style="text-align: -webkit-center;">

        <div class="col">

                <div class="row pt-3">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>

                <div class="row p-2 pt-3">
                    <div class="col text-center align-self-center">
                        <h4 class="m-0 ">Your ToDos</h4>
                    </div>
                    <div class="col text-center align-self-center">
                        <a class="btn btn-success" href="{{ route('task.create') }}">
                            <i class="bi bi-pencil"></i>
                            Add New ToDos
                        </a>
                    </div>
                </div>

                <div class="row pt-3 pb-3">
                    <table class="table table-hover rounded text-center border">

                        <thead>
                            <th class="col-6">
                                Name
                            </th>
                            <th class="col-6">
                                Tools
                            </th>
                        </thead>

                        <tbody>
                        @forelse($tasks as $task)

                            <tr>

                                @if($task->isDone)
                                    <td><a class="text-decoration-none" href="{{route('task.edit', $task->id)}}" style="color: black">
                                    <s>{{$task->name}}</s></a></td>
                                @else
                                    <td><a class="text-decoration-none" href="{{route('task.edit', $task->id)}}" style="color: black">
                                    {{$task->name}}</a></td>
                                @endif

                                <td>
                                    <a class="btn btn-primary" href="{{route('task.edit', $task->id)}}">
                                        <i class="bi bi-card-heading"></i>
                                        Edit
                                    </a>

                                    <a class="btn btn-danger" href="{{route('task.show', $task->id)}}">
                                        <i class="bi bi-trash"></i>
                                        Delete
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    Ooops! It looks like it's completely empty here.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>

        </div>

    </div>
</div>
@endsection
