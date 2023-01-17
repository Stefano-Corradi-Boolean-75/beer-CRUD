@extends('layout.main')

@section('content')
<div class="container">
    <h1 class="my-5">Le mie birre</h1>


    @if (session('deleted'))
        <div class="alert alert-success" role="alert">
            {{session('deleted')}}
        </div>
    @endif



    <a class="btn btn-success" href="{{route('beers.create')}}">NUOVA BIRRA</a>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">
                <a href="{{route('beers.orderby',['id',$direction])}}">ID</a>
            </th>
            <th scope="col">
                <a href="{{route('beers.orderby',['price',$direction])}}">Nome</a>
            </th>
            <th scope="col">
                <a href="{{route('beers.orderby',['price',$direction])}}">Prezzo</a>
            </th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($beers as $beer)
                <tr>
                    <td>{{$beer->id}}</td>
                    <td>{{$beer->name}}</td>
                    <td>$ {{number_format($beer->price,2,',','.')}}</td>
                    <td class="d-flex">
                        <a class="btn btn-primary" href="{{route('beers.show', $beer->slug)}}">SHOW</a>
                        <a class="btn btn-info" href="{{route('beers.edit', $beer)}}">EDIT</a>
                        @include('partials.form-delete')
                    </td>
                </tr>
            @endforeach



        </tbody>
      </table>

      <div>
        {{$beers->links()}}
      </div>

</div>
@endsection
