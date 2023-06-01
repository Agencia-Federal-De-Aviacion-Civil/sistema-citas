<?php

namespace App\Http\Livewire\TesterUpload;

use App\Models\Tester;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Upload extends Component
{
    use Actions;
    use WithFileUploads;
    public $document;
    public function rules(){
        return [
            'document'=>'required|mimetypes:application/pdf|max:500'
            
        ];
    }
    public function render()
    {
        return view('livewire.tester-upload.upload');
    }
    public function save(){
        $this->validate();
        Tester::create([
            'document'=>$this->document->store('documentos','public'),
        ]);
        $this->notification([
            'title'       => 'DOCUMENTO GUARDADO!',
            'description' => 'Se guardó',
            'icon'        => 'indo',
            'timeout' => '2500'
        ]);
    }
}
