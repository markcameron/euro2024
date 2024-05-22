<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fixture Detail') }}
        </h2>
    </x-slot>

    <livewire:predictor.predictions-detail :fixture="$fixture" />

</x-app-layout>
