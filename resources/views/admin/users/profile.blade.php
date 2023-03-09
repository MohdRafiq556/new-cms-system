<x-admin-master>
    @section('content')

        <h1>User profile</h1>

        <div class="row">
            <div class="col-sm-6">
                <form action="{{route('user.profile.update', $user)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <img src="{{$user->avatar}}" class="img-profile rounded-circle" alt="">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" value="{{$user->username}}" class="form-control @error('username') is-invalid @enderror ">
                        @error('username')  
                            <div class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror ">
                        @error('name')  
                            <div class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror ">
                        @error('email')  
                            <div class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror ">
                        @error('password')  
                            <div class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Password Confirmation:</label>
                        <input type="password" name="password_confirmation" id="password-confirmation" class="form-control @error('password_confirmation') is-invalid @enderror ">
                        @error('password_confirmation')  
                            <div class="invalid-feedback"> {{$message}} </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Roles Table</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="Table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>Options</td>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Attach</th>
                                <th>Detach</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr> 
                                <th>Options</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Attach</th>
                                <th>Detach</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td><input type="checkbox" 
                                    @foreach($user->roles as $user_role)
                                        @if($user_role->slug == $role->slug) 
                                            checked
                                        @endif
                                    @endforeach
                                    ></td>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>
                                    <form method="post" action="{{route('user.role.attach', $user)}}">
                                        @csrf 
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">

                                        <button class="btn btn-primary" @if($user->roles->contains($role)) disabled @endif >Attach</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{route('user.role.detach', $user)}}">
                                        @csrf 
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">

                                        <button class="btn btn-danger" @if(!$user->roles->contains($role)) disabled @endif>Detach</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
</x-admin-master>