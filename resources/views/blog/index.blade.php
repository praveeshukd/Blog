<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">Blog List</h1>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <a href="{{ route('blog.create') }}" class="btn bg-green-500 text-white px-4 py-2 rounded mb-4 hover:bg-green-600">Create Blog</a>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="py-3 px-6 font-semibold text-gray-600">No.</th>
                        <th class="py-3 px-6 font-semibold text-gray-600">Name</th>
                        <th class="py-3 px-6 font-semibold text-gray-600">Author</th>
                        <th class="py-3 px-6 font-semibold text-gray-600">Content</th>
                        <th class="py-3 px-6 font-semibold text-gray-600">Image</th>
                        <th class="py-3 px-6 font-semibold text-gray-600">Date</th>
                         <th class="py-3 px-6 font-semibold text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-6">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6">{{ $blog->name }}</td>
                            <td class="py-3 px-6">{{ $blog->author }}</td>
                            <td class="py-3 px-6">{{ $blog->content }}</td>
                            <td class="py-3 px-6">{{ $blog->image }}</td>
                            <td class="py-3 px-6">{{ $blog->created_at->format('Y-m-d H:i') }}</td>
                            <td class="py-3 px-6 space-x-2">
                            <a href="{{ route('blog.edit', $blog->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                            <button type="submit" id="delete" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" data-id="{{ $blog->id }}">Delete</button>
                            <a href="{{ route('comment.show', $blog->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Comment</a>   
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
$(document).on('click', '#delete', function(e) {
    e.preventDefault(); 
    var blogId = $(this).data('id'); 

    if (confirm('Are you sure you want to delete this blog?')) {
        $.ajax({
            url: '{{ route('blog.delete') }}', 
            type: 'POST',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'), 
                'id': blogId 
            },
            success: function(response) {
                alert(response.success); 
                 location.reload(); 
            },
            error: function(xhr, status, error) {
                 location.reload(); 
            }
        });
    }
});

</script>


