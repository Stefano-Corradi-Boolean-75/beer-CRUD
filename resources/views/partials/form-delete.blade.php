<form action="{{route('beers.destroy',$beer)}}" method="POST"
    onsubmit="return confirm('Confermi l\eliminazione?')"
>
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">DELETE</button>
</form>
