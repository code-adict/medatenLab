<?php

namespace App\Filament\Lab\Resources;

use App\Filament\Lab\Resources\AppointmentResource\Pages;
use App\Filament\Lab\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(
                                [
                                    Forms\Components\Select::make('slot_id')
                                        ->relationship('slot', 'id')
                                        ->label('Slot ID'),

                                    Forms\Components\Select::make('test_id')
                                        ->relationship('test', 'name')
                                        ->label('Test ID'),
                                    Forms\Components\Select::make('patient_id')
                                        ->relationship('patient', 'name')
                                        ->label('Patient ID'),

                                ]
                            )
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(
                                [
                                    Forms\Components\MarkdownEditor::make('description'),

                                ]
                            )
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.name'),
                TextColumn::make('slot.date')
                    ->label('Date')
                    ->date(),
                TextColumn::make('slot.start')
                    ->label('Start Time'),
                TextColumn::make('slot.end')->label('End Time'),
                TextColumn::make('slot.status')->label('Status'),
                TextColumn::make('test.name')->label('Test Name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'view' => Pages\ViewAppointment::route('/{record}'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
