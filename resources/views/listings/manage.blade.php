@extends('layout')

@section('content')
    <x-card>
        <header>
            <h1
                class="text-3xl text-center font-bold my-6 uppercase"
            >
                Manage Gigs
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                <!-- row -->
                @unless (count($listings) == 0)
                    @foreach ($listings as $listing)
                        <tr class="border-gray-300">
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a href="show.html">
                                    {{ $listing->title }}
                                </a>
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a
                                    href="/listings/{{ $listing->id }}/edit"
                                    class="text-blue-400 px-6 py-2 rounded-xl"
                                    ><i
                                        class="fa-solid fa-pen-to-square"
                                    ></i>
                                    Edit</a
                                >
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <form method="POST" action="/listings/{{ $listing->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <p
                                class="text-center"
                            >
                                No Listings Found
                            </p>
                        </td>
                    </tr>
                @endunless
                {{-- <tr class="border-gray-300">
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a href="show.html">
                            Laravel Senior Developer
                        </a>
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <a
                            href="edit.html"
                            class="text-blue-400 px-6 py-2 rounded-xl"
                            ><i
                                class="fa-solid fa-pen-to-square"
                            ></i>
                            Edit</a
                        >
                    </td>
                    <td
                        class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                    >
                        <form action="">
                            <button class="text-red-600">
                                <i
                                    class="fa-solid fa-trash-can"
                                ></i>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr> --}}
            </tbody>
        </table>
    </x-card>
@endsection