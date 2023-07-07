<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Appointments
        </h2>
    </x-slot>
    
    <div id="app" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-6 text-xl">
                <a href="{{ route('appointments.index') }}">Appointments</a>
            </div>
            <div class="flex flex-row space-x-4">
                <div class="w-full flex flex-col space-y-4 max-w-3xl">
                    <div>
                        <div>Pick an appointment date</div>
                        <input type="date" value="" name="" id="" v-model="date" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="my-6 font-semibold text-2xl">
                        Consultants
                    </div>
                    @foreach ($consultants as $consultant)
                        <div class="w-full p-4 flex justify-between  items-center bg-white">
                            <div>
                                {{ $consultant->name }}
                            </div>
                            <button class="bg-gray-300 p-4 rounded-sm" @@click="getConsutantShedule('{{ route('consultants.intervals', $consultant->id ) }}', '{{ $consultant->name }}', '{{ $consultant->id }}')">
                                See Available Slots >>
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="p-4 bg-gray-200">
                    <div class="my-4 font-semibold text-2xl">
                        Appointment Details
                    </div>
                    <div class="col flex-col space-y-3">

                        <input type="text" name="title" placeholder="title" v-model="title" id="">
                        <textarea type="text" name="description" placeholder="description" v-model="description" id=""></textarea>
                    </div>
                    <div class="my-3 font-semibold">@{{ date }}
                        <span v-if="consultant" class="p-2 bg-gray-300">
                            @{{ consultant }}
                        </span>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <div v-if="intvals?.length < 1">Please select a consultant</div>
                        <div v-for="interval in intvals">
                            <form action="{{ route('appointments.store') }}" method="post">
                                <input class="hidden" type="text" name="_token" id="" v-model="csrf">
                                <input class="hidden" type="text" name="day_id" v-model="interval.day_id">
                                <input class="hidden" type="text" name="interval_id" v-model="interval.id">
                                <input class="hidden" type="text" name="consultant_id" v-model="consultant_id">
                                <input class="hidden" type="text" name="title" v-model="title">
                                <input class="hidden" type="text" name="description" v-model="description">
                                <input class="hidden" type="text" name="user_id" value="{{ $user->id }}">
                                <button>
                                    @{{ interval.from }} - @{{ interval.to }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="module">
    import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';

    createApp({
        data() {
            return {
                title: 'Consultation',
                description: 'How to be a better dev',
                intervals: [],
                csrf: '{{ csrf_token() }}',
                consultant: null,
                consultant_id: null,
                date: '{{ date('Y-m-d') }}',
            }
        },
        computed: {
            intvals() {
                return this.intervals.map((el) => {
                    return {
                        from: el.from,
                        to: el.to,
                        id: el.id,
                        day_id: el.day_id,
                    }
                })
            }
        },
        methods: {
            getConsutantShedule(url, name, id) {
                axios.post(url, {
                    date: this.date
                })
                .then(res => {
                    this.consultant = name
                    this.consultant_id = id
                    this.intervals = res.data
                })
                .catch(err => {
                    alert(err?.response?.data?.message)
                    console.error(err);
                })
            },
        },
        watch: {
            date() {
                return this.intervals = []
            }
        }
    }).mount('#app')
    </script>
</x-app-layout>
