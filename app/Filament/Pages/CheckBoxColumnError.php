<?php

namespace App\Filament\Pages;

use App\Models\Pet;

use App\Models\User;
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
        return $table->query(
            Pet::query()
            ->orWhere('pet_status', 'inbound')
            ->orWhere('pet_status', 'cremation')
            //->orWhere('pet_status', 'hold')
            //->orderby('is_cremated', 'asc')
            )->columns([
                TextColumn::make('date_of_call')
                    ->label("Date/Time")
                    ->formatStateUsing(function($record){
                        return Carbon::parse($record->date_of_call)->format('M d H:i');   
                    })
                    ->description(fn ($record) => Carbon::parse($record->date_of_call)->diffForHumans()),
                     
                TextColumn::make('pet_status'),
                TextColumn::make('name'),
                TextColumn::make('age')->formatStateUsing(function($record){
                    return ($record->is_cremated);
                }),
                IconColumn::make('is_cremated')->label("Cremated")->boolean(),
                CheckboxColumn::make('is_cremated')->label("Cremated"), // BUG -> When changing the order of the columns, the bottom column will not work
                ]);
                }


}
