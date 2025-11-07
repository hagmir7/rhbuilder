<?php

namespace App\Filament\Resources\RecruitmentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResumesRelationManager extends RelationManager
{
    protected static string $relationship = 'resumes';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable()
                    ->label(__("Nom complet")),
                Tables\Columns\TextColumn::make('experience_month')
                    ->numeric()
                    ->sortable()
                    ->state(fn($record): int => $record->getExperience())
                    ->label(__("Expérience"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('level')
                    ->label(__("Diplôme"))
                    ->state(fn($record) => $record->diplomas->last()?->level->name)
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label(__("Ville"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('work_post')
                    ->state(fn($record) => $record->experiences->last()?->work_post)
                    ->label(__("Poste"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(__("E-mail")),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__("Téléphone"))
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['full_name'])
                    ->icon('heroicon-o-arrow-down-on-square-stack'),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
