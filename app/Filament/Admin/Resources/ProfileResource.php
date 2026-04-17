<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Utilisateur')
                    ->required()
                    ->unique(),
                Forms\Components\TextInput::make('profession')
                    ->label('Profession')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->label('Localisation'),
                Forms\Components\TextInput::make('phone')
                    ->label('Téléphone')
                    ->tel(),
                Forms\Components\Textarea::make('bio')
                    ->label('Biographie')
                    ->rows(4),
                Forms\Components\TextInput::make('github_url')
                    ->label('Lien GitHub')
                    ->url(),
                Forms\Components\TextInput::make('linkedin_url')
                    ->label('Lien LinkedIn')
                    ->url(),
                Forms\Components\TextInput::make('website_url')
                    ->label('Site Web')
                    ->url(),
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
                Tables\Columns\TextColumn::make('profession')
                    ->label('Profession')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Localisation'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'view' => Pages\ViewProfile::route('/{record}'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
