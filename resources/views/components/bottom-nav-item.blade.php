@props(['tab', 'text', 'selectedTab'])

<button wire:click="selectTab({{ $tab }})"
@class([
    'uppercase',
    'text-xs',
    'text-euro-light',
    'text-center',
    'py-4',
    'hover:text-euro-lightest',
    'focus:outline-none',
    'text-euro-darkest font-medium' => $selectedTab === $tab,
])>
    <div @class([
        'flex',
        'flex-row',
        'rounded-full',
        'py-2',
        'px-6',
        'gap-4',
        'bg-euro-dark' => $selectedTab === $tab,
        ])>
        <span>{{ $slot }}</span>
        @if ($selectedTab === $tab)
            <span class="transition-transform ease-in-out delay-150 font-bold flex items-center">{{ $text }}</span>
        @endif
    </div>
</button>
