@extends('ui.layouts.app', ['title' => 'Dashboard'])

@section('content')
<div class="row flex-grow">

    <div class="col-3">
            <p class="text-end">
                <a href="{{Route('supermarket.create')}}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Add Supermarket
                </a>
            </p>
    </div>
    <div class="col-3">
        <p class="text-end">
            <a href="{{Route('supermarket.employee')}}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                employee csv
            </a>
        </p>
    </div>
    <div class="col-6">
        <div class="view-toggle">
            <label for="view-mode">View Mode:</label>
            <select id="view-mode" name="view-mode">
                <option value="table">table</option>
                <option value="grid">Grid</option>
                <option value="list">List</option>
            </select>
        </div>
    </div>
</div>
<div class="row flex-grow mt-2">
<div class="col-md-6 mx-auto supermarket-grid">
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">location</th>
        <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  @foreach($Supermarket as $Supermarkets)
    <tr>
      <th scope="row">{{$Supermarkets->id}}</th>
      <td>{{$Supermarkets->name}}</td>
      <td>{{$Supermarkets->location}}</td>
        <td><a href="{{route('supermarket.edit', $Supermarkets->id)}}">Edit</a></td>
        <td><form action="{{route('remove', $Supermarkets->id)}}" method="post">
                @csrf
                @method('delete')
                <button style="background-color: darkcyan; margin: 1rem 0rem 0rem 4rem;padding: 1rem 2rem 1rem 2rem; border-radius: 4rem; ">Delete</button>
            </form></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
    <div class="col-md-3">
        <div class="supermarket-list">
            @foreach ($Supermarket as $Supermarkets)
                <div class="item-list">
                    <p>[{{ $Supermarkets->name }}</p>-<p>{{ $Supermarkets->location }}]</p>
                </div>
            @endforeach
        </div>

    </div>
{{--    <div class="col-md-3">--}}
{{--        <div class="">--}}
{{--            @foreach ($Supermarket as $supermarkets)--}}
{{--                <div class="supermarket-item-grid">--}}
{{--                    <p>{{ $Supermarkets->name }}</p>-<p>{{ $Supermarkets->location }}</p>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}

{{--    </div>--}}
</div>
@endsection


