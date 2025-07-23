<div>
    @if ($tipo == 3 || $tipo == 5)


    {{-- {{ Str::beforeLast(Str::between($id, '-','-'), '-') }} --}}


    <div class="grid grid-cols-2 gap-2">
        @if(Str::beforeLast(Str::between($id, '-','-'), '-') <='2024') {{-- 1 --}} 
        <buttom title="FORMATO DE PAGO"
            class="cursor-pointer underline hover:no-underline" wire:click='documentDownload({{ $id_document }})'>
            <span class="text-sm" wire:loading wire:target="documentDownload({{ $id_document }})">
                <i class="fas fa_spinner fa-spin"></i> Procesando
            </span>            
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="text-blue-700 w-6 h-6 flex-shrink-0 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z">
                </path>
            </svg>
            </buttom>
            @else
            <a title="FORMATO DE PAGO" class="underline hover:no-underline" target='_blank' href='{{ $id }}'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-blue-700 w-6 h-6 flex-shrink-0 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z">
                    </path>
                </svg>
            </a>
            @endif

            @if (Str::beforeLast(Str::between($id, '-','-'), '-') <='2024') {{-- 2 --}} 
            <buttom title="FORMATO DE AUTORIZACIÓN" class="cursor-pointer underline hover:no-underline"
                wire:click='documentDownload({{ $id_document }})'>
                <span class="text-sm" wire:loading wire:target="documentDownload({{ $id_document }})">
                    <i class="fas fa_spinner fa-spin"></i> Procesando
                </span>                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="underline text-warning-600 w-6 h-6 ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z">
                    </path>
                </svg>
                </buttom>
                @else
                <a title="FORMATO DE AUTORIZACIÓN" class="underline hover:no-underline" target='_blank'
                    href='{{ $id }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="underline text-warning-600 w-6 h-6 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z">
                        </path>
                    </svg>
                </a>
                @endif
    </div>
    @else
    @if ($medicine[0]->medicineReserveMedicine->document_id == null)
    NO APLICA
    @else

    @if (Str::beforeLast(Str::between($id, '-','-'), '-') <='2024') 
    <buttom title="FORMATO DE PAGO"
        class="cursor-pointer underline hover:no-underline" wire:click='documentDownload({{ $id_document }})'>
        <span class="text-sm" wire:loading wire:target="documentDownload({{ $id_document }})">
            <i class="fas fa_spinner fa-spin"></i> Procesando
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="text-blue-700 w-6 h-6 flex-shrink-0 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z">
            </path>
        </svg>
        </buttom>
        @else
        <a title="FORMATO DE PAGO" class="underline hover:no-underline" target="_blank" href='{{ $id }}'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="text-blue-700 w-6 h-6 flex-shrink-0 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z">
                </path>
            </svg>
        </a>
        @endif

        @endif
        @endif
</div>