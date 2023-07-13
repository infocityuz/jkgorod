<form action="{{route('notificate')}}" method="POST">
    @csrf
    <input type="text" name="name">
    <button type="submit">submit</button>
</form>
