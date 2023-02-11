<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="messages" style="height:50vh; overflow-y: auto;" class="p-6 bg-white border-b border-gray-200">
                </div>
                <form method="post" action="{{route('chat')}}" id="chat-form">
                    @csrf
                    <input type="text" name="message">
                    <button type="submit" style="background-color:aqua">Send</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>