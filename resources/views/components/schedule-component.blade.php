<div>
    {{-- <x-button wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})" label="REAGENDAR" xs blue right-icon="calendar" />                                             --}}
    @if ($status == 0)
        @hasrole('super_admin|medicine_admin')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})"
                label="PENDIENTE" xs silver />
        @else
            <x-badge flat info label="PENDIENTE" />
        @endhasrole
    @elseif($status == 1)
        @hasrole('super_admin|medicine_admin')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})"
                label=" ASISTIÓ " xs green />
        @else
            <x-badge flat green label="ASISTIÓ" />
        @endhasrole
    @elseif($status == 2)
        @hasrole('super_admin|medicine_admin')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})"
                label="CANCELADO" xs warning />
        @else
            <x-badge flat negative label="CANCELADA" />
        @endhasrole
    @elseif($status == 3)
        @hasrole('super_admin|medicine_admin')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})"
                label="USUARIO CANCELÓ" xs warning />
        @else
            <x-badge flat negative label="CANCELADA" />
        @endhasrole
    @elseif($status == 4)
        <x-button
            wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})"
            label="REAGENDADA" xs warning />
    @endif
    @if ($status == 0)
        @hasrole('super_admin|medicine_admin|user')
            <x-button xs positive href="{{ route('afac.downloadFile', $scheduleId) }}" label="DESCARGAR" />
        @endhasrole
    @endif
</div>