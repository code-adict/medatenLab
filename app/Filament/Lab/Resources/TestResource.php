<?php

namespace App\Filament\Lab\Resources;

use App\Filament\Lab\Resources\TestResource\Pages;
use App\Filament\Lab\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

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
                                    Forms\Components\Select::make('category_id')
                                        ->relationship('category', 'name')
                                        ->label('Category'),
                                    Forms\Components\TextInput::make('name'),
                                    Forms\Components\TextInput::make('shortcut'),
                                    Forms\Components\MarkdownEditor::make('description')->columnSpan('full'),
                                ]
                            )->columns(2)
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(
                                [
                                    Forms\Components\TextInput::make('sample_type'),
                                    Forms\Components\TextInput::make('price')
                                        ->numeric(),
                                    Forms\Components\FileUpload::make('image')
                                        ->avatar()
                                        ->imageEditor(),

                                ]
                            )
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular(),
                TextColumn::make('name'),
                TextColumn::make('shortcut'),
                TextColumn::make('lab.name'),
                TextColumn::make('category.name'),
                TextColumn::make('sample_type'),
                TextColumn::make('price')
                ->money('NGN'),
                TextColumn::make('description'),

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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'view' => Pages\ViewTest::route('/{record}'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
