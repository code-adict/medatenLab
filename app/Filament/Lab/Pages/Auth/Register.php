<?php

namespace App\Filament\Lab\Pages\Auth;
use App\Models\Role;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Events\Auth\Registered;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use \Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as BaseRegisterPage;

class Register extends BaseRegisterPage
{
//    protected static ?string $navigationIcon = 'heroicon-o-document-text';
//
//    protected static string $view = 'filament.lab.pages.auth.register';

    public function form(Form $form):Form
    {

        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema(
                                [
                                    $this->getNameFormComponent(),
                                    $this->getEmailFormComponent(),
                                    TextInput::make('phone')
                                        ->tel(),
                                ]
                            )->columns(2)
                    ]),
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema(
                                [
                                   $this->getPasswordFormComponent(),
                                    $this->getPasswordConfirmationFormComponent(),
                                    FileUpload::make('image')
                                        ->avatar(),

                                ]
                            )
                    ])
            ])
            ->statePath('data');
    }

    /**
     * @throws \Exception
     */
    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $user = $this->wrapInDatabaseTransaction(function () {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();
            $data['role_id'] = Role::whereName("lab admin")->first()->id;

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeRegister($data);

            $this->callHook('beforeRegister');

            $user = $this->handleRegistration($data);

            $this->form->model($user)->saveRelationships();

            $this->callHook('afterRegister');

            return $user;
        });

        event(new Registered($user));

        $this->sendEmailVerificationNotification($user);

        Filament::auth()->login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }
}
