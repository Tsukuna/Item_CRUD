@extends('vouchers.layout')
@section('breadcrumb')
    Manage Cateogry
@endsection
@section('content')
@if(session('success'))
    <div id="success-alert" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-400" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            {{ session('success') }}
        </div>
    </div>

    <script>
        // Set a timer to hide the alert after 3 seconds
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease"; // Optional: Add a fade-out transition
                alert.style.opacity = '0'; // Fade out the alert
                setTimeout(() => alert.remove(), 500); // Remove from DOM after fade-out
            }
        }, 3000); // 3000 ms = 3 seconds
    </script>
@endif
    <section>

        <div class="relative border border-1 border-slate-300 overflow-x-auto shadow-md sm:rounded-lg my-32">
            <div class="flex justify-between m-5">
                <!-- Search Form -->
                <form class="max-w-lg" action="{{route('category.search')}}" method="GET">
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" name="query"
                            class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                             required />
                    </div>
                </form>

                <!-- drawer component -->
                <div id="drawer-right-example"
                    class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
                    tabindex="-1" aria-labelledby="drawer-right-label">
                       <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                          <span class="sr-only">Close menu</span>
                       </button>
                    <form action="{{route('category.store')}}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label for="default-search mb-5">Category Name</label>
                                <input type="text" id="default-search" name="name"
                                    class="block w-full px-2 p-2  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                      />

                                     @error('name')

                                     <p class="text-red-500">{{$message}}</p>

                                     @enderror
                            </div>
                            <div>
                                <label for="message" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Description
                                </label>
                                <textarea id="message" rows="4" name="description"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                                </textarea>
                                @error('name')

                                <p class="text-red-500">{{$message}}</p>

                                @enderror
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="{{route('category.index')}}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</a>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Create Button -->
                <div>
                    <div class="text-center">
                        <div class="text-center">
                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                type="button" data-drawer-target="drawer-right-example"
                                data-drawer-show="drawer-right-example" data-drawer-placement="right"
                                aria-controls="drawer-right-example">
                                Create Category
                            </button>
                            <a href="{{route('category.index')}}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            type="button">
                            Category List
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        {{-- <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                <input id="select-all-checkbox" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </th> --}}
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($categories as $category)
                   <tr
                   class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                   <td class="px-6 py-4">
                       <div class="flex items-center">
                           {{$loop->iteration}}
                       </div>
                   </td>
                   <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       <!-- Product -->
                       <div class="flex items-center gap-x-2">

                           <div>
                            {{$category->name}}
                           </div>
                       </div>
                   </th>
                   <td class="px-6 py-4">
                       <!-- Category -->
                       {{$category->description}}
                   </td>

                   <td class="px-6 py-4">
                       <!-- Action Buttons -->
                       <div class="inline-flex rounded-md shadow-sm" role="group">
                           <a href="{{route('category.edit',$category->id)}}"
                               class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                               Edit
                           </a>

                           {{-- <form action="{{route('category.edit',$category->id)}}" method="POST">
                            @csrf
                            <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                               Edit
                           </button>
                           </form> --}}

                           <form action="{{route('category.destroy',$category->id)}}" method="POST" onsubmit="return confirmDelete()">
                            @csrf
                            @method('delete')
                            <button type="submit"
                               class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                               Delete
                           </button>
                           </form>
                       </div>
                   </td>
               </tr>
                   @endforeach
                </tbody>
            </table>
        </div>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    <script>
        function confirmDelete(){
            return confirm('Are you sure to delete?')
        }
    </script>

    <div>
        {{$categories->links('pagination::tailwind')}}
    </div>
@endsection
