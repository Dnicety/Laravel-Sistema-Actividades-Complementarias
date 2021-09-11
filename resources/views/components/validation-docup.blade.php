@if (session()->has('success'))
    <div class="bg-blue-600 text-white rounded-md p-2">
        {{session()->get('success')}}
    </div>
@endif