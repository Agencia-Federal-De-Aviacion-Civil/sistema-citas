<div>
    {{-- <x-button wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})" label="REAGENDAR" xs blue right-icon="calendar" />                                             --}}
    @if ($status == 0)
        @hasrole('sub_headquarters|super_admin|medicine_admin|super_admin_medicine|headquarters|admin_medicine_v2')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
                label="PENDIENTE" xs silver />
        @else
            <x-badge flat info label="PENDIENTE" />
        @endhasrole
    @elseif($status == 1)
        @hasrole('super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2|headquarters')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
                label=" ASISTIÓ " xs green />
        @else
            <x-badge flat green label="ASISTIÓ" />
        @endhasrole
    @elseif($status == 2)
        @hasrole('super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2|sub_headquarters|headquarters')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
                label="CANCELADO" xs warning />
        @else
            <x-badge flat negative label="CANCELADA" />
        @endhasrole
    @elseif($status == 3)
        @hasrole('sub_headquarters|super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
                label="USUARIO CANCELÓ" xs warning />
        @else
            <x-badge flat negative label="CANCELADA" />
        @endhasrole
    @elseif($status == 4)
        <x-button
            wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
            label="REAGENDADA" xs warning />
        @hasrole('sub_headquarters|super_admin|medicine_admin|super_admin_medicine|user|admin_medicine_v2')
            <x-button xs positive href="{{ route('afac.downloadFile', $scheduleId) }}" label="DESCARGAR" />
        @endhasrole
    @elseif($status == 5)
        <x-button
            wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
            label="LLAVE LIBERADA" icon="key" xs cyan />
    @elseif($status == 6)
        <x-button
            wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
            label="COMPLETAR DATOS" icon="status-offline" xs red />
    @endif
    @if ($status == 0)
        @hasrole('sub_headquarters|super_admin|medicine_admin|super_admin_medicine|user|admin_medicine_v2')
            <x-button xs positive href="{{ route('afac.downloadFile', $scheduleId) }}" label="DESCARGAR" />
        @endhasrole
    @endif
</div>
