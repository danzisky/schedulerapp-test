<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div id="app" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('appointments.create') }}">Create Appintment</a>
            <div class="flex flex-row space-x-4">
                <div class="w-full flex flex-col space-y-4 max-w-3xl">
                    <div>
                        <input type="date" value="" name="" id="" v-model="date">
                    </div>
                    @foreach ($consultants as $consultant)
                        <div class="w-full p-4 flex justify-between  items-center bg-white">
                            <div>
                                {{ $consultant->name }}
                            </div>
                            <button @@click="getConsutantShedule('{{ route('consultants.intervals', $consultant->id ) }}', '{{ $consultant->name }}')">
                                See Times
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="p-4 bg-gray-200">
                    <div>@{{ message }}</div>
                    <div class="my-2">@{{ date }}
                        <span v-if="consultant" class="p-2 bg-gray-300">
                            @{{ consultant }}
                        </span>
                    </div>
                    {{-- <div>@{{ intvals }}</div> --}}
                    <div class="flex flex-col space-y-2">
                        <div v-if="intvals?.length < 1">Please select a consultant</div>
                        <div v-for="interval in intvals">
                            <a href="appointments">
                                @{{ interval.from }} - @{{ interval.to }}
                            </a>
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
                message: 'Hello Vue!',
                intervals: [],
                consultant: null,
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
            getConsutantShedule(url, name) {
                axios.post(url, {
                    date: this.date
                })
                .then(res => {
                    this.consultant = name
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
                // alert(this.date)
                return this.intervals = []
            }
        }
    }).mount('#app')
    </script>
</x-app-layout>
