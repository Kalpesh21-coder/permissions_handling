<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Create
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div>
                            <label class="text-lg font-medium" for="">Name</label>
                            <div class="my-3">
                                <input autofocus name="name" placeholder="name"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    value="{{ old('name') }}" type="text">

                                @error('name')
                                    <div class="text-red-600 ">{{ $message }}</div>
                                @enderror

                            </div>

                            <div>

                                <label class="text-lg font-medium" for="">Email</label>
                                <div class="my-3">
                                    <input  name="email" placeholder="email"
                                        class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                        value="{{ old('email') }}" type="text">

                                    @error('email')
                                        <div class="text-red-600 ">{{ $message }}</div>
                                    @enderror

                                </div>

                            <div>
                                <label class="text-lg font-medium" for="">Password</label>
                                <div class="my-3">
                                    <input  name="password" placeholder="password"
                                        class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                        value="{{ old('password') }}" type="text">

                                    @error('password')
                                        <div class="text-red-600 ">{{ $message }}</div>
                                    @enderror

                                </div>

                            <div>
                                <label class="text-lg font-medium" for="">Confirm-Password</label>
                                <div class="my-3">
                                    <input  name="confirm_password" placeholder="password"
                                        class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                        value="{{ old('confirm_password') }}" type="text">

                                    @error('confirm_password')
                                        <div class="text-red-600 ">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="grid grid-cols-4">

                                    @if ($roles->isNotEmpty())

                                        @foreach ($roles as $role)
                                            <div class="my-3">


                                                <input   type="checkbox" class="rounded " id="role-{{ $role->id }}"
                                                    name="role[]" value="{{ $role->name }}">
                                                <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                    @endif


                                </div>

                                <div class="flex justify-between">

                                    <button class="bg-slate-900 text-white py-3 px-5 rounded-md">Create</button>
                                    <a class="bg-slate-900 text-white py-3 px-5 rounded-md"
                                        href="{{ route('users.index') }}">Back</a>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>