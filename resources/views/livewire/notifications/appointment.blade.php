<div>
    <div class="ml-3 relative">
        <x-jet-dropdown align="right" width="60">
            <x-slot name="trigger">
                <span class="inline-flex rounded-md">
                    <button type="button" wire:click="resetNotificationCount()"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                        Notificaciones
                        {{-- @if (auth()->user()->notification) --}}
                        <span
                            class="ml-2 bg-red-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{ auth()->user()->notification }}</span>
                        {{-- @endif --}}
                    </button>
                </span>
            </x-slot>

            <x-slot name="content">
                <div class="w-60">
                    <!-- Team Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Citas agendadas') }}
                    </div>
                    <ul class="divide-y-2">
                        @foreach ($notifications as $notification)
                            <li wire:click="read('{{ $notification->id }}')"
                                class="{{ !$notification->read_at ? 'bg-gray-200' : '' }}">
                                <x-jet-dropdown-link class="text-gray-700" href="{{ $notification->data['url'] }}">
                                    {{ $notification->data['message'] }}
                                    <span
                                        class="text-xs font-bold">{{ $notification->created_at->diffForHumans() }}</span>
                                </x-jet-dropdown-link>
                        @endforeach
                        </li>
                    </ul>
                </div>
            </x-slot>
        </x-jet-dropdown>
    </div>
</div>
