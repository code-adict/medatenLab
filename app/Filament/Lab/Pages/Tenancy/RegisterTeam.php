<?php
namespace App\Filament\Lab\Pages\Tenancy;

use App\Models\Lab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Laboratory';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema(
                                [
                                    TextInput::make('name')->required(),
                                    TextInput::make('slug')->required(),
                                    TextInput::make('address')->required(),
                                    TextInput::make('phone')->numeric()->required(),
                                    TextInput::make('email')->email()->required()->columnSpan('full'),
                                    FileUpload::make('image')
//                                        ->avatar()
                                        ->image()
                                        ->imageEditor()
                                        ->columnSpan('full')

                                ]
                            )->columns(2)
                    ]),

                Group::make()
                    ->schema([
                        Section::make()
                            ->schema(
                                [
//                                    Toggle::make('approved'),
//                                    Toggle::make('status'),
                                    MarkdownEditor::make('description')
                                        ->columnSpan('full')
                                        ->required()

                                ]
                            )->columns(2)
                    ])
            ]);
    }

    protected function handleRegistration(array $data): Lab
    {
        $lab = Lab::create($data);

        $lab->users()->attach(auth()->user());

        return $lab;
    }
}
