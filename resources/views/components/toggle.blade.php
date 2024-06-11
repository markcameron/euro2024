<div class="flex items-center justify-end w-full mb-4 mr-2">
    <label
        for="toggleStats"
        class="flex items-center cursor-pointer"
    >
        <!-- label -->
        <div class="mr-3 text-euro font-bold">
            {{ $label }}
        </div>
        <!-- toggle -->
        <div class="relative">
            <!-- input -->
            <input id="toggleStats" type="checkbox" class="sr-only" wire:click="toggleStats"/>
            <!-- line -->
            <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
            <!-- dot -->
            <div class="dot absolute w-6 h-6 bg-euro-light rounded-full shadow -left-1 -top-1 transition"></div>
        </div>

    </label>
</div>

<style>
    /* Toggle B */
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #486581;
    }
</style>
