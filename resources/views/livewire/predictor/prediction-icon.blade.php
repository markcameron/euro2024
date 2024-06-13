<?php

use function Livewire\Volt\{computed,state};

state([
    'prediction' => null,
]);

$predictionStatus = computed(function () {
    return $this->prediction->getPredictionStatus();
});

$icon = computed(function () {
    return $this->predictionStatus?->icon();
});

$color = computed(function () {
    return $this->predictionStatus?->color();
});

?>

<x-icon name="{{ $this->icon }}" class="{{ $this->color }} w-8 h-8"></x-icon>
