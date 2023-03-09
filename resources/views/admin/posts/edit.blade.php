<x-admin-master>
    @section('content')
        <h1>Edit Post</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
            </div>
            <div class="formg-group">
                <div><img width="280px" height="230px" src="{{$post->post_image}}" alt=""></div>
                <label for="file">New File:</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image">
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" id="body" class="form-control" cols="3" rows="10" value="{{$post->body}}">{{$post->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    @endsection
</x-admin-master>