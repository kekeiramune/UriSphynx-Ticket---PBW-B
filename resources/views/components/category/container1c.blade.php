@props(['category'])
<div class="flex justify-center m-8 gap-4">
    @foreach ($category as $cat)
    <div class="bg-white w-[300px] h-[350px] rounded-[10px]">
        <img class="rounded-[20px] w-[250px] relative top-[20px] left-[20px]" src="https://image.idntimes.com/post/20250814/inshot_20250814_084738472_924580f4-d183-45b5-b1d4-6447034c23ea.jpg" alt="">
        <h1 class="px-3 py-[50px] font-bold text-center text-2xl">{{ $cat->groupname }}</h1>
    </div>
    @endforeach
</div>