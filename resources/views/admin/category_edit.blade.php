<form method="POST" action="{{ route('admin.category.update', $category->idgroup) }}" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <input type="text" name="groupname" value="{{ $category->groupname }}">
    <input type="text" name="type" value="{{ $category->type }}">
    <input type="text" name="debut" value="{{ $category->debut }}">
    <input type="text" name="agency" value="{{ $category->agency }}">
    <input type="text" name="popular" value="{{ $category->popular }}">

    <img src="{{ asset('storage/' . $category->groupimg) }}" width="150">

    <input type="file" name="groupimg">

    <button type="submit">Update</button>
</form>x    