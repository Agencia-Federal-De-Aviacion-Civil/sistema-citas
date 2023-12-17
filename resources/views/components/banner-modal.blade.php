<div>
    <div class="flex items-center">
        <div
            class="h-14 w-14 bg-blue-200 rounded-full flex flex-shrink-0 justify-center items-center text-blue-500 text-2xl font-mono">
            @if ($icon === 'pointer')
                <svg class="w-6 h-6 bg-blue-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 13A6 6 0 1 0 7 1a6 6 0 0 0 0 12Zm0 0v6M4.5 7A2.5 2.5 0 0 1 7 4.5" />
                </svg>
            @elseif ($icon === 'map')
                <svg class="w-6 h-6 bg-blue-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 21">
                    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M8 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path
                            d="M13.8 12.938h-.01a7 7 0 1 0-11.465.144h-.016l.141.17c.1.128.2.252.3.372L8 20l5.13-6.248c.193-.209.373-.429.54-.66l.13-.154Z" />
                    </g>
                </svg>
            @endif
        </div>
        <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
            <h2 class="leading-relaxed py-1">{{ $title }}</h2>
            <p class="text-sm text-gray-500 font-normal leading-relaxed">{{ $information }}</p>
        </div>
    </div>
</div>
