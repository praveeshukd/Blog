<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">{{ $blog->name }}</h1>
    </x-slot>
    <div class="container mx-auto p-6">
        <div class="blog-post">
            <h2 class="text-2xl font-bold text-gray-900">{{ $blog->name }}</h2>
            <p><strong>Author:</strong> {{ $blog->author }}</p>
            <p><strong>Published on:</strong> {{ $blog->created_at->format('M d, Y') }}</p>
            <div class="content mt-4">
                {!! nl2br(e($blog->content)) !!}
            </div>
            @if ($blog->image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Post Image" class="w-full rounded-md">
                </div>
            @endif
        </div>

        <hr class="my-6">
        <div class="comments-section">
            <h3 class="text-xl font-semibold">Comments ({{ $blog->comments->count() }})</h3>
            @foreach ($blog->comments as $comment)
                <div class="comment mt-4 p-4 border border-gray-300 rounded-md">
                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                    <small class="text-gray-500">Posted on: {{ $comment->created_at->format('M d, Y H:i') }}</small>
                    @auth
                        @if ($comment->user_id === auth()->user()->id)
                            <div class="mt-2">
                                <button onclick="editForm({{ $comment->id }})" class="text-blue-500">Edit</button>
                                <button id="delete" class="text-red-500" data-id="{{ $comment->id }}">Delete</button>
                            </div>
                            <div id="edit-form-{{ $comment->id }}" class="hidden mt-2">
                                <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="content" class="w-full p-2 border border-gray-300 rounded-md" required>{{ $comment->content }}</textarea>
                                    <button type="submit" class="mt-2 bg-blue-500 text-white py-1 px-4 rounded-md hover:bg-blue-600">Update Comment</button>
                                                                        <button type="submit" class="mt-2 bg-blue-500 text-white py-1 px-4 rounded-md hover:bg-blue-600">Update Comment</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach
            @auth
                <form method="POST" action="{{ route('comment.store', $blog->id) }}" class="mt-6">
                    @csrf
                     <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <textarea name="content" placeholder="Add a comment..." class="w-full p-4 border border-gray-300 rounded-md" required></textarea>
                    <button type="submit" class="mt-2 w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600"> Post Comment</button>
                
                </form>
            @else
                <p class="mt-4 text-gray-500">Please <a href="{{ route('login') }}" class="text-blue-500">log in</a> to post a comment.</p>
            @endauth
        </div>
    </div>

</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function editForm(commentId) {
        var editForm = document.getElementById('edit-form-' + commentId);
        editForm.classList.toggle('hidden');
    }
    
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var commentId = $(this).data('id'); 

        if (confirm('Are you sure you want to delete this comment?')) {
            $.ajax({
                url: '/comment/' + commentId, 
                type: 'DELETE',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'), // CSRF token
                },
                success: function (response) {
                    alert(response.message); 
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert('Failed to delete the comment. Please try again.');
                    location.reload(); 
                }
            });
        }
    });

</script>
