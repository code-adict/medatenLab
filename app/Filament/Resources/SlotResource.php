<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlotResource\Pages;
use App\Filament\Resources\SlotResource\RelationManagers;
use App\Models\Slot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SlotResource extends Resource
{
    protected static ?string $model = Slot::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(
                                [
                                    Forms\Components\Select::make('lab_id')
                                        ->relationship('lab', 'name')
                                        ->label('Laboratory'),

                                    Forms\Components\DatePicker::make('date')->native(false),
                                    Forms\Components\TimePicker::make('start')->native(false),
                                    Forms\Components\TimePicker::make('end')->native(false),



                                ]
                            )
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(
                                [
                                    Forms\Components\TextInput::make('status'),
                                    Forms\Components\Select::make('visit_type')
                                        ->options(
                                            [
                                                'home' =>'Home',
                                                'lab' =>'Laboratory',
                                            ]
                                        ),
                                    Forms\Components\TextInput::make('capacity')->numeric(),
                                    Forms\Components\TextInput::make('current_bookings')->numeric(),

                                ]
                            )
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               Tables\Columns\TextColumn::make('lab.name'),
               Tables\Columns\TextColumn::make('date'),
               Tables\Columns\TextColumn::make('start'),
               Tables\Columns\TextColumn::make('end'),
               Tables\Columns\TextColumn::make('status'),
               Tables\Columns\TextColumn::make('visit_type'),
               Tables\Columns\TextColumn::make('capacity'),
               Tables\Columns\TextColumn::make('current_bookings'),
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
            'index' => Pages\ListSlots::route('/'),
            'create' => Pages\CreateSlot::route('/create'),
            'edit' => Pages\EditSlot::route('/{record}/edit'),
        ];
    }
}
