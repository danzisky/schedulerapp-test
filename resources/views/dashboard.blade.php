<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('appointments.create') }}">Create Appintment</a>
            <div class="">
                <div class="my-6">
                    Next Appointments
                </div>
                <div class="flex flex-col space-y-4">
                @foreach ($appointments as $appointment)
                <div class="w-full columns-2 bg-white p-4">
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
                </div>
                @endforeach
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
