@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="alert {{Session::GET('alert-class')}} alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ Session::get('message') }}</strong>
</div>
@endif
    <div class="card">
        <div class="card-header">My Listing</div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Listing</th>
                    <th scope="col" colspan='2'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listings as $listing)
                    <tr>
                        <th scope="row">{{$listing->id_properti}}</th>
                        <td>{{$listing->nama_listing}}</td>
                        <td><a class="btn btn-primary" href="/edit/{{$listing->id_properti}}">Edit</a></td>
                        <td><a class="btn btn-danger" href="/delete/{{$listing->id_properti}}">Hapus</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$listings->links()}}
        </div>

        
    </div>
@endsection
