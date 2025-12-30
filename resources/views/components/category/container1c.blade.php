<<<<<<< HEAD
@props(['category'])
<div class="flex justify-center m-8 gap-4">
    @foreach ($category as $cat)
    <div class="bg-white w-[300px] h-[350px] rounded-[10px]">
        <img class="rounded-[20px] w-[250px] relative top-[20px] left-[20px]" src="https://image.idntimes.com/post/20250814/inshot_20250814_084738472_924580f4-d183-45b5-b1d4-6447034c23ea.jpg" alt="">
        <h1 class="px-3 py-[50px] font-bold text-center text-2xl">{{ $cat->groupname }}</h1>
    </div>
    @endforeach
=======
<div class="flex justify-center m-8 gap-4">
    <div class="bg-white w-[300px] h-[350px] rounded-[10px]">
        <img class="rounded-[20px] w-[250px] relative top-[20px] left-[20px]" src="https://image.idntimes.com/post/20250814/inshot_20250814_084738472_924580f4-d183-45b5-b1d4-6447034c23ea.jpg" alt="">
        <h1 class="px-3 py-[50px] font-bold text-center text-2xl">CORTIS</h1>
    </div>
    <div class="bg-white w-[300px] h-[350px] rounded-[10px]">
        <img class="rounded-[20px] w-[250px] relative top-[20px] left-[20px]" src="https://upload.wikimedia.org/wikipedia/commons/9/91/Exo_monster_160618_suwon.png" alt="">
        <h1 class="px-3 py-[70px] font-bold text-center text-2xl">EXO</h1>
    </div>
    <div class="bg-white w-[300px] h-[350px] rounded-[10px]">
        <img class="rounded-[20px] w-[250px] relative top-[20px] left-[20px]" src="https://m.media-amazon.com/images/M/MV5BN2I1YTFlY2UtMjQ1MS00ZTZiLWJiNjMtNDhjZGEzODY1NmQxXkEyXkFqcGc@._V1_.jpg" alt="">
        <h1 class="px-3 py-[40px] font-bold text-center text-2xl">NEWJEANS</h1>
    </div>
    <div class="bg-white w-[300px] h-[350px] rounded-[10px]">
        <img class="rounded-[20px] w-[250px] relative top-[20px] left-[20px]" src="https://upload.wikimedia.org/wikipedia/commons/7/7c/191216_Stray_Kids_for_JYP_Entertainment_Audition_%281%29.png" alt="">
        <h1 class="px-3 py-[65px] font-bold text-center text-2xl">STRAY KIDS</h1>
    </div>
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
</div>