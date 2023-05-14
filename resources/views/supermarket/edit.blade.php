@extends('ui.layouts.app', ['title' => 'Register'])

@section('content')
    <div class="row flex-grow">
        <div class="col-md-4 mx-auto">
            <div class="auth-form-light p-5 border border-dark">
                <form method="POST" action="{{ route('supermarket.update', $Supermarket->id) }}" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ (old('name'))?old('name'):$Supermarket->name }}" required placeholder="Name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="regid" class="sr-only">location</label>
                        <input type="location" id="regid" name="locationid" class="form-control @error('regno') is-invalid @enderror" value="{{(old('locationid'))?old('location'):$Supermarket->location }}" required placeholder="location">
                        @error('regno')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-block btn-primary">
                       Edit supermarket
                    </button>

                </form>
            </div>
        </div>
    </div>
@endsection
