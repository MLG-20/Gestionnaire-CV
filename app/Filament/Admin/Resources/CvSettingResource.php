<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CvSettingResource\Pages;
use App\Models\CvSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CvSettingResource extends Resource
{
    protected static ?string $model = CvSetting::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-cog-6-tooth';
    }

    protected static ?string $navigationLabel = 'Paramètres CV';

    protected static ?string $modelLabel = 'Paramètre CV';

    protected static ?string $pluralModelLabel = 'Paramètres CV';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Utilisateur')
                    ->required(),
                Forms\Components\Select::make('template')
                    ->options([
                        'modern' => 'Moderne',
                        'classic' => 'Classique',
                        'creative' => 'Créatif',
                        'minimal' => 'Minimaliste',
                        'professional' => 'Professionnel',
                        'colorful' => 'Coloré',
                        'elegant' => 'Élégant',
                        'bold' => 'Audacieux',
                        'tech' => 'Technologie',
                        'startup' => 'Startup',
                    ])
                    ->label('Template')
                    ->required(),
                Forms\Components\ColorPicker::make('primary_color')
                    ->label('Couleur Primaire'),
                Forms\Components\ColorPicker::make('secondary_color')
                    ->label('Couleur Secondaire'),
                Forms\Components\Toggle::make('show_photo')
                    ->label('Afficher la photo')
                    ->default(true),
                Forms\Components\Toggle::make('show_contact_info')
                    ->label('Afficher les infos de contact')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('template')
                    ->label('Template'),
                Tables\Columns\ColorColumn::make('primary_color')
                    ->label('Couleur Primaire'),
                Tables\Columns\ColorColumn::make('secondary_color')
                    ->label('Couleur Secondaire'),
                Tables\Columns\IconColumn::make('show_photo')
                    ->label('Photo'),
                Tables\Columns\IconColumn::make('show_contact_info')
                    ->label('Contact'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name'),
                Tables\Filters\SelectFilter::make('template')
                    ->options([
                        'modern' => 'Moderne',
                        'classic' => 'Classique',
                        'creative' => 'Créatif',
                        'minimal' => 'Minimaliste',
                        'professional' => 'Professionnel',
                        'colorful' => 'Coloré',
                        'elegant' => 'Élégant',
                        'bold' => 'Audacieux',
                        'tech' => 'Technologie',
                        'startup' => 'Startup',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCvSettings::route('/'),
            'create' => Pages\CreateCvSetting::route('/create'),
            'edit' => Pages\EditCvSetting::route('/{record}/edit'),
        ];
    }
}
