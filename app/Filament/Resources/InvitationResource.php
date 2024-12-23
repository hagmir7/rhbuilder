<?php

namespace App\Filament\Resources;

use App\Enums\InvitationStatus;
use App\Enums\InvitationTypeEnum;
use App\Filament\Resources\InvitationResource\Pages;
use App\Filament\Resources\InvitationResource\RelationManagers;
use App\Models\Invitation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconSize;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvitationResource extends Resource
{
    protected static ?string $model = Invitation::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    public static function getModelLabel(): string
    {
        return 'Invitation';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('resume_id')
                    ->label(__("Candidat"))
                    ->searchable()
                    ->preload()
                    ->relationship('resume', 'full_name')
                    ->required(),
                Forms\Components\DateTimePicker::make('date')
                    ->label(__("Date d'envoi"))
                    ->minDate(now())
                    ->maxDate(now()->addDay(30))
                    ->locale('fr')
                    ->native(false)
                    ->displayFormat('d F Y')
                    ->prefixIcon('heroicon-m-calendar')
                    ->required(),
                Forms\Components\DateTimePicker::make('interview_date')
                    ->label(__("Date de l'entretien"))
                    ->minDate(now())
                    ->maxDate(now()->addDay(30))
                    ->locale('fr')
                    ->native(false)
                    ->displayFormat('d F Y')
                    ->prefixIcon('heroicon-m-calendar')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label(__("Type d'entretien"))
                    ->options(InvitationTypeEnum::toArray()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('resume.full_name')
                    ->label(__("Candidat"))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label(__("Date d'envoi"))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('interview_date')
                    ->dateTime('d/m/Y H:i')
                    ->label(__("Date de l'entretien"))
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('accepted')
                    ->label(__("Accepté")),

                Tables\Columns\SelectColumn::make('status')
                    ->placeholder(__('État'))
                    ->label(__("État"))
                    ->options(InvitationStatus::toArray()),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__("Créé le"))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(false)
                    ->tooltip(__('Edit'))
                    ->iconSize(IconSize::Medium),
                Tables\Actions\Action::make('accept')
                    ->label(false)
                    ->icon('heroicon-o-clipboard-document-check')
                    ->tooltip(__('Accepté et Evaluer'))
                    ->iconSize(IconSize::Medium),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                        // ->action(fn (Collection $records) => $records->each->delete())
                    
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
            'index' => Pages\ListInvitations::route('/'),
            // 'create' => Pages\CreateInvitation::route('/create'),
            // 'edit' => Pages\EditInvitation::route('/{record}/edit'),
        ];
    }
}
