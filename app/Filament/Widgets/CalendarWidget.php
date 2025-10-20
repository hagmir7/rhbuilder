<?php

namespace App\Filament\Widgets;

use App\Enums\InvitationTypeEnum;
use App\Filament\Resources\InvitationResource;
use App\Models\Invitation;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Filament\Forms;
use Saade\FilamentFullCalendar\Actions;
use Saade\FilamentFullCalendar\Data\EventData;

class CalendarWidget extends FullCalendarWidget
{

    public Model | string | null $model = Invitation::class;


    protected function headerActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('Ajouter un entretien'))
                ->color('success')
                ->icon('heroicon-o-plus-circle'),
        ];
    }


    public function eventDidMount(): string
    {
        return <<<JS
                function({ event, timeText, isStart, isEnd, isMirror, isPast, isFuture, isToday, el, view }){
                    el.setAttribute("x-tooltip", "tooltip");
                    el.setAttribute("x-data", "{ tooltip: '"+event.title+"' }");
                }
            JS;
    }


    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make()
                ->icon('heroicon-o-pencil-square')
                ->mountUsing(
                    function (Invitation $record, Forms\Form $form, array $arguments) {
                        $form->fill([
                            'resume_id' => $record->resume_id,
                            'name' => $record->name,
                            'interview_date' => $arguments['event']['start'] ?? $record->interview_date,
                            'date' => $record->date
                        ]);
                    }
                ),
            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),

        ];
    }


    public function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make()
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
                ])->columns(3)
        ];
    }



    public function fetchEvents(array $fetchInfo): array
    {
        return Invitation::query()
            ->where('interview_date', '>=', $fetchInfo['start'])
            ->get()
            ->map(
                fn(Invitation $event) => EventData::make()
                    ->id($event->id)
                    ->title($event->resume->full_name)
                    ->start($event->interview_date)
            )
            ->toArray();
    }
}
