@extends('layouts.app')

@section('content')
    <div class="container w-50 bg-white shadow border rounded">

        <div class="row p-1 m-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ui>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ui>
                </div>
            @endif
        </div>

        <div class="row p-1">
            <div class="col text-center align-self-center">
                <h4 class="m-0 ">Delete it? - {{$task->name}}</h4>
            </div>
        </div>


        <form method="POST" action="{{ route('task.update', $task->id) }}">
            @csrf
            @method('DELETE')
            <div class="row pt-1 pb-1 justify-content-center">

                <div class="form-group row pt-3">
                    @if($task->description!=null)
                        {{ $task->description }}
                    @elseif($task->description==null)
                        Description is missing
                    @endif
                </div>

                <div class="row form-group pt-3">
                    <div class="col-auto p-0">
                        <label for="form-check-input">Status:</label>
                    </div>
                    <div class="col-auto">
                        @if($task->isDone)
                            <input type="checkbox" class="form-check-input" name="isDone"
                                   id="isDone" value="{{ $task->isDone }}" checked disabled>
                        @else
                            <input type="checkbox" class="form-check-input" name="isDone"
                                   id="isDone" value="{{ $task->isDone }}" disabled>
                        @endif
                    </div>
                </div>

            </div>

            <div class="row justify-content-end pb-3">

                <div class="col-auto text-center align-self-center">
                    <a class="btn btn-primary" href="{{ route('task.index')}}">
                        <i class="bi bi-arrow-left"></i>
                        Go Back
                    </a>
                </div>

                <div class="col-auto text-center align-self-center">
                    <button  type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                        Yes delete
                    </button>
                </div>

            </div>

        </form>

    </div>
@endsection
