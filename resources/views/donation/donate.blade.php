<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create New Blog') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @include('common.errors')
          <form class="mb-6" action="{{ route('donation.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input class="border py-2 px-3 text-grey-darkest" type="hidden" name="blog_id" id="blog_id" value="{{$blog_id}}">
           
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="name">name</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="name" id="name">
            </div>
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="email">e-mail</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="email" id="email">
            </div>
            <div class="flex flex-col mb-4">
               <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="donation">donate</label>
               
               <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="donation1">5</label>
                 <input class="border py-2 px-3 text-grey-darkest" type="radio" name="donation" id="donation1" value="5">
	               <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="donation2">10</label>
	               <input class="border py-2 px-3 text-grey-darkest" type="radio" name="donation" id="donation2" value="10">
	               <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="donation3">15</label>
	               <input class="border py-2 px-3 text-grey-darkest" type="radio" name="donation" id="donation3" value="15">
	            
            </div>
            
            <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              Create
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>