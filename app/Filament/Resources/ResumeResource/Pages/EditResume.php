<?php

namespace App\Filament\Resources\ResumeResource\Pages;

use App\Filament\Resources\ResumeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\HtmlString;

class EditResume extends EditRecord
{
    protected static string $resource = ResumeResource::class;


    public function getTitle(): string|HtmlString
    {
        return new HtmlString("<span class='text-xl'>{$this->getRecordTitle()} </span>");
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->color('success')
                ->url('/admin/resumes/create')
                ->icon('heroicon-o-plus-circle'),
            Actions\DeleteAction::make()
                ->color('danger')
                ->icon('heroicon-o-trash'),


        ];
    }
}
