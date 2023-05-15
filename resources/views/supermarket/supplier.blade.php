@extends('ui.layouts.app', ['title' => 'import Supplier'])

@section('content')
    <div class="row flex-grow">
        <div class="col-md-4 mx-auto">
            <div class="auth-form-light p-5 border border-dark">
                <h5>Supplier upload</h5>
                <form method="POST" action="{{route('supermarket.supplierfile')}}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <input type="file" id="name" name="csv_file_names" class="form-control @error('name') is-invalid @enderror"  required placeholder="upload employee file" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-block btn-primary">
                       Upload
                    </button>

                </form>
            </div>
        </div>
    </div>
@endsection
