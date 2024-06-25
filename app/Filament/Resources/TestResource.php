<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
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
                                    Forms\Components\TextInput::make('price')->numeric(),
                                    Forms\Components\FileUpload::make('image')
                                    ->avatar(),

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
                TextColumn::make('price'),
                TextColumn::make('description'),

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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
