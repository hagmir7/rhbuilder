<?php

namespace App\Filament\Resources\RecruitmentResource\Pages;

use App\Filament\Resources\RecruitmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\HtmlString;

class EditRecruitment extends EditRecord
{
    protected static string $resource = RecruitmentResource::class;

    public function getTitle(): string|HtmlString
    {
        return new HtmlString("<span class='text-xl'>{$this->getRecordTitle()} </span>");
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->color('success')
                ->url('/admin/recruitments/create')
                ->icon('heroicon-o-plus-circle'),
            Actions\DeleteAction::make()
                ->color('danger')
                ->icon('heroicon-o-trash'),
        ];
    }
}
