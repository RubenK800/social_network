<form action="{{route('save-post')}}" method="post" enctype = "multipart/form-data">
    @csrf
    <div>
        <label>
            <input type="text" name="post-body">
        </label>
    </div>
    <div>
        <label for="image" style="border: solid #1a202c 1px">Add image</label>
            <input type="file" id="image" name="img"hidden>
    </div>
    <br>
    <input type="submit" name="submit" value="Send post">
</form>

