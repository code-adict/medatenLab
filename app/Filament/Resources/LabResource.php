<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabResource\Pages;
use App\Filament\Resources\LabResource\RelationManagers;
use App\Models\Lab;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabResource extends Resource
{
    protected static ?string $model = Lab::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(
                                [
                                    Forms\Components\TextInput::make('name')->required(),
                                    Forms\Components\TextInput::make('address')->required(),
                                    Forms\Components\TextInput::make('phone')->numeric()->required(),
                                    Forms\Components\TextInput::make('email')->email()->required(),
                                    Forms\Components\FileUpload::make('image')
                                        ->avatar()
                                        ->image()
                                        ->imageEditor()
                                        ->columnSpan('full')

                                ]
                            )->columns(2)
                    ]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(
                                [
                                    Forms\Components\Toggle::make('approved'),
                                    Forms\Components\Toggle::make('status'),
                                    Forms\Components\MarkdownEditor::make('description')
                                        ->columnSpan('full')
                                        ->required()

                                ]
                            )->columns(2)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                ->label('Banner'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('Address'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\ToggleColumn::make('approved'),
                Tables\Columns\ToggleColumn::make('status'),
                Tables\Columns\TextColumn::make('description')->limit(50)
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
            'index' => Pages\ListLabs::route('/'),
            'create' => Pages\CreateLab::route('/create'),
            'edit' => Pages\EditLab::route('/{record}/edit'),
        ];
    }
}
