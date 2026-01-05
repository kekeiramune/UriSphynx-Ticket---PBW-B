<form method="POST"
      action="{{ route('admin.category.update', $category->idgroup) }}"
      enctype="multipart/form-data"
      class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
    @csrf
    @method('PUT')

    {{-- Image preview --}}
    <div class="flex flex-col items-center gap-4 mb-6">
        <img
            src="{{ $category->groupimg
                ? asset('storage/' . $category->groupimg)
                : asset('placeholder.jpg') }}"
            class="w-[200px] h-[200px] rounded-xl object-cover"
        />

        <label
            for="groupimg"
            class="cursor-pointer bg-secondary text-[#5A6ACF] font-semibold px-4 py-2 rounded-lg hover:bg-gray-200 transition">
            Change Image
        </label>

        <input
            type="file"
            name="groupimg"
            id="groupimg"
            class="hidden"
            accept="image/*"
        />
    </div>

    {{-- Inputs --}}
    <div class="space-y-4">
        <div>
            <label class="font-semibold">Group Name</label>
            <input
                type="text"
                name="groupname"
                value="{{ old('groupname', $category->groupname) }}"
                class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="font-semibold">Type</label>
            <input
                type="text"
                name="type"
                value="{{ old('type', $category->type) }}"
                class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="font-semibold">Debut Year</label>
            <input
                type="text"
                name="debut"
                value="{{ old('debut', $category->debut) }}"
                class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="font-semibold">Agency</label>
            <input
                type="text"
                name="agency"
                value="{{ old('agency', $category->agency) }}"
                class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="font-semibold">Popularity</label>
            <input
                type="text"
                name="popular"
                value="{{ old('popular', $category->popular) }}"
                class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex gap-3 mt-6">
        <button
            type="submit"
            class="bg-[#5A6ACF] text-white font-semibold px-5 py-2 rounded-lg hover:bg-[#4958b8] transition">
            Update
        </button>

        <a
            href="{{ route('admin.categorymanage') }}"
            class="bg-gray-100 text-gray-600 font-semibold px-5 py-2 rounded-lg hover:bg-gray-200 transition">
            Cancel
        </a>
    </div>
</form>
