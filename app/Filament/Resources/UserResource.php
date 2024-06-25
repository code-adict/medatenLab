<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                                    Forms\Components\TextInput::make('email')->email()->required(),
                                    Forms\Components\TextInput::make('phone')->numeric(),
                                ]
                            )->columns(2)
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema(
                                [
                                    Forms\Components\Select::make('role_id')
                                        ->native(false)
                                        ->relationship('role', 'name')
                                        ->label('User Role'),

                                    Forms\Components\Select::make('labs')
                                        ->native(false)
                                        ->multiple()
                                        ->preload()
                                        ->relationship(name: null, titleAttribute: 'name'),//here i used null because the name is already specified in the make() of the component
                                    Forms\Components\TextInput::make('password')
                                    ->password(fn(String $context):bool => $context === 'create')/// here we are specifying that we need the field to be requiered only when we are in the create context
                                    ->dehydrateStateUsing(fn($state) => Hash::make($state)) ///this is to hash the password before sending it to the server
                                    ->dehydrated(fn($state)=> filled($state)),///this is to check if the password field has a value and if it doesn't have a value do no send the the data to the server
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
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('role.name')
                ->badge(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

//    public static function shouldRegisterNavigation(): bool
//    {
//
//        return auth()->user()->role->name === 'admin';
//    }
}
