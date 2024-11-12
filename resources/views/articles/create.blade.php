<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            Articles Create
        </h2>
    </x-slot>

    <div class="py-4 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('articles.store') }}" method="post">
                    @csrf

                    <div>
                        <label class="text-lg font-medium" for="">Author Name</label>
                        <div class="my-3">
                            <input autofocus name="author" placeholder="author name"
                                class="border-gray-300 shadow-sm w-1/2 rounded-lg" value="{{ old('author') }}"
                                type="text">

                            @error('author')
                                <div class="text-red-600 ">{{ $message }}</div>
                            @enderror

                        </div>




                        <label class="text-lg font-medium" for="">Title</label>
                        <div class="my-3">
                            <input  name="title" placeholder="title"
                                class="border-gray-300 shadow-sm w-1/2 rounded-lg" value="{{ old('title') }}"
                                type="text">

                            @error('title')
                                <div class="text-red-600 ">{{ $message }}</div>
                            @enderror

                        </div>



                        <label class="text-lg font-medium" for="">About</label>
                        <div class="my-3">
                            <textarea  name="text" placeholder="content" cols="30" rows="7"
                                class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                type="text">{{ old('text') }}</textarea>


                        </div>


                        <div class="flex justify-between">

                            <button class="bg-slate-900 text-white py-3 px-5 rounded-md">Create</button>
                            <a class="bg-slate-900 text-white py-3 px-5 rounded-md"
                                href="{{ route('articles.index') }}">Back</a>
                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
