<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntrieResource\Pages;
use App\Filament\Resources\EntrieResource\RelationManagers;
use App\Models\Entrie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntrieResource extends Resource
{
    protected static ?string $model = Entrie::class;

    protected static ?string $navigationLabel = 'Entrada'; // Altera o texto no menu
    protected static ?string $modelLabel = 'Entrada'; // Para uso singular
    protected static ?string $pluralModelLabel = 'Entradas'; // Para uso plural

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-left-end-on-rectangle';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('bpa')
                        ->label('Número BPA')
                        ->required()
                        ->numeric(),
                        
                    Forms\Components\Select::make('unit_id')
                        ->label('Unidade')
                        ->relationship('unit', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),
                        
                    Forms\Components\DateTimePicker::make('entry')
                        ->label('Data/Hora da Entrada')
                        ->required()
                        ->default(now()),
                        
                    Forms\Components\Select::make('patient_id')
                        ->label('Paciente')
                        ->relationship('patient', 'name')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->label('Nome')
                                ->required(),
                            // Outros campos do paciente
                        ]),
                        
                    Forms\Components\Select::make('reason_id')
                        ->label('Motivo da Entrada')
                        ->relationship('reason', 'title')
                        ->required(),
                        
                    Forms\Components\Select::make('origin_id')
                        ->label('Origem')
                        ->relationship('origin', 'title')
                        ->required(),
                        
                    Forms\Components\Select::make('companion_id')
                        ->label('Acompanhante')
                        ->relationship('companion', 'name')
                        ->searchable()
                        ->preload(),
                        
                    Forms\Components\Textarea::make('information')
                        ->label('Informações Adicionais')
                        ->columnSpanFull(),
                        
                    Forms\Components\Textarea::make('intercurrence')
                        ->label('Intercorrências')
                        ->columnSpanFull(),
                ])
                ->columns(2),
                
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\Toggle::make('ambulance')
                        ->label('Veio de Ambulância')
                        ->inline(false),
                        
                    Forms\Components\Toggle::make('work')
                        ->label('Acidente de Trabalho')
                        ->inline(false),
                        
                    Forms\Components\Toggle::make('police')
                        ->label('Envolvimento Policial')
                        ->inline(false),
                        
                    Forms\Components\Toggle::make('mistreatment')
                        ->label('Suspeita de Maus Tratos')
                        ->inline(false),
                        
                    Forms\Components\TextInput::make('native')
                        ->label('Naturalidade')
                        ->maxLength(5),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.name')
                    ->label('Paciente')
                    ->url(fn ($record) => PatientResource::getUrl('edit', ['record' => $record->patient_id]))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('bpa')
                    ->label('BPA')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unidade')
                    ->sortable(),

                Tables\Columns\TextColumn::make('entry')
                    ->label('Data/Hora')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('reason.title')
                    ->label('Motivo')
                    ->sortable(),

                Tables\Columns\TextColumn::make('origin.title')
                    ->label('Origem')
                    ->sortable(),

                Tables\Columns\IconColumn::make('ambulance')
                    ->label('Ambulância')
                    ->boolean(),

                Tables\Columns\IconColumn::make('work')
                    ->label('Trabalho')
                    ->boolean(),

                Tables\Columns\IconColumn::make('police')
                    ->label('Polícia')
                    ->boolean(),

                Tables\Columns\IconColumn::make('mistreatment')
                    ->label('Maus Tratos')
                    ->boolean(),

                Tables\Columns\TextColumn::make('native')
                    ->label('Naturalidade')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registrado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('unit_id')
                    ->label('Unidade')
                    ->relationship('unit', 'name'),

                Tables\Filters\SelectFilter::make('reason_id')
                    ->label('Motivo')
                    ->relationship('reason', 'title'),

                Tables\Filters\Filter::make('entry')
                    ->form([
                        Forms\Components\DatePicker::make('entry_from')
                            ->label('De'),
                        Forms\Components\DatePicker::make('entry_until')
                            ->label('Até'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['entry_from'],
                                fn ($query, $date) => $query->whereDate('entry', '>=', $date))
                            ->when($data['entry_until'],
                                fn ($query, $date) => $query->whereDate('entry', '<=', $date));
                    })
            ])
            ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('entry', 'desc');
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
            'index' => Pages\ListEntries::route('/'),
            'create' => Pages\CreateEntrie::route('/create'),
            'edit' => Pages\EditEntrie::route('/{record}/edit'),
        ];
    }
}
