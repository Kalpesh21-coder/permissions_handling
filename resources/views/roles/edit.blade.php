<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roles Edit
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('roles.update', $role->id) }}" method="post">
                        @csrf
                        <div>
                            <label class="text-lg font-medium" for="">Name</label>
                            <div class="my-3">
                                <input autofocus name="name" placeholder="name"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                    value="{{ old('name', $role->name) }}" type="text">

                                @error  ('name')
                                    <div class="text-red-600 ">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="grid grid-cols-4">

                                @if ($permissions->isNotEmpty())

                                    @foreach ($permissions as $permission)
                                        <div class="my-3">

                                            <input {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }}
                                                type="checkbox" class="rounded " id="permission-{{ $permission->id }}"
                                                name="permission[]" value="{{ $permission->name }}">
                                            <label
                                                for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                @endif


                            </div>

                            <div class="flex justify-between">

                                <button class="bg-slate-900 text-white py-3 px-5 rounded-md">Update</button>
                                <a class="bg-slate-900 text-white py-3 px-5 rounded-md"
                                    href="{{ route('roles.index') }}">Back</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
