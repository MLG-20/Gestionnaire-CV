<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Utilisateur')
                    ->required(),
                Forms\Components\TextInput::make('job_title')
                    ->label('Poste')
                    ->required(),
                Forms\Components\TextInput::make('company')
                    ->label('Entreprise')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Description'),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Date de début')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Date de fin'),
                Forms\Components\Checkbox::make('is_current')
                    ->label('Poste actuel'),
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
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Poste')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company')
                    ->label('Entreprise')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Début')
                    ->date(),
                Tables\Columns\IconColumn::make('is_current')
                    ->label('Actuel')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name'),
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
