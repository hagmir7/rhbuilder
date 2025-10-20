<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecruitmentResource\Pages;
use App\Filament\Resources\RecruitmentResource\RelationManagers;
use App\Filament\Resources\RecruitmentResource\RelationManagers\ResumesRelationManager;
use App\Models\CompanyWorkPost;
use App\Models\Recruitment;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecruitmentResource extends Resource
{
    protected static ?string $model = Recruitment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    public static function getModelLabel(): string
    {
        return __("Recrutements");
    }


    protected static ?string $recordTitleAttribute = "name";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__("Nom de collection"))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('company_id')
                            ->label(__("Entreprise"))
                            ->options(\App\Models\Company::all()->pluck('name', 'id'))
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('company_work_post_id')
                            ->label(__("Poste de travail"))
                            ->options(function(Get $get){
                                if($get('company_id')){
                                    return CompanyWorkPost::where('company_id', $get('company_id'))->pluck('name', 'id');
                                }else{
                                    return [];
                            }})
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label(__("Description"))
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('companyWorkPost.name')
                    ->label(__("Poste de travail"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('resumes_count')
                    ->label(__("Nombre de CV"))
                    ->badge()
                    ->counts('resumes')
                    ->sortable(),

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
            ResumesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecruitment::route('/'),
            'create' => Pages\CreateRecruitment::route('/create'),
            'edit' => Pages\EditRecruitment::route('/{record}/edit'),
        ];
    }
}
