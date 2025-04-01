<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OriginResource\Pages;
use App\Filament\Resources\OriginResource\RelationManagers;
use App\Models\Origin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OriginResource extends Resource
{
    protected static ?string $model = Origin::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Origem'; // Altera o texto no menu
    protected static ?string $modelLabel = 'Origem'; // Para uso singular
    protected static ?string $pluralModelLabel = 'Origens'; // Para uso plural

    protected static ?string $navigationGroup = 'Cadastros'; 
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('title')
                ->label('title')
                ->required()
                ->helperText(str('Colocar a **Causa** de entarda do paciente.')->inlineMarkdown()->toHtmlString())
                ->maxLength(80),
            Forms\Components\Toggle::make('active')
                ->label('Ativo')
                ->required()
                ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Ativo')
                    ->boolean(),
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
            'index' => Pages\ListOrigins::route('/'),
            'create' => Pages\CreateOrigin::route('/create'),
            'edit' => Pages\EditOrigin::route('/{record}/edit'),
        ];
    }
}
