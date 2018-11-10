@extends('layouts.app')

@section('content')
    <div class="container card border-dark pl-0 pr-0">
        <div class="card-header">
            <form method="GET" action="{{ route('tasks.index') }}">
                @method('GET')
                <div class="row justify-content-center mb-5">
                    <div class="list-group">
                        <a href="{{ route('tasks.create') }}"
                           class="list-group-item list-group-item-action list-group-item-info">Create new Task</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="executor_select">Executors</span>
                            </div>
                            <select class="form-control custom-select" id="executor_select" name="executor_id" size="1">
                                @foreach($executors as $executor)
                                    <option value="{{$executor->id}}">{{$executor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="status_select">Status</span>
                            </div>
                            <select class="form-control custom-select" id="status_select" name="status_id" size="1">
                                @foreach($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="tags_select">Tags</span>
                            </div>
                            <select id="tags_select" class="form-control custom-select" name="tags[]" size="1">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend ">
                                <label class="input-group-text">Assigned to me</label>
                            </div>
                            <div class="input-group-append">
                                <div class="input-group-text bg-light">
                                    <input type="checkbox" name="my">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-info">Filter</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group d-flex justify-content-center">
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row justify-content-center card-body">
            @foreach($tasks as $task)
                <div class="col-sm-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="h5 card-title text-center">#{{ $task->id }}</div>
                            <p class="card-text h5 text-center"><strong>{{ $task->name }}</strong></p>
                            <div class="d-flex justify-content-around">
                                <a href="{{ route('statuses.show', $task->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('statuses.edit', $task->id) }}"
                                   class="btn btn-warning mr-4">Edit</a>
                                <form action="{{route('statuses.destroy', $task->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            {{ $tasks->links() }}
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#tag_from').select2({
                tokenSeparators: [",", " "],
                placeholder: 'Choose a tag...',
                tags: true,
            });
        });
    </script>
@endsection
