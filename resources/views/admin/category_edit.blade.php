<form action="{{ route('admin.category.update', $category->idgroup) }}" method="POST">
    @csrf
    <input type="text" name="name_category" value="{{ $category->groupname }}">
    <input type="text" name="type" value="{{ $category->type }}">
    <input type="number" name="debut" value="{{ $category->debut }}">
    <input type="text" name="agency" value="{{ $category->agency }}">
    <input type="text" name="popular" value="{{ $category->popular }}">
    <button type="submit">Update</button>
</form>