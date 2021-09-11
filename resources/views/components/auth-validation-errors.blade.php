@props(['errors'])

@if ($errors->any())
<div style="position: absolute; top: 10%; left: 40%; right: 40%;" x-data="{ show: true }" x-show="show" class="bg-red-600 rounded-md">
    <div class="flex items-center py-4">
        <div class="ml-4">
            <h1 class="text-white">Error!</h1>
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <div class="mx-4">
            <button type="button" @click="show = false" class="text-black">
                <span class="text-2xl">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif
