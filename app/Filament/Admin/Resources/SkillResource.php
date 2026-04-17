<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Utilisateur')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Compétence')
                    ->required(),
                Forms\Components\Select::make('level')
                    ->options([
                        'beginner' => 'Débutant',
                        'intermediate' => 'Intermédiaire',
                        'advanced' => 'Avancé',
                        'expert' => 'Expert',
                    ])
                    ->label('Niveau'),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Compétence')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('level')
                    ->label('Niveau')
                    ->colors([
                        'gray' => 'beginner',
                        'blue' => 'intermediate',
                        'orange' => 'advanced',
                        'red' => 'expert',
                    ])
                    ->formatStateUsing(fn($state) => match($state) {
                        'beginner' => 'Débutant',
                        'intermediate' => 'Intermédiaire',
                        'advanced' => 'Avancé',
                        'expert' => 'Expert',
                        default => $state,
                    }),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
