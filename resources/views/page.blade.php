
<form action="{{route('create')}}" method="post">
@csrf
<input type="text" placeholder="title" name="title">
<input type="text" placeholder="body" name="body">
<input type="text" placeholder="blog_id" name="blog_id">
<button type="submit">save</button>

</form>


