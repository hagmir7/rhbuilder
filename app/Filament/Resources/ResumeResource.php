<?php

namespace App\Filament\Resources;

use APP\Enums\LanguageLevelEnum;
use App\Enums\ResumeMaritalStatusEnum;
use App\Enums\ResumeStatusEnum;
use App\Filament\Resources\ResumeResource\Pages;
use App\Filament\Resources\ResumeResource\RelationManagers;
use App\Models\City;
use App\Models\Level;
use App\Models\Resume;
use App\Models\Skill;
use App\Models\WorkPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class ResumeResource extends Resource
{
    protected static ?string $model = Resume::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getModelLabel(): string
    {
        return __("CV");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Person')
                        ->schema([
                            Forms\Components\TextInput::make('last_name')
                                ->label(__("Nom"))
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('first_name')
                                ->label(__("Prénom"))
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('email')
                                ->label(__("E-mail"))
                                ->email()
                                ->unique(ignoreRecord: true)
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('phone')
                                ->required()
                                ->label(__("Téléphone"))
                                ->tel()
                                ->maxLength(255),
                            Forms\Components\Select::make('marital_status')
                                ->label(__("État civil"))
                                ->options(ResumeMaritalStatusEnum::toArray()),
                            Forms\Components\Select::make('city_id')
                                ->label(__("Ville"))
                                ->preload()
                                ->searchable()
                                ->relationship('city', 'name'),
                            Forms\Components\Textarea::make('address')
                                ->label(__("Adresse"))
                                ->rows(3),
                            // Forms\Components\Select::make('company_work_post_id')
                            //     ->searchable()
                            //     ->relationship('workPost', 'name'),
                            Forms\Components\FileUpload::make('cv_file')
                                ->label(__("Fichier de CV"))
                                ->downloadable()
                                ->acceptedFileTypes(['application/pdf'])
                                ->maxSize(10024),
                            Forms\Components\FileUpload::make('cover_letter_file')
                                ->label(__("Lettre de motivation"))
                                ->downloadable()
                                ->acceptedFileTypes(['application/pdf']),
                        ])->columns(3),
                    Wizard\Step::make('Diplômes')
                        ->schema([
                            Forms\Components\Repeater::make('diplomas')
                                ->relationship()
                                ->label(false)
                                ->schema([
                                    Forms\Components\Select::make('level_id')
                                        ->options(Level::all()->pluck('name', 'id'))
                                        ->preload()
                                        ->label(__("Niveau"))
                                        ->searchable()
                                        ->required(),
                                    Forms\Components\TextInput::make('name')
                                        ->label(__("Diplôme"))
                                        ->required(),
                                    Forms\Components\DatePicker::make('end_date')
                                        ->locale('fr')
                                        ->native(false)
                                        ->displayFormat('d F Y')
                                        ->prefixIcon('heroicon-m-calendar')
                                        ->required()
                                        ->label(__("Fin")),

                                ])->columns(3)
                        ]),
                    Wizard\Step::make(__("Expérience"))
                        ->schema([
                            Forms\Components\Repeater::make('experiences')
                                ->relationship()
                                ->schema([
                                    Forms\Components\TextInput::make('company')
                                        ->label(__("Entreprise"))
                                        ->required(),
                                    Forms\Components\TextInput::make('work_post')
                                        ->label(__("Post de travail"))
                                        ->required(),
                                    Forms\Components\DatePicker::make('start_date')
                                        ->label(__("Début"))
                                        ->locale('fr')
                                        ->native(false)
                                        ->displayFormat('d F Y')
                                        ->prefixIcon('heroicon-m-calendar')
                                        ->required(),
                                    Forms\Components\DatePicker::make('end_date')
                                        ->locale('fr')
                                        ->native(false)
                                        ->displayFormat('d F Y')
                                        ->label(__("Fin"))
                                        ->prefixIcon('heroicon-m-calendar'),
                                ])->columns(4)
                        ]),
                    Wizard\Step::make('Compétences')
                        ->schema([
                            Forms\Components\Select::make('skills')
                                ->label(__("Compétences"))
                                ->relationship('skills', 'name')
                                ->multiple()
                                ->preload(),

                            Forms\Components\Repeater::make('languages')
                                ->label(__("Langues"))
                                ->relationship('languages')
                                ->schema([
                                    Forms\Components\Select::make('language_id')
                                        ->label(__("Langue"))
                                        ->required()
                                        ->relationship('language', 'name'),
                                    Forms\Components\Select::make('level')
                                        ->label(__("Niveau"))
                                        ->required()
                                        ->options(LanguageLevelEnum::toArray())
                                ])->columns(2)->grid(2)
                        ])
                ])
                    ->persistStepInQueryString()
                    ->nextAction(
                        fn(Action $action) => $action->label(__("Prochaine")),
                    )
                    ->columnSpanFull()
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
                Tables\Columns\TextColumn::make('city.name')
                    ->placeholder('__')
                    ->label(__("Ville"))
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label(__("État"))
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
                // Filter::make('Nouveau')->query(function($query){
                //     return $query->where("status", 1);
                // }),

                // Filter::make('Invetaion')->query(function($query){
                //     return $query->where("status", 2);
                // }),

                SelectFilter::make('status')
                    ->label(__("État"))
                    ->searchable()
                    ->options(ResumeStatusEnum::toArray()),

                SelectFilter::make('marital_status')
                    ->searchable()
                    ->label(__("État civil"))
                    ->options(ResumeMaritalStatusEnum::toArray()),

                SelectFilter::make('city_id')
                    ->label(__("Ville"))
                    ->multiple()
                    ->preload()
                    ->relationship('city', 'name'),

                SelectFilter::make('skills')
                    ->form([
                        Forms\Components\Select::make('skill')
                            ->multiple()
                            ->searchable()
                            ->options(Skill::all()->pluck('name', 'id')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(!empty($data['skill']), function (Builder $query) use ($data) {
                            return $query->whereHas('skills', function ($q) use ($data) {
                                $q->whereIn('skills.id', $data['skill']);
                            });
                        });
                    }),
                SelectFilter::make('experience')
                    ->form([
                        Forms\Components\TextInput::make('experience')
                            ->numeric(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->get()->filter(function ($resume) use ($data) {
                            $resume->getExperience() == intval($data['experience']);
                        });
                    })
            ])->filtersFormColumns(3)
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
