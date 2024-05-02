<div>
    @if ($status == 0)
        <span
            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-600">
            <span class="size-1.5 inline-block rounded-full bg-green-600"></span>
            ACTIVO
        </span>
    @elseif($status == 1)
        <span
            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-600">
            <span class="size-1.5 inline-block rounded-full bg-green-600"></span>
            Finalizado
        </span>
    @elseif($status == 2)
        <span
            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-600">
            <span class="size-1.5 inline-block rounded-full bg-red-600"></span>
            SUSPENDIDO
        </span>
    @endif
</div>
