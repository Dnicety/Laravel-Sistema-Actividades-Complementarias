<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                  Administrador
                  @include('components.carousel')
                  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
  var cont=0;

  function sliderButton1(){
      $("#slider-2").fadeOut(400);
      $("#slider-1").delay(400).fadeIn(400);
      $("#sButton2").removeClass("bg-blue-600");
      $("#sButton1").addClass("bg-blue-600");
      reinitLoop(4000);
      cont=0;
  }
  
  function sliderButton2(){
      $("#slider-1").fadeOut(400);
      $("#slider-2").delay(400).fadeIn(400);
      $("#sButton1").removeClass("bg-blue-600");
      $("#sButton2").addClass("bg-blue-600");
      reinitLoop(4000);
      cont=1;
  }

  $(window).ready(function(){
      $("#slider-2").hide();
      $("#sButton1").addClass("bg-blue-600");
  });

</script>