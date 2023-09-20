<div>
    @if ($status == 0)
        @hasrole('sub_headquarters|super_admin|medicine_admin|super_admin_medicine|headquarters|admin_medicine_v2|headquarters_authorized')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
                label="PENDIENTE" xs silver />
        @else
            @if ($buttonExpire)
                <x-button
                    wire:click="$emit('openModal', 'medicine.modals.cancel-appointment-user-modal', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
                    label="CANCELAR" xs red />
            @else
                <x-badge flat info label="PENDIENTE" />
            @endif
        @endhasrole
    @elseif($status == 1)
        @hasrole('super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2|headquarters|headquarters_authorized')
            <x-button
                wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
                label=" ASISTIÓ" xs green />
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
        @hasrole('sub_headquarters|super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2')    
        <x-button
            wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
            label="REAGENDADA" xs warning />
        @else
        <x-badge flat warning label="REAGENDADA" />
        @endhasrole
        <x-button xs positive href="{{ route('afac.downloadFile', $scheduleId) }}" label="DESCARGAR" />
    @elseif($status == 5)
        @hasrole('sub_headquarters|super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2')
        <x-button
            wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
            label="LLAVE LIBERADA" icon="key" xs cyan />
        @else
        <x-badge flat negative label="CANCELADA" />
        @endhasrole
    @elseif($status == 6)
        @hasrole('super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2|headquarters')
        <x-button
            wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
            label="COMPLETAR DATOS" icon="status-offline" xs red />
        @else
        <x-badge flat info label="PENDIENTE" />
        @endhasrole
    @elseif($status == 7)
        @hasrole('sub_headquarters|super_admin|medicine_admin|super_admin_medicine|headquarters|admin_medicine_v2|headquarters_authorized')
            @if ($days > 20 && $this->date > $wait_date)
                <x-button
                    wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
                    label="EL PLAZO EXPIRO" xs red />
                <x-button xs positive href="{{ route('afac.downloadFile', $scheduleId) }}" label="DESCARGAR" />
            @else
                <x-button
                    wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId, 'medicineId' => $medicineId]) }})"
                    label="REANUDAR" xs primary />
                <x-button xs positive href="{{ route('afac.downloadFile', $scheduleId) }}" label="DESCARGAR" />
            @endif
        @else


        @if ($days > 20 && $this->date > $wait_date)
        <x-badge flat red label="CITA APLAZADA EXPIRO" />
        @else
        <x-badge flat default label="CITA APLAZADA" />
        @endif

        @endhasrole
    @endif
    @if ($status == 0)
        @hasrole('sub_headquarters|super_admin|medicine_admin|super_admin_medicine|user|admin_medicine_v2|headquarters_authorized')
            <x-button xs positive href="{{ route('afac.downloadFile', $scheduleId) }}" label="DESCARGAR" />
        @endhasrole
    @endif
    @if ($status == 8)
        <x-badge flat positive label="CONCLUYÓ APTO" />
    @elseif($status == 9)
        <x-badge flat negative label="CONCLUYÓ NO APTO />
    @endif
</div>
