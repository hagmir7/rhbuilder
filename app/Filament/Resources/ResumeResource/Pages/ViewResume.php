<?php

namespace App\Filament\Resources\ResumeResource\Pages;

use App\Filament\Resources\ResumeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ViewResume extends ViewRecord
{
    protected static string $resource = ResumeResource::class;

    protected static string $view = 'filament.view-resume';

    public function getTitle(): Htmlable
    {
        return new HtmlString("<span class='text-xl'>{$this->getRecordTitle()}</span>");
    }
        
}
