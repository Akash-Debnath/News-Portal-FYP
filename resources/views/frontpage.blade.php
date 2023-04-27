<x-slot name="header">
    {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        News
    </h2> --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active px-6" href="#"><b>News</b><span class="sr-only">(current)</span></a>
                @foreach($categories as $category)
                    <a class="nav-item nav-link px-3 {{ ($category->id) ==  ($currentCategoryId ?? '') ? 'active' : '' }}" href="{{ url('dashboard/categories/'. $category->id .'/posts') }}">{{ $category->title }}</a>
                @endforeach
            </div>
        </div>
    </nav>
</x-slot>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                    role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

  
            @if (Request::getPathInfo() == '/dashboard/posts')
                <button wire:click="create()"
                    class="inline-flex items-center px-4 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    Create New Post
                </button>
            @endif
            
            {{-- @if ($isOpen)
                @include('livewire.posts.create')
            @endif --}}
            @if (Request::getPathInfo() == '/dashboard/posts')
            <div class="card-body">
                <table class="table table-borderless table-success">
                    <tr class="bg-gradient-olive">
                        <td colspan="2">
                            <div class="py-2 h6 m-0 text-center"><b>Recommended Articles</b> </div>
                        </td>
                    </tr>
                </table>
                <div class="row">
                    @foreach($recommendedPosts as $recommendedpost)
                        <div class="col-md-4">
                            <div class="card rounded overflow-hidden shadow-lg">
                                {{-- <img class="card-img-top" src="" alt="Card image cap"> --}}
                                @foreach($recommendedpost->images as $key => $image)
                                    @if($key == 0)
                                        <div class="px-6 py-4">
                                            <img src="{{ $image->url }}" alt="{{ $image->description }}" width="300" height="200">
                                        </div>
                                    @endif
                                @endforeach
                                <div class="card-body">
                                    <h5 class="card-title font-bold text-xl">{{ $recommendedpost->title ?? '' }}</h5>
                                    <p class="card-text pb-4">{{ Str::words($recommendedpost->content ?? '', 10, '...') }}</p>
                                    {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                    <form method="POST" action="{{ url('posts/views') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $recommendedpost->id ?? '' }}" />
                                        <button type="submit" class="btn btn-primary">Read</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>        
            </div> 
            @endif
            
            <table class="table table-borderless table-info">
                <tr class="bg-gradient-olive">
                    <td colspan="2">
                        <div class="py-2 h6 m-0 text-center"><b>Articles</b> </div>
                    </td>
                </tr>
            </table>
            <div class="grid grid-flow-row grid-cols-3 gap-4">
                @foreach ($posts as $post)
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="px-6 py-4">
                            {{-- @foreach ($post->images as $image)
                                <div class="px-6 py-4">
                                    <img src="{{ $image->url }}" alt="hey" width="300" height="200">
                                </div>
                            @endforeach --}}
                            @foreach($post->images as $key => $image)
                                @if($key == 0)
                                    <div class="px-6 py-4">
                                        <img src="{{ $image->url }}" alt="{{ $image->description }}" width="300" height="200">
                                    </div>
                                @endif
                            @endforeach

                            <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
                            <p class="text-gray-700 text-base">
                                {{ Str::words($post->content, 10, '...') }}
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <a href="{{ url('dashboard/posts', $post->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                <form method="POST" action="{{ url('posts/views') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $post->id }}" />
                                    <button type="submit">READ POST</button>
                                </form>
                            </a>
                            <button wire:click="edit({{ $post->id }})"
                                class="inline-flex items-center px-4 py-2 bg-yellow-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-yellow disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </button>
                            <button wire:click="delete({{ $post->id }})"
                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="py-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>
