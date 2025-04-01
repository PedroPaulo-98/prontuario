<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CompanionsRelationManager extends RelationManager
{
    protected static string $relationship = 'companions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(80),
                
                Forms\Components\TextInput::make('cpf')
                    ->label('CPF')
                    ->mask('999.999.999-99')
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('cpf')
                    ->label('CPF')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('kinship')
                    ->label('Parentesco')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pai' => 'Pai',
                        'mae' => 'Mãe',
                        'filhoa' => 'Filho(a)',
                        'irmao' => 'Irmã(o)',
                        'avo' => 'Avô(ó)',
                        'netoa' => 'Neto(a)',
                        'sobrinho' => 'Sobrinho(a)',
                        'parente' => 'Parente',
                        'amigo' => 'Amigo(a)',
                        default => $state,
                    }),
                
                Tables\Columns\IconColumn::make('active')
                    ->label('Ativo')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}