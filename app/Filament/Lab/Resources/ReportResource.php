<?php

namespace App\Filament\Lab\Resources;

use App\Filament\Lab\Resources\ReportResource\Pages;
use App\Filament\Lab\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

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

                                    Forms\Components\Select::make('patient_id')
                                        ->relationship('patient', 'name')
                                        ->label('Patient'),
                                    Forms\Components\TextInput::make('name'),
                                    Forms\Components\TextInput::make('report_code'),
                                    Forms\Components\MarkdownEditor::make('description')->columnSpan('full'),

                                ]
                            )->columns(2)
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('lab.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('patient.name'),
                Tables\Columns\TextColumn::make('report_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50),
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'view' => Pages\ViewReport::route('/{record}'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
