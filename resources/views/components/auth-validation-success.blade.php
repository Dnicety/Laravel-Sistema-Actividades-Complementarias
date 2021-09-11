@if (Session::has('success'))
<div style="position: absolute; top: 10%; left: 40%; right: 40%;" x-data="{ show: true }" x-show="show" class="bg-green-600 rounded-md">
  <div class="flex items-center py-4">
    <div class="ml-4">
      <h1 class="text-white">Operacion exitosa</h1>
      <p class="text-white">{{Session::get('success')}}</p>
    </div>
    <div class="mx-4">
      <button type="button" @click="show = false" class="text-black">
        <span class="text-2xl">&times;</span>
      </button>
    </div>
  </div>
</div>
@endif