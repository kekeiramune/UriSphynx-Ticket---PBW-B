<form action="{{ route('admin.category.store') }}" method="POST">
    @csrf
    <input type="text" name="groupname" placeholder="Category name">
    <input type="text" name="type" placeholder="Type">
    <input type="text" name="debut" placeholder="Debut Year">
    <input type="text" name="agency" placeholder="Agency">
    <input type="text" name="popular" placeholder="Popularity">
    <button type="submit">Save</button>
</form>
