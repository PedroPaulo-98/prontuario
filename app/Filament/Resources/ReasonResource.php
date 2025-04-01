<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReasonResource\Pages;
use App\Filament\Resources\ReasonResource\RelationManagers;
use App\Models\Reason;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReasonResource extends Resource
{
    protected static ?string $model = Reason::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationLabel = 'Causa de entrada'; // Altera o texto no menu
    protected static ?string $modelLabel = 'Causa de entrada'; // Para uso singular
    protected static ?string $pluralModelLabel = 'Causas de entrada'; // Para uso plural

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
            'index' => Pages\ListReasons::route('/'),
            'create' => Pages\CreateReason::route('/create'),
            'edit' => Pages\EditReason::route('/{record}/edit'),
        ];
    }
}
