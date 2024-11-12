<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            @can('create users')
            <a class="bg-slate-900 text-white py-2 px-3 rounded-md" href="{{ route('users.create') }}">Create</a>
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
                    <th class="pl-10 py-3 text-left">Email</th>
                    <th class=" py-3 text-left">Roles</th>
                    <th class="pr-11 py-3 text-right">Created</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @if ($users->isNotEmpty())
                @foreach ($users as $user)

                <tr>
                    <td class="px-6 py-3 text-left">{{ $user->id }}</td>
                    <td class=" py-3 text-left">{{ $user->name }}</td>
                    <td class="px-6 py-3 text-left">{{ $user->email }}</td>
                    <td class=" py-3 text-left">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                    <td class="px-6 py-3 text-right">{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y')}}</td>
                    <td class="px-6 py-3 text-center">
                        @can('edit users')
                        <a class="bg-blue-400 text-white py-2 px-3 rounded-md" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        @endcan

                        @can('delete users')
                        <a class="bg-red-500 text-white py-2 px-3 rounded-md" onclick="deleteUser({{ $user->id }})" href="javascript:void(0)">Delete</a>
                        @endcan
                    </td>
                </tr>
                @endforeach

                @endif

            </tbody>
         </table>

         <div class="my-3">

             {{ $users->links() }}

         </div>


        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
        function deleteUser(id){
            if(confirm("Are you sure ?")) {
                $.ajax({
                    url : '{{  route("users.destroy") }}',
                    type: 'delete',
                    data: { id: id },
                    dataType: 'json',
                    headers: {
                        'x-csrf-token' : '{{ csrf_token() }}'
                    },
                    success: function(response){

                        window.location.href = '{{ route("users.index") }}'

                    }
                });
            }
        }
        </script>
    </x-slot>

</x-app-layout>
