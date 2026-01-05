<form action="{{ route('admin.category.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
    @csrf

    <div class="flex flex-col items-center gap-4 mb-6">
        <div class="w-[200px] h-[200px] rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">
            Image Preview
        </div>

        <label
            for="groupimg"
            class="cursor-pointer bg-secondary text-[#5A6ACF] font-semibold px-4 py-2 rounded-lg hover:bg-gray-200 transition">
            Upload Image
        </label>

        <input
            type="file"
            name="groupimg"
            id="groupimg"
            class="hidden"
            accept="image/*"
        />
    </div>

    <div class="space-y-4">
        <input type="text" name="groupname" placeholder="Group Name"
            class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">

        <input type="text" name="type" placeholder="Type"
            class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">

        <input type="text" name="debut" placeholder="Debut Year"
            class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">

        <input type="text" name="agency" placeholder="Agency"
            class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">

        <input type="text" name="popular" placeholder="Popularity"
            class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mt-6">
        <button
            type="submit"
            class="bg-[#5A6ACF] text-white font-semibold px-5 py-2 rounded-lg hover:bg-[#4958b8] transition">
            Save Category
        </button>
    </div>
</form>
