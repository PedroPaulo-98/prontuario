<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitResource\Pages;
use App\Filament\Resources\UnitResource\RelationManagers;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static ?string $navigationLabel = 'Unidade Hospitalar'; // Altera o texto no menu
    protected static ?string $modelLabel = 'Unidade Hospitalar'; // Para uso singular
    protected static ?string $pluralModelLabel = 'Unidades Hospitalares'; // Para uso plural

    protected static ?string $navigationGroup = 'Cadastros'; 

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nome da Unidade ou Hospital')
                        ->required()
                        ->helperText(str('Colocar o **Nome Completo** da Unidade ou Hospital.')->inlineMarkdown()->toHtmlString())
                        ->maxLength(100),
                    Forms\Components\TextInput::make('initials')
                        ->label('Inicial ou abreveação')
                        ->required()
                        ->helperText(str('Colocar a **Abreveação** da Unidade ou Hospital.')->inlineMarkdown()->toHtmlString())
                        ->maxLength(15),
                    Forms\Components\TextInput::make('cnes')
                        ->label('Cadastro Nacional de Estabelecimentos de Saúde')
                        ->required()
                        ->helperText(str('Colocar a **Abreveação** da Unidade ou Hospital.')->inlineMarkdown()->toHtmlString())
                        ->maxLength(7),
                    Forms\Components\Toggle::make('active')
                        ->label('Ativo')
                        ->required()
                        ->default(true),
                ])
                ->columns(2) // Dois campos por linha
                ->columnSpan('full') // Card ocupa toda a largura
                ->label('Dados Pessoais'),

                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('cep')
                        ->label('CEP')
                        ->numeric()
                        ->mask('99999999')
                        ->maxLength(8)
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $state = str_replace(['.', '-'], '', $state);
                            if (strlen($state) === 8) {
                                $url = "https://viacep.com.br/ws/{$state}/json/";
                                $client = new \GuzzleHttp\Client();
                                try {
                                    $response = $client->get($url);
                                    $data = json_decode($response->getBody(), true);
                                    
                                    if (!isset($data['erro'])) {
                                        $set('street', strtoupper($data['logradouro'] ?? ''));
                                        $set('district', strtoupper($data['bairro'] ?? ''));
                                        $set('city', strtoupper($data['localidade'] ?? ''));
                                        $set('state', strtoupper($data['uf'] ?? ''));
                                    }
                                } catch (\Exception $e) {
                                    // Tratar erro se necessário
                                }
                            }
                        }),
                        
                    Forms\Components\TextInput::make('street')
                        ->label('Rua')
                        ->required()
                        ->maxLength(60),
                        
                    Forms\Components\TextInput::make('district')
                        ->label('Bairro')
                        ->required()
                        ->maxLength(30),
                        
                    Forms\Components\TextInput::make('city')
                        ->label('Cidade')
                        ->required()
                        ->maxLength(80),
                ])
                ->columns(3)
                ->columnSpan('full')
                ->label('Dados moradia'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('initials'),
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
            'index' => Pages\ListUnits::route('/'),
            'create' => Pages\CreateUnit::route('/create'),
            'edit' => Pages\EditUnit::route('/{record}/edit'),
        ];
    }
}
