@extends('layout.main')

@section('content')
<div class="container">
    <h1 class="my-5">{{$}}</h1>

    @if ($errors->any())

        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>

        </div>


    @endif

    <form action="{{$route}}" method="POST">
        @csrf
        @method($method)
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror " 
            value="{{old('name',$beer?->name)}}" name="name" id="name" placeholder="Nome birra">
            @error('name')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">URL immagine</label>
            <input type="text" class="form-control @error('image') is-invalid @enderror " value="{{old('image',$beer?->image)}}"  name="image" id="image" placeholder="URL immagine">
            @error('image')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="float" class="form-control @error('price') is-invalid @enderror " value="{{old('price',$beer?->price)}}"  name="price" id="price" placeholder="00.00">
            @error('price')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-success" >Invio</button>


    </form>

</div>
@endsection
