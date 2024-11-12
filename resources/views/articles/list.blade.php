<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            @can('create articles')

            <a class="bg-slate-900 text-white py-2 px-3 rounded-md" href="{{ route('articles.create') }}">Create</a>
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
                    <th class="pl-10 py-3 text-left">Name</th>
                    <th class="pl-10 py-3 text-left">Title</th>
                    <th class="pl-10 py-3 text-left">Content</th>
                    <th class="pr-11 py-3 text-right">Created</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @if ($articles->isNotEmpty())
                @foreach ($articles as $article)

                <tr>
                    <td class="px-6 py-3 text-left">{{ $article->id }}</td>
                    <td class="px-6 py-3 text-left">{{ $article->author }}</td>
                    <td class="px-6 py-3 text-left">{{ $article->title }}</td>
                    <td class="px-6 py-3 text-left">{{ $article->text }}</td>
                    <td class="px-6 py-3 text-right">{{ \Carbon\Carbon::parse($article->created_at)->format('d M, Y')}}</td>
                    <td class="px-6 py-3 text-center">
                        @can('edit articles')
                        <a class="bg-blue-400 text-white py-2 px-3 rounded-md" href="{{ route('articles.edit',$article->id) }}">Edit</a>
                        @endcan
                        @can('delete articles')

                        <a class="bg-red-500 text-white py-2 px-3 rounded-md" onclick="deleteArticle({{ $article->id }})" href="javascript:void(0)">Delete</a>
                        @endcan
                    </td>
                </tr>
                @endforeach

                @endif

            </tbody>
         </table>

         <div class="my-3">

             {{ $articles->links() }}

         </div>


        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
        function deleteArticle(id){
            if(confirm("Are you sure ?")) {
                $.ajax({
                    url : '{{  route("articles.destroy") }}',
                    type: 'delete',
                    data: { id: id },
                    dataType: 'json',
                    headers: {
                        'x-csrf-token' : '{{ csrf_token() }}'
                    },
                    success: function(response){

                        window.location.href = '{{ route("articles.index") }}'

                    }
                });
            }
        }
        </script>
    </x-slot>

</x-app-layout>
