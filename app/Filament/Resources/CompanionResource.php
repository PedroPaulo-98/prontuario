<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanionResource\Pages;
use App\Filament\Resources\CompanionResource\RelationManagers;
use App\Models\Companion;
use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanionResource extends Resource
{
    protected static ?string $model = Companion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Acompanhantes'; // Altera o texto no menu
    protected static ?string $modelLabel = 'Acompanhante'; // Para uso singular
    protected static ?string $pluralModelLabel = 'Acompanhantes'; // Para uso plural
    
    protected static bool $shouldRegisterNavigation = false;


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Campo hidden para o paciente
            Forms\Components\Hidden::make('patient_id')
                ->default(function ($livewire) {
                    // Pega o ID do paciente da URL ou da relação
                    return request()->patient_id ?? 
                            request()->patient ?? 
                            $livewire->ownerRecord?->id;
                })
                ->required(),
                
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(80),
                    Forms\Components\TextInput::make('cpf')
                        ->label('CPF')
                        ->mask('999.999.999-99')
                        ->required()
                        ->maxLength(14),
                    Forms\Components\TextInput::make('phone')
                        ->label('Telefone')
                        ->mask('(99) 99999-9999')
                        ->maxLength(15),
                    Forms\Components\Select::make('kinship')
                        ->label('Parentesco')
                        ->options([
                            'pai' => 'Pai',
                            'mae' => 'Mãe',
                            'filhoa' => 'Filho(a)',
                            'irmao' => 'Irmã(o)',
                            'avo' => 'Avô(ó)',
                            'netoa' => 'Neto(a)',
                            'sobrinho' => 'Sobrinho(a)',
                            'parente' => 'Parente',
                            'amigo' => 'Amigo(a)',
                        ])
                        ->required(),
                    Forms\Components\Toggle::make('active')
                        ->label('Ativo')
                        ->default(true),
                ])
                ->columns(2)
                ->columnSpan('full'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nome')
                ->searchable(),
            Tables\Columns\TextColumn::make('cpf')
                ->label('CPF'),
            Tables\Columns\TextColumn::make('kinship')
                ->label('Parentesco'),
            Tables\Columns\IconColumn::make('active')
                ->label('Ativo')
                ->boolean(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('patient')
                ->relationship('patient', 'name')
                ->label('Paciente')
                ->searchable()
                ->preload(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCompanions::route('/'),
            'create' => Pages\CreateCompanion::route('/create'),
            'edit' => Pages\EditCompanion::route('/{record}/edit'),
        ];
    }
}
