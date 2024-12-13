<?php

namespace App\Filament\Resources;

use App\Enums\ResumeMaritalStatusEnum;
use App\Enums\ResumeStatusEnum;
use App\Filament\Resources\ResumeResource\Pages;
use App\Filament\Resources\ResumeResource\RelationManagers;
use App\Models\Resume;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResumeResource extends Resource
{
    protected static ?string $model = Resume::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\Select::make('marital_status')
                            ->options(ResumeMaritalStatusEnum::toArray()),

                        Forms\Components\Select::make('city_id')
                            ->searchable()
                            ->relationship('city', 'name'),

                        Forms\Components\Textarea::make('address')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('work_post_id')
                            ->searchable()
                            ->relationship('workPost', 'name'),
                        Forms\Components\FileUpload::make('cv_file')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(10024),
                        Forms\Components\FileUpload::make('cover_letter_file')
                            ->acceptedFileTypes(['application/pdf']),
                        
                    ])->columns(3),
                Forms\Components\Repeater::make('diplomas')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\DatePicker::make('start_date')
                            ->native(false)
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->native(false)
                            ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__("Nom et Prenom"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label("E-mail")
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__("Téléphone"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('city_id')
                    ->placeholder('__')
                    ->label(__("Ville"))
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options(ResumeStatusEnum::toArray()),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListResumes::route('/'),
            'create' => Pages\CreateResume::route('/create'),
            'edit' => Pages\EditResume::route('/{record}/edit'),
        ];
    }
}
