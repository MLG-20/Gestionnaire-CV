<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FooterSettingResource\Pages;
use App\Models\FooterSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations de l\'entreprise')
                    ->description('Gérez les informations générales de votre entreprise dans le footer')
                    ->schema([
                        Forms\Components\TextInput::make('company_name')
                            ->label('Nom de l\'entreprise')
                            ->required()
                            ->placeholder('Sama CV'),
                        Forms\Components\Textarea::make('company_description')
                            ->label('Description')
                            ->rows(3)
                            ->placeholder('Créez des CVs professionnels qui font la différence. Gratuit, simple et efficace.'),
                        Forms\Components\TextInput::make('footer_text')
                            ->label('Texte du footer')
                            ->placeholder('Créez des CVs professionnels...'),
                    ]),

                Forms\Components\Section::make('Réseaux sociaux')
                    ->description('Ajoutez les liens vers vos réseaux sociaux')
                    ->schema([
                        Forms\Components\TextInput::make('linkedin_url')
                            ->label('URL LinkedIn')
                            ->url()
                            ->placeholder('https://linkedin.com/company/...'),
                        Forms\Components\TextInput::make('twitter_url')
                            ->label('URL Twitter/X')
                            ->url()
                            ->placeholder('https://twitter.com/...'),
                        Forms\Components\TextInput::make('github_url')
                            ->label('URL GitHub')
                            ->url()
                            ->placeholder('https://github.com/...'),
                    ]),

                Forms\Components\Section::make('Informations de contact')
                    ->description('Détails de contact à afficher dans le footer')
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Email')
                            ->email()
                            ->placeholder('contact@samacv.com'),
                        Forms\Components\TextInput::make('contact_phone')
                            ->label('Téléphone')
                            ->tel()
                            ->placeholder('+33 1 23 45 67 89'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Entreprise')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('contact_phone')
                    ->label('Téléphone'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Mis à jour')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFooterSettings::route('/'),
            'create' => Pages\CreateFooterSetting::route('/create'),
            'edit' => Pages\EditFooterSetting::route('/{record}/edit'),
        ];
    }
}
