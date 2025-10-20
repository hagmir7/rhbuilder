<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillTypeResource\Pages;
use App\Filament\Resources\SkillTypeResource\RelationManagers;
use App\Models\SkillType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkillTypeResource extends Resource
{
    protected static ?string $model = SkillType::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';


    public static function getModelLabel(): string
    {
        return __("Compétence");
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Type de compétence')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->nullable()
                            ->rows(3),
                    ]),

                Forms\Components\Repeater::make('skills')
                    ->relationship('skills')
                    ->label('Compétences')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Compétence')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->grid(3)
                    ->addActionLabel("Ajouter une compétence")
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label('Type de compétence')
                    ->searchable(),
                Tables\Columns\TextColumn::make('skills_count')
                    ->label('Nombre de compétences')
                    ->badge()
                    ->counts('skills'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
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
            'index' => Pages\ListSkillTypes::route('/'),
            'create' => Pages\CreateSkillType::route('/create'),
            'edit' => Pages\EditSkillType::route('/{record}/edit'),
        ];
    }
}
