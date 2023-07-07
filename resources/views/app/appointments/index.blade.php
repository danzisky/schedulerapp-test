<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Appointment
        </h2>
    </x-slot>
    
    <div id="app" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div  class="my-6 font-semibold text-2xl">
                <a class="my-4" href="{{ route('appointments.create') }}">Make New Appointment</a>
            </div>
            @if ($success ?? false)
                <div class="my-2 p-4 bg-gray-300">
                    {{ $success }}
                </div>
            @endif
            @if ($error ?? false)
                <div class="my-2 p-4 bg-red-300">
                    {{ $error }}
                </div>
            @endif
            <div class="flex flex-col space-y-4">
                @foreach ($appointments as $appointment)
                <a href="{{ route('appointments.show', $appointment->id) }}" class="w-full columns-2 bg-white p-4 hover:bg-gray-200" >
                    <div>
                        Consultant: {{ $appointment->consultant->name }}
                    </div> 
                    <div>
                        Title: {{ $appointment->title }}
                    </div> 
                    <div>
                        Description: {{ $appointment->description }}
                    </div> 
                    <div>
                        Date: {{ $appointment->interval->day->date }}
                    </div> 
                    <div>
                        From: {{ $appointment->interval->from }}
                    </div> 
                    <div>
                        To: {{ $appointment->interval->to }}
                    </div> 
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
