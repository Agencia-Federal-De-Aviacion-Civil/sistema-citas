<div>
{{-- <x-button wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})" label="REAGENDAR" xs blue right-icon="calendar" />                                             --}}

@if($status==0)
<x-button wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})" label="PENDIENTE" xs silver />
@elseif($status==1)
<x-button wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})" label=" ASISTIÓ " xs green />
@elseif($status==2)
<x-button wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})" label="CANCELADO" xs warning />
 @elseif($status==3)
<x-button wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})" label="CANCELO" xs warning />
@endif
</div>
