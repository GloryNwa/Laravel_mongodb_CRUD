@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Add New Post') }}</div>

                <div class="card-body">
                 
                        @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {!! session('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @endif

                        <table id="posts" class="display" style="width:100%">

                        <thead>
                            <tr>
                              <th style="width:20%">Title</th>
                              <th>Description</th>
                              <th style="width:10%">Added On:</th>
                              <th style="width:10%">Action</th>
                              <th style="width:10%">Delete</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post['title']}}</td>
                            <td>{{$post['description']}}</td>
                            <td>{{ date("d-m-Y", strtotime($post['created_at']))}}</td>
                            <td><a href="{{url('posts/'.$post['id'].'/edit') }}">Update</td>
                            <td>
                            <form action="{{route('posts.destroy',['post'=>$post['id']])}}" method="POST">@csrf  @method('DELETE')
                                <button class="btn btn-primary btn-block" type="submit">Delete</button>
                            </form>
                           </td>
                       </tbody>

                       @endforeach
                      </tr>
                        </table>
                       

                    
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
