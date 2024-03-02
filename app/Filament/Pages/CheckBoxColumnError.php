<?php

namespace App\Filament\Pages;

use App\Models\Pet;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
class CheckBoxColumnError extends Page implements HasTable, HasForms
{

    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $slug = 'collapsible';
    protected static string $view = 'filament.pages.collapsible-test';

    public function table(Table $table)
    {

        //The checkbox list breaks funcionality when you add more than on orWhere clause to the query.
        //In the developer tools I managed to see that the target change.

        return $table->query(
            Pet::query()
                ->orWhere('pet_status', 'inbound') //Commenting out the rest of the query blow restores funcionality.
                ->orWhere('pet_status', 'cremation') //Commenting IN the second row, the CheckboxColumn simple doesn't work.
                ->orWhere('pet_status', 'hold') // Commeting IN the third row, the only the first two records work normally.
                ->orderby('is_cremated', 'asc')) // Commeting IN orderBY, the CheckboxColumn updates the wrong records (click on the first record above the first is_cremated=true)
            
            ->columns([
                TextColumn::make('date_of_call')
                    ->label("Date/Time")
                    ->formatStateUsing(function($record){return Carbon::parse($record->date_of_call)->format('M d H:i'); })
                    ->description(fn ($record) => Carbon::parse($record->date_of_call)->diffForHumans()),
                     
                TextColumn::make('pet_status'),
                TextColumn::make('name'),
                TextColumn::make('age')->formatStateUsing(fn($record) => $record->is_cremated), 
                IconColumn::make('is_cremated')->label("Cremated")->boolean(),
                CheckboxColumn::make('is_cremated')->label("Cremated"), // Not Sure if is a bug or just conflict, but When changing the order of the columns, the bottom column will not show.
                ]);

    }


}
