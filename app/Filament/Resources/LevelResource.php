<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LevelResource\Pages;
use App\Filament\Resources\LevelResource\RelationManagers;
use App\Models\Level;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LevelResource extends Resource
{
    protected static ?string $model = Level::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function getModelLabel(): string
    {
        return __("Diplômes");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__("Diplôme"))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('years')
                    ->label(__("Bac +"))
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('coefficient')
                    ->label(__("Coefficient"))
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__("Diplôme"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('years')
                    ->label(__("Bac +"))
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('coefficient')
                    ->label(__("Coefficient"))
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLevels::route('/'),
            // 'create' => Pages\CreateLevel::route('/create'),
            // 'edit' => Pages\EditLevel::route('/{record}/edit'),
        ];
    }
}
