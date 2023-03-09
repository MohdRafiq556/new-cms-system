<x-admin-master>
    @section('content')

    @if(session()->has('permission-updated'))
        <div class="alert alert-success">
            {{session('permission-updated')}}
        </div>
    @endif

    <div class="row">
        <div class="col-sm-6">
            <h1>Edit Permission: {{$permission->name}}</h1>

            <form method="post" action="{{route('permissions.update', $permission->id)}}">
                @csrf 
                @method('PUT')
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" value="{{$permission->name}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    @endsection
</x-admin-master>