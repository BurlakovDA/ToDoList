@extends('layouts.app')

@section('content')
    <div class="container w-50 bg-white shadow border rounded">

                <div class="row p-1 m-2">

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

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

                <div class="row p-1 ">
                    <div class="col text-center align-self-center">
                        <h4 class="m-0 ">Add New ToDo</h4>
                    </div>
                </div>


                <form method="POST" action="{{ route('task.store') }}">
                    @csrf
                    <div class="row pt-1 pb-1 justify-content-center">

                        <div class="form-group row pt-3">
                            <label for="name" class="p-0">Name</label>
                            <input class="form-control mt-2 @error('name') is-invalid
                            @enderror" id="name" name="name" type="text" placeholder="Name"
                            value="{{ old('name') }}">
                        </div>

                        <div class="form-group row pt-3">
                            <label for="description" class="p-0">Description</label>
                            <textarea class="form-control mt-2 @error('description') is-invalid @enderror"
                            name="description" id="description" placeholder="Description"
                            rows="3" value="{{ old('description') }}"></textarea>
                        </div>

                        <div class="row form-group pt-3">
                            <div class="col-auto p-0">
                                <label for="form-check-input">Status:</label>
                            </div>
                            <div class="col-auto">
                                <input type="checkbox" class="form-check-input" name="isDone"
                                id="isDone" value="{{ old('isDone') }}">
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
                            <button  type="submit" class="btn btn-success">
                                <i class="bi bi-check"></i>
                                Add
                            </button>
                        </div>

                    </div>

                </form>

    </div>
@endsection
