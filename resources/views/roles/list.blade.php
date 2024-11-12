<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            @can('create roles')
            <a class="bg-slate-900 text-white py-2 px-3 rounded-md" href="{{ route('roles.create') }}">Create</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <x-message></x-message>

         <table class="w-full border ">
            <thead class="bg-gray-400">
                <tr>
                    <th class="px-6 py-3 text-left">#Id</th>
                    <th class=" py-3 text-left">Name</th>
                    <th class="pl-10 py-3 text-center">Permission</th>
                    <th class="pr-11 py-3 text-right">Created</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @if ($roles->isNotEmpty())
                @foreach ($roles as $role)

                <tr>
                    <td class="px-6 py-3 text-left">{{ $role->id }}</td>
                    <td class="py-3 text-left">{{ $role->name }}</td>
                    <td class="px-3 py-3 text-center">{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                    <td class="px-6 py-3 text-right">{{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y')}}</td>
                    <td class="px-6 py-3 text-center grid gap-2">
                        @can('edit roles')
                        <a class="bg-blue-400 text-white py-2 px-3  rounded-md" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                        @endcan
                        @can('delete roles')
                        <a class="bg-red-500 text-white py-2  px-3 rounded-md" onclick="deleteRole({{ $role->id }})" href="javascript:void(0)">Delete</a>
                        @endcan
                    </td>
                </tr>
                @endforeach

                @endif

            </tbody>
         </table>

         <div class="my-3">

             {{ $roles->links() }}

         </div>


        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
        function deleteRole(id){
            if(confirm("Are you sure ?")) {
                $.ajax({
                    url : '{{  route("roles.destroy") }}',
                    type: 'delete',
                    data: { id: id },
                    dataType: 'json',
                    headers: {
                        'x-csrf-token' : '{{ csrf_token() }}'
                    },
                    success: function(response){

                        window.location.href = '{{ route("roles.index") }}'

                    }
                });
            }
        }
        </script>
    </x-slot>

</x-app-layout>
